<?php

namespace MediaWiki\Extension\TemplateData;

use MediaWiki\Config\Config;
use MediaWiki\Registration\ExtensionRegistry;
use MediaWiki\ResourceLoader\Context;

/**
 * @license GPL-2.0-or-later
 */
class TemplateDiscoveryConfig {

	public static function getConfig( Context $context, Config $config ): array {
		$extRegistry = ExtensionRegistry::getInstance();
		return [
			'cirrusSearchLoaded' => $extRegistry->isLoaded( 'CirrusSearch' ),
			'communityConfigurationLoaded' => $extRegistry->isLoaded( 'CommunityConfiguration' ),
			'maxFavorites' => $config->get( 'TemplateDataMaxFavorites' ),
			'categoryRootCat' => $context->msg( 'templatedata-category-rootcat' )->inContentLanguage()->text(),
		];
	}

}
