<?php
/**
 * TemplateData extension.
 *
 * @file
 * @ingroup Extensions
 */

$wgExtensionCredits['parserhook'][] = array(
	'path'          => __FILE__,
	'name'          => 'TemplateData',
	'author'        => array( 'Timo Tijhof' ),
	'version'        => '0.1.0',
	'url'            => 'https://www.mediawiki.org/wiki/Extension:TemplateData',
	'descriptionmsg' => 'templatedata-desc',
);

/* Setup */

$dir = __DIR__;

// Register files
$wgExtensionMessagesFiles['TemplateData'] = $dir . '/TemplateData.i18n.php';
$wgAutoloadClasses['TemplateDataHooks'] = $dir . '/TemplateData.hooks.php';
$wgAutoloadClasses['TemplateDataBlob'] = $dir . '/TemplateDataBlob.php';
$wgAutoloadClasses['ApiTemplateData'] = $dir . '/api/ApiTemplateData.php';

// Register hooks
$wgHooks['ParserFirstCallInit'][] = 'TemplateDataHooks::onParserFirstCallInit';
$wgHooks['PageContentSave'][] = 'TemplateDataHooks::onPageContentSave';
$wgHooks['UnitTestsList'][] = 'TemplateDataHooks::onUnitTestsList';

// Register APIs
$wgAPIModules['templatedata'] = 'ApiTemplateData';

// Register page properties
$wgPageProps['templatedata'] = 'Content of &lt;templatedata&gt; tag';

// Register modules
$wgResourceModules['ext.templateData'] = array(
	'styles' => 'resources/ext.templateData.css',
	'position' => 'top',
	'localBasePath' => $dir,
	'remoteExtPath' => 'TemplateData',
);
