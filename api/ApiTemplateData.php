<?php
/**
 * Implement the 'templatedata' query module in the API.
 * Format JSON only.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

/**
 * @ingroup API
 * @emits error.code templatedata-corrupt
 */
class ApiTemplateData extends ApiBase {

	/**
	 * Override built-in handling of format parameter.
	 * Only JSON is supported.
	 *
	 * @return ApiFormatBase
	 */
	public function getCustomPrinter() {
		$params = $this->extractRequestParams();
		$format = $params['format'];
		$allowed = array( 'json', 'jsonfm' );
		if ( in_array( $format, $allowed ) ) {
			return $this->getMain()->createPrinterByName( $format );
		}
		return $this->getMain()->createPrinterByName( $allowed[0] );
	}

	/**
	 * @return ApiPageSet
	 */
	private function getPageSet() {
		if ( !isset( $this->mPageSet ) ) {
			$this->mPageSet = new ApiPageSet( $this );
		}
		return $this->mPageSet;
	}

	public function execute() {
		$params = $this->extractRequestParams();
		$result = $this->getResult();

		$pageSet = $this->getPageSet();
		$pageSet->execute();
		$titles = $pageSet->getGoodTitles(); // page_id => Title object

		if ( !count( $titles ) ) {
			$result->addValue( null, 'pages', (object) array() );
			return;
		}

		$db = $this->getDB();
		$res = $db->select( 'page_props',
			array( 'pp_page', 'pp_value' ), array(
				'pp_page' => array_keys( $titles ),
				'pp_propname' => 'templatedata'
			),
			__METHOD__,
			array( 'ORDER BY', 'pp_page' )
		);

		$resp = array();

		foreach ( $res as $row ) {
			$rawData = $row->pp_value;
			$tdb = TemplateDataBlob::newFromJSON( $rawData );
			$status = $tdb->getStatus();
			if ( !$status->isOK() ) {
				$this->dieUsage(
					'Page #' . intval( $row->pp_page ) . ' templatedata contains invalid data:'
						. $status->getMessage(), 'templatedata-corrupt'
				);
			}
			$data = $tdb->getData();
			$resp[$row->pp_page] = array(
				'title' => strval( $titles[$row->pp_page] ),
				'params' => $data->params,
			);
		}

		// Set top level element
		$result->addValue( null, 'pages', (object) $resp );

		$values = $pageSet->getNormalizedTitlesAsResult();
		if ( $values ) {
			$result->addValue( null, 'normalized', $values );
		}
	}

	public function getAllowedParams( $flags = 0 ) {
		return $this->getPageSet()->getFinalParams( $flags ) + array(
			'format' => array(
				ApiBase::PARAM_DFLT => 'json',
				ApiBase::PARAM_TYPE => array( 'json', 'jsonfm' ),
			)
		);
	}

	public function getParamDescription() {
		return $this->getPageSet()->getParamDescription() + array(
			'format' => 'The format of the output',
		);
	}

	public function getDescription() {
		return 'Data stored by the TemplateData extension';
	}

	public function getPossibleErrors() {
		return array_merge(
			parent::getPossibleErrors(),
			$this->getPageSet()->getPossibleErrors()
		);
	}

	public function getExamples() {
		return array(
			'api.php?action=templatedata&titles=Template:Stub|Template:Example',
		);
	}

	public function getHelpUrls() {
		return 'https://www.mediawiki.org/Extension:TemplateData';
	}
}
