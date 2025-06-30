<?php
namespace MediaWiki\Extension\TemplateData;

use MediaWiki\Config\Config;
use MediaWiki\Extension\CommunityConfiguration\Hooks\CommunityConfigurationProvider_initListHook;

/**
 * @license GPL-2.0-or-later
 */
class CommunityConfigurationHooks implements
	CommunityConfigurationProvider_initListHook
{
	private Config $config;

	public function __construct( Config $config ) {
		$this->config = $config;
	}

	/**
	 * @inheritDoc
	 */
	public function onCommunityConfigurationProvider_initList( array &$providers ) {
		if ( !$this->config->get( 'TemplateDataEnableFeaturedTemplates' ) ) {
			unset( $providers['TemplateData-FeaturedTemplates'] );
		}
	}

}
