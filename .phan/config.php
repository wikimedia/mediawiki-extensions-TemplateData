<?php

$cfg = require __DIR__ . '/../vendor/mediawiki/mediawiki-phan-config/src/config.php';

$cfg['exclude_file_list'] = array_merge(
	$cfg['exclude_file_list'],
	[
		'includes/Config/FeaturedTemplatesSchemaValidator.php',
	]
);

$cfg['directory_list'] = array_merge(
	$cfg['directory_list'],
	[
		'../../extensions/CommunityConfiguration',
	]
);

$cfg['exclude_analysis_directory_list'] = array_merge(
	$cfg['exclude_analysis_directory_list'],
	[
		'../../extensions/CommunityConfiguration',
	]
);

return $cfg;
