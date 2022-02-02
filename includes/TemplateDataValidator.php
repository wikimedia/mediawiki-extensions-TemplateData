<?php

namespace MediaWiki\Extension\TemplateData;

use MediaWiki\MediaWikiServices;
use Status;
use stdClass;

class TemplateDataValidator {

	public const PREDEFINED_FORMATS = [
		'block' => "{{_\n| _ = _\n}}",
		'inline' => '{{_|_=_}}',
	];

	private const VALID_ROOT_KEYS = [
		'description',
		'params',
		'paramOrder',
		'sets',
		'maps',
		'format',
	];

	private const VALID_PARAM_KEYS = [
		'label',
		'required',
		'suggested',
		'description',
		'example',
		'deprecated',
		'aliases',
		'autovalue',
		'default',
		'inherits',
		'type',
		'suggestedvalues',
	];

	private const VALID_TYPES = [
		'content',
		'line',
		'number',
		'boolean',
		'string',
		'date',
		'unbalanced-wikitext',
		'unknown',
		'url',
		'wiki-page-name',
		'wiki-user-name',
		'wiki-file-name',
		'wiki-template-name',
	];

	private const DEPRECATED_TYPES_MAP = [
		'string/line' => 'line',
		'string/wiki-page-name' => 'wiki-page-name',
		'string/wiki-user-name' => 'wiki-user-name',
		'string/wiki-file-name' => 'wiki-file-name',
	];

	/**
	 * @param mixed $data
	 *
	 * @return Status
	 */
	public function validate( $data ): Status {
		if ( $data === null ) {
			return Status::newFatal( 'templatedata-invalid-parse' );
		}

		if ( !is_object( $data ) ) {
			return Status::newFatal( 'templatedata-invalid-type', 'templatedata', 'object' );
		}

		foreach ( $data as $key => $value ) {
			if ( !in_array( $key, self::VALID_ROOT_KEYS ) ) {
				return Status::newFatal( 'templatedata-invalid-unknown', $key );
			}
		}

		// Root.description
		if ( isset( $data->description ) ) {
			if ( !$this->isValidInterfaceText( $data->description ) ) {
				return Status::newFatal( 'templatedata-invalid-type', 'description',
					'string|object' );
			}
			$data->description = $this->normaliseInterfaceText( $data->description );
		} else {
			$data->description = null;
		}

		// Root.format
		if ( isset( $data->format ) ) {
			$f = self::PREDEFINED_FORMATS[$data->format] ?? $data->format;
			if ( !is_string( $f ) ||
				!preg_match( '/^\n?\{\{ *_+\n? *\|\n? *_+ *= *_+\n? *\}\}\n?$/', $f )
			) {
				return Status::newFatal( 'templatedata-invalid-format', 'format' );
			}
		} else {
			$data->format = null;
		}

		// Root.params
		if ( !isset( $data->params ) ) {
			return Status::newFatal( 'templatedata-invalid-missing', 'params', 'object' );
		}

		if ( !is_object( $data->params ) ) {
			return Status::newFatal( 'templatedata-invalid-type', 'params', 'object' );
		}

		// Deep clone
		// We need this to determine whether a property was originally set
		// to decide whether 'inherits' will add it or not.
		$unnormalizedParams = unserialize( serialize( $data->params ) );

		foreach ( $data->params as $paramName => $paramObj ) {
			if ( !is_object( $paramObj ) ) {
				return Status::newFatal( 'templatedata-invalid-type', "params.{$paramName}",
					'object' );
			}

			foreach ( $paramObj as $key => $value ) {
				if ( !in_array( $key, self::VALID_PARAM_KEYS ) ) {
					return Status::newFatal( 'templatedata-invalid-unknown',
						"params.{$paramName}.{$key}" );
				}
			}

			// Param.label
			if ( isset( $paramObj->label ) ) {
				if ( !$this->isValidInterfaceText( $paramObj->label ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.label", 'string|object' );
				}
				$paramObj->label = $this->normaliseInterfaceText( $paramObj->label );
			} else {
				$paramObj->label = null;
			}

			// Param.required
			if ( isset( $paramObj->required ) ) {
				if ( !is_bool( $paramObj->required ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.required", 'boolean' );
				}
			} else {
				$paramObj->required = false;
			}

			// Param.suggested
			if ( isset( $paramObj->suggested ) ) {
				if ( !is_bool( $paramObj->suggested ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.suggested", 'boolean' );
				}
			} else {
				$paramObj->suggested = false;
			}

			// Param.description
			if ( isset( $paramObj->description ) ) {
				if ( !$this->isValidInterfaceText( $paramObj->description ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.description", 'string|object' );
				}
				$paramObj->description = $this->normaliseInterfaceText( $paramObj->description );
			} else {
				$paramObj->description = null;
			}

			// Param.example
			if ( isset( $paramObj->example ) ) {
				if ( !$this->isValidInterfaceText( $paramObj->example ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.example", 'string|object' );
				}
				$paramObj->example = $this->normaliseInterfaceText( $paramObj->example );
			} else {
				$paramObj->example = null;
			}

			// Param.deprecated
			if ( isset( $paramObj->deprecated ) ) {
				if ( !is_bool( $paramObj->deprecated ) && !is_string( $paramObj->deprecated ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.deprecated", 'boolean|string' );
				}
			} else {
				$paramObj->deprecated = false;
			}

			// Param.aliases
			if ( isset( $paramObj->aliases ) ) {
				if ( !is_array( $paramObj->aliases ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.aliases", 'array' );
				}
				foreach ( $paramObj->aliases as $i => &$alias ) {
					if ( is_int( $alias ) ) {
						$alias = (string)$alias;
					} elseif ( !is_string( $alias ) ) {
						return Status::newFatal( 'templatedata-invalid-type',
							"params.{$paramName}.aliases[$i]", 'int|string' );
					}
				}
			} else {
				$paramObj->aliases = [];
			}

			// Param.autovalue
			if ( isset( $paramObj->autovalue ) ) {
				if ( !is_string( $paramObj->autovalue ) ) {
					// TODO: Validate the autovalue values.
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.autovalue", 'string' );
				}
			} else {
				$paramObj->autovalue = null;
			}

			// Param.default
			if ( isset( $paramObj->default ) ) {
				if ( !$this->isValidInterfaceText( $paramObj->default ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.default", 'string|object' );
				}
				$paramObj->default = $this->normaliseInterfaceText( $paramObj->default );
			} else {
				$paramObj->default = null;
			}

			// Param.type
			if ( isset( $paramObj->type ) ) {
				if ( !is_string( $paramObj->type ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.type", 'string' );
				}

				// Map deprecated types to newer versions
				if ( isset( self::DEPRECATED_TYPES_MAP[ $paramObj->type ] ) ) {
					$paramObj->type = self::DEPRECATED_TYPES_MAP[ $paramObj->type ];
				}

				if ( !in_array( $paramObj->type, self::VALID_TYPES ) ) {
					return Status::newFatal( 'templatedata-invalid-value',
						'params.' . $paramName . '.type' );
				}
			} else {
				$paramObj->type = 'unknown';
			}

			// Param.suggestedvalues
			if ( isset( $paramObj->suggestedvalues ) ) {
				if ( !is_array( $paramObj->suggestedvalues ) ) {
					return Status::newFatal( 'templatedata-invalid-type',
						"params.{$paramName}.suggestedvalues", 'array' );
				}
				foreach ( $paramObj->suggestedvalues as $i => $value ) {
					if ( !is_string( $value ) ) {
						return Status::newFatal( 'templatedata-invalid-type',
							"params.{$paramName}.suggestedvalues[$i]", 'string' );
					}
				}
			} else {
				$paramObj->suggestedvalues = [];
			}
		}

		// Param.inherits
		// Done afterwards to avoid code duplication
		foreach ( $data->params as $paramName => $paramObj ) {
			if ( isset( $paramObj->inherits ) ) {
				if ( !isset( $data->params->{ $paramObj->inherits } ) ) {
						return Status::newFatal( 'templatedata-invalid-missing',
							"params.{$paramObj->inherits}" );
				}
				$parentParamObj = $data->params->{ $paramObj->inherits };
				foreach ( $parentParamObj as $key => $value ) {
					if ( !in_array( $key, self::VALID_PARAM_KEYS ) ) {
						return Status::newFatal( 'templatedata-invalid-unknown', $key );
					}
					if ( !isset( $unnormalizedParams->$paramName->$key ) ) {
						$paramObj->$key = is_object( $parentParamObj->$key ) ?
							clone $parentParamObj->$key :
							$parentParamObj->$key;
					}
				}
				unset( $paramObj->inherits );
			}
		}

		// Root.paramOrder
		if ( isset( $data->paramOrder ) ) {
			if ( !is_array( $data->paramOrder ) ) {
				return Status::newFatal( 'templatedata-invalid-type', 'paramOrder', 'array' );
			}

			if ( count( $data->paramOrder ) < count( (array)$data->params ) ) {
				$firstMissing = count( $data->paramOrder );
				return Status::newFatal( 'templatedata-invalid-missing', "paramOrder[$firstMissing]" );
			}

			// Validate each of the values corresponds to a parameter and that there are no
			// duplicates
			$seen = [];
			foreach ( $data->paramOrder as $i => $param ) {
				if ( !isset( $data->params->$param ) ) {
					return Status::newFatal( 'templatedata-invalid-value', "paramOrder[$i]" );
				}
				if ( isset( $seen[$param] ) ) {
					return Status::newFatal( 'templatedata-invalid-duplicate-value',
						"paramOrder[$i]", "paramOrder[{$seen[$param]}]", $param );
				}
				$seen[$param] = $i;
			}
		}

		// Root.sets
		if ( isset( $data->sets ) ) {
			if ( !is_array( $data->sets ) ) {
				return Status::newFatal( 'templatedata-invalid-type', 'sets', 'array' );
			}
		} else {
			$data->sets = [];
		}

		foreach ( $data->sets as $setNr => $setObj ) {
			if ( !is_object( $setObj ) ) {
				return Status::newFatal( 'templatedata-invalid-value', "sets.{$setNr}" );
			}

			if ( !isset( $setObj->label ) ) {
				return Status::newFatal( 'templatedata-invalid-missing', "sets.{$setNr}.label",
					'string|object' );
			}

			if ( !$this->isValidInterfaceText( $setObj->label ) ) {
				return Status::newFatal( 'templatedata-invalid-type', "sets.{$setNr}.label",
					'string|object' );
			}

			$setObj->label = $this->normaliseInterfaceText( $setObj->label );

			if ( !isset( $setObj->params ) ) {
				return Status::newFatal( 'templatedata-invalid-missing', "sets.{$setNr}.params",
					'array' );
			}

			if ( !is_array( $setObj->params ) ) {
				return Status::newFatal( 'templatedata-invalid-type', "sets.{$setNr}.params",
					'array' );
			}

			if ( !count( $setObj->params ) ) {
				return Status::newFatal( 'templatedata-invalid-empty-array',
					"sets.{$setNr}.params" );
			}

			foreach ( $setObj->params as $i => $param ) {
				if ( !isset( $data->params->$param ) ) {
					return Status::newFatal( 'templatedata-invalid-value',
						"sets.{$setNr}.params[$i]" );
				}
			}
		}

		// Root.maps
		if ( isset( $data->maps ) ) {
			if ( !is_object( $data->maps ) ) {
				return Status::newFatal( 'templatedata-invalid-type', 'maps', 'object' );
			}
		} else {
			$data->maps = (object)[];
		}

		foreach ( $data->maps as $consumerId => $map ) {
			if ( !is_object( $map ) ) {
				return Status::newFatal( 'templatedata-invalid-type', "maps.$consumerId",
					'object' );
			}

			foreach ( $map as $key => $value ) {
				// Key is not validated as this is used by a third-party application
				// Value must be 2d array of parameter names, 1d array of parameter names, or valid
				// parameter name
				if ( is_array( $value ) ) {
					foreach ( $value as $key2 => $value2 ) {
						if ( is_array( $value2 ) ) {
							foreach ( $value2 as $key3 => $value3 ) {
								if ( !is_string( $value3 ) ) {
									return Status::newFatal( 'templatedata-invalid-type',
										"maps.{$consumerId}.{$key}[$key2][$key3]", 'string' );
								}
								if ( !isset( $data->params->$value3 ) ) {
									return Status::newFatal( 'templatedata-invalid-param', $value3,
										"maps.$consumerId.{$key}[$key2][$key3]" );
								}
							}
						} elseif ( is_string( $value2 ) ) {
							if ( !isset( $data->params->$value2 ) ) {
								return Status::newFatal( 'templatedata-invalid-param', $value2,
									"maps.$consumerId.{$key}[$key2]" );
							}
						} else {
							return Status::newFatal( 'templatedata-invalid-type',
								"maps.{$consumerId}.{$key}[$key2]", 'string|array' );
						}
					}
				} elseif ( is_string( $value ) ) {
					if ( !isset( $data->params->$value ) ) {
						return Status::newFatal( 'templatedata-invalid-param', $value,
							"maps.{$consumerId}.{$key}" );
					}
				} else {
					return Status::newFatal( 'templatedata-invalid-type',
						"maps.{$consumerId}.{$key}", 'string|array' );
				}
			}
		}
		return Status::newGood();
	}

	/**
	 * @param mixed $text
	 * @return bool
	 */
	private function isValidInterfaceText( $text ): bool {
		if ( $text instanceof stdClass ) {
			$isEmpty = true;
			// An (array) cast would return private/protected properties as well
			foreach ( get_object_vars( $text ) as $languageCode => $string ) {
				// TODO: Do we need to validate if these are known interface language codes?
				if ( !is_string( $languageCode ) ||
					ltrim( $languageCode ) === '' ||
					!is_string( $string )
				) {
					return false;
				}
				$isEmpty = false;
			}
			return !$isEmpty;
		}

		return is_string( $text );
	}

	/**
	 * Normalise a InterfaceText field in the TemplateData blob.
	 * @param stdClass|string $text
	 * @return stdClass
	 */
	private function normaliseInterfaceText( $text ): stdClass {
		if ( is_string( $text ) ) {
			$contLang = MediaWikiServices::getInstance()->getContentLanguage();
			return (object)[ $contLang->getCode() => $text ];
		}
		return $text;
	}

}
