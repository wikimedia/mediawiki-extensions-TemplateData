<?php
/**
 * @file
 * @ingroup Extensions
 */

/**
 * Represents the information about a template,
 * coming from the JSON blob in the <templatedata> tags
 * on wiki pages.
 *
 * @class
 */
class TemplateDataBlob {

	/**
	 * @var stdClass
	 */
	private $data;

	/**
	 * @var Status: Cache of TemplateInfo::validate
	 */
	private $status;

	/**
	 *  @param string $json
	 * @return TemplateInfo
	 */
	public static function newFromJSON( $json ) {
		$tdb = new self( json_decode( $json ) );
		$status = $tdb->parse();

		if ( !$status->isOK() ) {
			// Don't save invalid data, clear it.
			$tdb->data = new stdClass();
		}
		$tdb->status = $status;
		return $tdb;
	}

	/**
	 * Parse the data, normalise it and validate it.
	 *
	 * See spec.templatedata.json for the expected format of the JSON object.
	 * @return Status
	 */
	private function parse() {
		$data = $this->data;

		static $rootKeys = array(
			'params',
			'description',
		);
		static $paramKeys = array(
			// 'label',
			'required',
			'description',
			'deprecated',
			'aliases',
			'default',
			'inherits',
			// 'type',
		);

		if ( $data === null ) {
			return Status::newFatal( 'templatedata-invalid-parse' );
		}

		if ( !is_object( $data ) ) {
			return Status::newFatal( 'templatedata-invalid-type', 'templatedata', 'object' );
		}

		foreach ( $data as $key => $value ) {
			if ( !in_array( $key, $rootKeys ) ) {
				return Status::newFatal( 'templatedata-invalid-unknown', $key );
			}
		}

		// Root.description
		if ( isset( $data->description ) ) {
			if ( !is_object( $data->description ) && !is_string( $data->description ) ) {
				return Status::newFatal( 'templatedata-invalid-type', 'description', 'string|object' );
			}
			$data->description = self::normaliseInterfaceText( $data->description );
		} else {
			$data->description = self::normaliseInterfaceText( '' );
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
				return Status::newFatal( 'templatedata-invalid-type', 'params.' . $paramName, 'object' );
			}

			foreach ( $paramObj as $key => $value ) {
				if ( !in_array( $key, $paramKeys ) ) {
					return Status::newFatal( 'templatedata-invalid-unknown', $key );
				}
			}

			// TODO: Param.label

			// Param.required
			if ( isset( $paramObj->required ) ) {
				if ( !is_bool( $paramObj->required ) ) {
					return Status::newFatal( 'templatedata-invalid-type', 'params.' . $paramName . '.required', 'boolean' );
				}
			} else {
				$paramObj->required = false;
			}

			// Param.description
			if ( isset( $paramObj->description ) ) {
				if ( !is_object( $paramObj->description ) && !is_string( $paramObj->description ) ) {
					// TODO: Also validate that if it is an object, the keys are valid lang codes
					// and the values strings.
					return Status::newFatal( 'templatedata-invalid-type', 'params.' . $paramName . '.description', 'string|object' );
				}
				$paramObj->description = self::normaliseInterfaceText( $paramObj->description );
			} else {
				$paramObj->description = self::normaliseInterfaceText( '' );
			}

			// Param.deprecated
			if ( isset( $paramObj->deprecated ) ) {
				if ( $paramObj->deprecated !== false && !is_string( $paramObj->deprecated ) ) {
					return Status::newFatal( 'templatedata-invalid-type', 'params.' . $paramName . '.deprecated', 'boolean|string' );
				}
			} else {
				$paramObj->deprecated = false;
			}

			// Param.aliases
			if ( isset( $paramObj->aliases ) ) {
				if ( !is_array( $paramObj->aliases ) ) {
					// TODO: Validate the array values.
					return Status::newFatal( 'templatedata-invalid-type', 'params.' . $paramName . '.aliases', 'array' );
				}
			} else {
				$paramObj->aliases = array();
			}

			// Param.default
			if ( isset( $paramObj->default ) ) {
				if ( !is_string( $paramObj->default ) ) {
					return Status::newFatal( 'templatedata-invalid-type', 'params.' . $paramName . '.default', 'string' );
				}
			} else {
				$paramObj->default = '';
			}

			// TODO: Param.type
		}

		// Param.inherits
		// Done afterwards to avoid code duplication
		foreach ( $data->params as $paramName => $paramObj ) {
			if ( isset( $paramObj->inherits ) ) {
				if ( !isset( $data->params->{ $paramObj->inherits } ) ) {
						return Status::newFatal( 'templatedata-invalid-missing', "params.{$paramObj->inherits}" );
				}
				$parentParamObj = $data->params->{ $paramObj->inherits };
				foreach ( $parentParamObj as $key => $value ) {
					if ( !in_array( $key, $paramKeys ) ) {
						return Status::newFatal( 'templatedata-invalid-unknown', $key );
					}
					if ( !isset( $unnormalizedParams->$paramName->$key ) ) {
						$paramObj->$key = is_object( $parentParamObj->$key ) ? clone $parentParamObj->$key : $parentParamObj->$key;
					}
				}
				unset( $paramObj->inherits );
			}
		}

		// TODO: Root.sets

		return Status::newGood();
	}

	/**
	 * Normalise a InterfaceText field in the TemplateData blob.
	 * @return stdClass|string $text
	 */
	protected static function normaliseInterfaceText( $text ) {
		if ( is_string( $text ) ) {
			global $wgContLang;
			$ret = array();
			$ret[ $wgContLang->getCode() ] = $text;
			return (object) $ret;
		}
		return $text;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getData() {
		// Returned by reference. Data is a private member. Use clone instead?
		return $this->data;
	}

	/**
	 * @return string JSON
	 */
	public function getJSON() {
		return json_encode( $this->data );
	}

	public function getHtml( IContextSource $context ) {
		global $wgContLang;
		$langCode = $wgContLang->getCode();
		$data = $this->data;
		$html =
			Html::openElement( 'div', array( 'class' => 'mw-templatedata-doc-wrap' ) )
			. Html::element( 'p', array( 'class' => 'mw-templatedata-doc-desc' ), $data->description->$langCode )
			. '<table class="wikitable sortable mw-templatedata-doc-params">'
			. Html::element( 'caption', array(), $context->msg( 'templatedata-doc-params' ) )
			. '<thead><tr>'
			. Html::element( 'th', array(), $context->msg( 'templatedata-doc-param-name' ) )
			. Html::element( 'th', array(), $context->msg( 'templatedata-doc-param-desc' ) )
			. Html::element( 'th', array(), $context->msg( 'templatedata-doc-param-default' ) )
			. Html::element( 'th', array(), $context->msg( 'templatedata-doc-param-status' ) )
			. '</tr></thead>'
			. '<tbody>'
			;
		foreach ( $data->params as $paramName => $paramObj ) {
			$description = '';
			$default = '';
			$html .= '<tr>'
			. Html::element( 'th', array(), $paramName )
			// Description
			. Html::rawElement( 'td', array(
				'class' => array(
					'mw-templatedata-doc-param-empty' => !isset( $paramObj->description->$langCode ) && $paramObj->deprecated === false
				)
			), isset( $paramObj->description->$langCode ) ? $paramObj->description->$langCode : 'no description' )
			// Default
			. Html::element( 'td', array(
				'class' => array(
					'mw-templatedata-doc-param-empty' => $paramObj->default === ''
				)
			), $paramObj->default !== '' ? $paramObj->default : 'empty' )
			// Status
			. Html::element( 'td', array(),
				$paramObj->deprecated ? 'deprecated' : (
					$paramObj->required ? 'required' : 'optional'
				)
			)
			. '</tr>';
		}
		$html .= '</tbody></table>'
			. Html::closeElement( 'div' );

		return $html;
	}

	private function __construct( $data = null ) {
		$this->data = $data;
	}

}
