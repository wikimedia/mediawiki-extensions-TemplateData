<?php
/**
 * Implement the 'templatedata' query module in the API.
 * Format JSON only.
 *
 * @file
 */

/**
 * @ingroup API
 * @emits error.code templatedata-corrupt
 * @todo Support continuation (see I1a6e51cd)
 */
class ApiTemplateData extends ApiBase {

	/**
	 * @var ApiPageSet|null
	 */
	private $mPageSet = null;

	/**
	 * For backwards compatibility, this module needs to output format=json when
	 * no format is specified.
	 * @return ApiFormatBase|null
	 */
	public function getCustomPrinter() {
		if ( $this->getMain()->getVal( 'format' ) === null ) {
			$this->addDeprecation(
				'apiwarn-templatedata-deprecation-format', 'action=templatedata&!format'
			);
			return $this->getMain()->createPrinterByName( 'json' );
		}
		return null;
	}

	/**
	 * @return ApiPageSet
	 */
	private function getPageSet() {
		if ( $this->mPageSet === null ) {
			$this->mPageSet = new ApiPageSet( $this );
		}
		return $this->mPageSet;
	}

	public function execute() {
		$params = $this->extractRequestParams();
		$result = $this->getResult();

		$continuationManager = new ApiContinuationManager( $this, [], [] );
		$this->setContinuationManager( $continuationManager );

		if ( is_null( $params['lang'] ) ) {
			$langCode = false;
		} elseif ( !Language::isValidCode( $params['lang'] ) ) {
			$this->dieWithError( [ 'apierror-invalidlang', 'lang' ] );
		} else {
			$langCode = $params['lang'];
		}

		$pageSet = $this->getPageSet();
		$pageSet->execute();
		$titles = $pageSet->getGoodTitles(); // page_id => Title object
		$missingTitles = $pageSet->getMissingTitles(); // page_id => Title object

		$legacyMode = !$this->getParameter( 'doNotIgnoreMissingTitles' );

		if ( !count( $titles ) && ( $legacyMode || !count( $missingTitles ) ) ) {
			$result->addValue( null, 'pages', (object)[] );
			$this->setContinuationManager( null );
			$continuationManager->setContinuationIntoResult( $this->getResult() );
			return;
		}

		$resp = [];

		if ( $legacyMode ) {
			/* Deprecation hidden until Wikimedia extensions and services have been converted.
			$this->addDeprecation(
				'apiwarn-templatedata-deprecation-legacyMode', 'action=templatedata&!doNotIgnoreMissingTitles'
			);
			*/
		} else {
			foreach ( $missingTitles as $missingTitleId => $missingTitle ) {
				$resp[ $missingTitleId ] = [ 'title' => $missingTitle, 'missing' => true ];
			}

			foreach ( $titles as $titleId => $title ) {
				$resp[ $titleId ] = [ 'title' => $title, 'notemplatedata' => true ];
			}
		}

		if ( count( $titles ) ) {
			$db = $this->getDB();
			$res = $db->select( 'page_props',
				[ 'pp_page', 'pp_value' ], [
					'pp_page' => array_keys( $titles ),
					'pp_propname' => 'templatedata'
				],
				__METHOD__,
				[ 'ORDER BY', 'pp_page' ]
			);

			foreach ( $res as $row ) {
				$rawData = $row->pp_value;
				$tdb = TemplateDataBlob::newFromDatabase( $rawData );
				$status = $tdb->getStatus();

				if ( !$status->isOK() ) {
					$this->dieWithError(
						[ 'apierror-templatedata-corrupt', intval( $row->pp_page ), $status->getMessage() ]
					);
				}

				if ( $langCode ) {
					$data = $tdb->getDataInLanguage( $langCode );
				} else {
					$data = $tdb->getData();
				}

				// HACK: don't let ApiResult's formatversion=1 compatibility layer mangle our booleans
				// to empty strings / absent properties
				foreach ( $data->params as &$param ) {
					$param->{ApiResult::META_BC_BOOLS} = [ 'required', 'suggested', 'deprecated' ];
				}
				unset( $param );

				$data->params->{ApiResult::META_TYPE} = 'kvp';
				$data->params->{ApiResult::META_KVP_KEY_NAME} = 'key';
				$data->params->{ApiResult::META_INDEXED_TAG_NAME} = 'param';
				ApiResult::setIndexedTagName( $data->paramOrder, 'p' );

				if ( count( $data ) ) {
					if ( !$legacyMode ) {
						unset( $resp[$row->pp_page]['notemplatedata'] );
					} else {
						$resp[ $row->pp_page ] = [ 'title' => $titles[ $row->pp_page ] ];
					}
					$resp[$row->pp_page] += (array)$data;
				}
			}
		}

		ApiResult::setArrayType( $resp, 'kvp', 'id' );
		ApiResult::setIndexedTagName( $resp, 'page' );

		// Set top level element
		$result->addValue( null, 'pages', (object)$resp );

		$values = $pageSet->getNormalizedTitlesAsResult();
		if ( $values ) {
			$result->addValue( null, 'normalized', $values );
		}
		$redirects = $pageSet->getRedirectTitlesAsResult();
		if ( $redirects ) {
			$result->addValue( null, 'redirects', $redirects );
		}

		$this->setContinuationManager( null );
		$continuationManager->setContinuationIntoResult( $this->getResult() );
	}

	public function getAllowedParams( $flags = 0 ) {
		$result = [
			'doNotIgnoreMissingTitles' => false,
			'lang' => null,
		];
		if ( $flags ) {
			$result += $this->getPageSet()->getFinalParams( $flags );
		}
		return $result;
	}

	/**
	 * @see ApiBase::getExamplesMessages()
	 * @return array
	 */
	protected function getExamplesMessages() {
		return [
			'action=templatedata&titles=Template:Stub|Template:Example&doNotIgnoreMissingTitles=1'
				=> 'apihelp-templatedata-example-1',
			'action=templatedata&titles=Template:Stub|Template:Example&doNotIgnoreMissingTitles=0'
				=> 'apihelp-templatedata-example-2',
		];
	}

	public function getHelpUrls() {
		return 'https://www.mediawiki.org/wiki/Extension:TemplateData';
	}
}
