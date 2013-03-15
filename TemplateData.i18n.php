<?php
$messages = array();

/** English
 * @author Timo Tijhof
 */
$messages['en'] = array(

	// Special:Version
	'templatedata-desc' => 'Implement data storage for template parameters (using JSON)',

	// Page output for <templatedata>
	'templatedata-doc-params' => 'Template parameters',
	'templatedata-doc-param-name' => 'Name',
	'templatedata-doc-param-desc' => 'Description',
	'templatedata-doc-param-default' => 'Default',
	'templatedata-doc-param-status' => 'Status',

	// Error message for edit page
	'templatedata-invalid-parse' => 'Syntax error in JSON.',
	'templatedata-invalid-type' => 'Property "$1" is expected to be of type "$2".',
	'templatedata-invalid-missing' => 'Required property "$1" not found.',
	'templatedata-invalid-unknown' => 'Unexpected property "$1".',
	'templatedata-invalid-value' => 'Invalid value for property "$1".',
);

/** Message documentation (Message documentation)
 * @author Timo Tijhof
 */
$messages['qqq'] = array(
	'templatedata-desc' => '{{desc}}',
	'templatedata-invalid-type' => 'Error message when a property is of the wrong type.
* $1: Name of property
* $2: Expected type of property
 ',
	'templatedata-invalid-missing' => 'Error message when a required property is not found.
* $1: Name of name
* $2: Type of property',
	'templatedata-invalid-unknown' => 'Error message when an unknown property is found.
* $1: Name of property',
	'templatedata-invalid-value' => 'Error message when a property that cannot contain free-form text has an invalid value.
* $1: Name of property',
);

