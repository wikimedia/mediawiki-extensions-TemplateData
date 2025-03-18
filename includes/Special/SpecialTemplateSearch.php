<?php
namespace MediaWiki\Extension\TemplateData\Special;

use MediaWiki\Html\Html;
use MediaWiki\SpecialPage\SpecialPage;

/**
 * @license GPL-2.0-or-later
 */
class SpecialTemplateSearch extends SpecialPage {

	public function __construct() {
		parent::__construct( 'TemplateSearch', '', false );
	}

	/**
	 * @inheritDoc
	 */
	public function execute( $par ) {
		$output = $this->getOutput();
		$this->setHeaders();
		if ( $this->getConfig()->get( 'TemplateDataEnableDiscovery' ) ) {
			$output->addHTML(
				Html::element( 'div', [ 'id' => 'ext-TemplateData-SpecialTemplateSearch-widget' ] )
			);
			$output->addModules( 'ext.templateData.templateDiscovery' );
		} else {
			$output->addWikiTextAsInterface( $this->msg( 'templatedata-template-discovery-disabled' )->text() );
		}
	}

}
