<?php
/**
 * Implement the 'templatedata' query module in the API.
 * Format JSON only.
 *
 * @ingroup API
 * @emits error.code templatedata-corrupt
 */
class ApiQueryTemplateData extends ApiQueryBase {

	public function __construct( $query, $module ) {
		parent::__construct( $query, $module, 'td' );
	}

	/**
	 * TODO: This currently outputs it in an ugly '*' property
	 * and it fails in formats like XML (works in JSON/YAML).
	 */
	public function execute() {
		$params = $this->extractRequestParams();
		$titles = $this->getPageSet()->getGoodTitles(); // page_id => Title object

		if ( !count( $titles ) ) {
			return;
		}

		$this->addTables( 'page_props' );
		$this->addFields( array( 'pp_page', 'pp_value' ) );
		$this->addWhere( array(
			'pp_page' => array_keys( $titles ),
			'pp_propname' => 'templatedata'
		) );
		$this->addOption( 'ORDER BY', 'pp_page' );

		if ( $params['continue'] !== null ) {
			$fromid = intval( $params['continue'] );
			$this->addWhere( "pp_page >= $fromid" );
		}

		$res = $this->select( __METHOD__ );
		foreach ( $res as $row ) {
			$rawData = $row->pp_value;
			$data = json_decode( $rawData );

			if ( !$data ) {
				$this->dieUsage( 'Database data is corrupted.', 'templatedata-corrupt' );
			}
			$value = array();
			ApiResult::setContent( $value, $data->params, 'params' );

			$fit = $this->addPageSubItems( $row->pp_page, $value );

			if ( !$fit ) {
				$this->setContinueEnumParameter( 'continue', $row->pp_page );
				break;
			}
		}
	}

	public function getAllowedParams() {
		return array(
			'continue' => null,
		);
	}

	public function getParamDescription() {
		return array(
			'continue' => 'When more results are available, use this to continue',
		);
	}

	public function getDescription() {
		return 'Data stored by the TemplateData extension (https://www.mediawiki.org/Extension:TemplateData)';
	}

	// getPossibleErrors() is provided by ApiQueryBase

	protected function getExamples() {
		return array(
			'api.php?action=query&prop=templatedata&titles=Template:Stub|Template:Example',
		);
	}
}
