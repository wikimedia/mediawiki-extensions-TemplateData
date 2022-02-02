<?php

namespace MediaWiki\Extension\TemplateData;

use Html;
use Language;
use stdClass;

class TemplateDataHtmlFormatter {

	/**
	 * @param stdClass $data
	 * @param Language $lang
	 *
	 * @return string
	 */
	public function getHtml( stdClass $data, Language $lang ): string {
		if ( is_string( $data->format ) && isset( TemplateDataValidator::PREDEFINED_FORMATS[$data->format] ) ) {
			// The following icon names are used here:
			// * template-format-block
			// * template-format-inline
			$icon = 'template-format-' . $data->format;
			$formatMsg = $data->format;
		} else {
			$icon = 'settings';
			$formatMsg = $data->format ? 'custom' : null;
		}
		$sorting = count( (array)$data->params ) > 1 ? " sortable" : "";
		$html = '<header>'
			. Html::element( 'p',
				[
					'class' => [
						'mw-templatedata-doc-desc',
						'mw-templatedata-doc-muted' => $data->description === null,
					]
				],
				$data->description ??
					wfMessage( 'templatedata-doc-desc-empty' )->inLanguage( $lang )->text()
			)
			. '</header>'
			. '<table class="wikitable mw-templatedata-doc-params' . $sorting . '">'
			. Html::rawElement( 'caption', [],
				Html::element( 'p', [],
					wfMessage( 'templatedata-doc-params' )->inLanguage( $lang )->text()
				)
				. ( $formatMsg !== null ?
					Html::rawElement( 'p', [],
						new \OOUI\IconWidget( [ 'icon' => $icon ] )
						. Html::element(
							'span',
							[ 'class' => 'mw-templatedata-format' ],
							// Messages that can be used here:
							// * templatedata-doc-format-block
							// * templatedata-doc-format-custom
							// * templatedata-doc-format-inline
							wfMessage( 'templatedata-doc-format-' . $formatMsg )->inLanguage( $lang )->text()
						)
					) :
					''
				)
			)
			. '<thead><tr>'
			. Html::element( 'th', [ 'colspan' => 2 ],
				wfMessage( 'templatedata-doc-param-name' )->inLanguage( $lang )->text()
			)
			. Html::element( 'th', [],
				wfMessage( 'templatedata-doc-param-desc' )->inLanguage( $lang )->text()
			)
			. Html::element( 'th', [],
				wfMessage( 'templatedata-doc-param-type' )->inLanguage( $lang )->text()
			)
			. Html::element( 'th', [],
				wfMessage( 'templatedata-doc-param-status' )->inLanguage( $lang )->text()
			)
			. '</tr></thead>'
			. '<tbody>';

		if ( count( (array)$data->params ) === 0 ) {
			// Display no parameters message
			$html .= '<tr>'
			. Html::element( 'td',
				[
					'class' => 'mw-templatedata-doc-muted',
					'colspan' => 7
				],
				wfMessage( 'templatedata-doc-no-params-set' )->inLanguage( $lang )->text()
			)
			. '</tr>';
		}

		$paramNames = $data->paramOrder ?? array_keys( (array)$data->params );
		foreach ( $paramNames as $paramName ) {
			$paramObj = $data->params->$paramName;

			$aliases = '';
			if ( count( $paramObj->aliases ) ) {
				foreach ( $paramObj->aliases as $alias ) {
					$aliases .= wfMessage( 'word-separator' )->inLanguage( $lang )->escaped()
					. Html::element( 'code', [ 'class' => 'mw-templatedata-doc-param-alias' ],
						$alias
					);
				}
			}

			$suggestedValuesLine = '';
			if ( $paramObj->suggestedvalues ) {
				$suggestedValues = '';
				foreach ( $paramObj->suggestedvalues as $suggestedValue ) {
					$suggestedValues .= wfMessage( 'word-separator' )->inLanguage( $lang )->escaped()
						. Html::element( 'code', [ 'class' => 'mw-templatedata-doc-param-alias' ],
							$suggestedValue
						);
				}
				$suggestedValuesLine .= Html::element( 'dt', [],
						wfMessage( 'templatedata-doc-param-suggestedvalues' )->inLanguage( $lang )->text()
					) . Html::rawElement( 'dd', [], $suggestedValues );
			}

			if ( $paramObj->deprecated ) {
				$status = 'deprecated';
			} elseif ( $paramObj->required ) {
				$status = 'required';
			} elseif ( $paramObj->suggested ) {
				$status = 'suggested';
			} else {
				$status = 'optional';
			}

			$html .= '<tr>'
			// Label
			. Html::element( 'th', [], $paramObj->label ?? $paramName )
			// Parameters and aliases
			. Html::rawElement( 'td', [ 'class' => 'mw-templatedata-doc-param-name' ],
				Html::element( 'code', [], $paramName ) . $aliases
			)
			// Description
			. Html::rawElement( 'td', [
					'class' => [
						'mw-templatedata-doc-muted' => ( $paramObj->description === null )
					]
				],
				Html::element( 'p', [],
					$paramObj->description ??
						wfMessage( 'templatedata-doc-param-desc-empty' )->inLanguage( $lang )->text()
				)
				. Html::rawElement( 'dl', [],
					// Suggested Values
					$suggestedValuesLine .
					// Default
					( $paramObj->default !== null ? ( Html::element( 'dt', [],
						wfMessage( 'templatedata-doc-param-default' )->inLanguage( $lang )->text()
					)
					. Html::element( 'dd', [],
						$paramObj->default
					) ) : '' )
					// Example
					. ( $paramObj->example !== null ? ( Html::element( 'dt', [],
						wfMessage( 'templatedata-doc-param-example' )->inLanguage( $lang )->text()
					)
					. Html::element( 'dd', [],
						$paramObj->example
					) ) : '' )
					// Auto value
					. ( $paramObj->autovalue !== null ? ( Html::element( 'dt', [],
						wfMessage( 'templatedata-doc-param-autovalue' )->inLanguage( $lang )->text()
					)
					. Html::rawElement( 'dd', [],
						Html::element( 'code', [], $paramObj->autovalue )
					) ) : '' )
				)
			)
			// Type
			. Html::element( 'td',
				[
					'class' => [
						'mw-templatedata-doc-param-type',
						'mw-templatedata-doc-muted' => $paramObj->type === 'unknown'
					]
				],
				// Known messages, for grepping:
				// templatedata-doc-param-type-boolean, templatedata-doc-param-type-content,
				// templatedata-doc-param-type-date, templatedata-doc-param-type-line,
				// templatedata-doc-param-type-number, templatedata-doc-param-type-string,
				// templatedata-doc-param-type-unbalanced-wikitext, templatedata-doc-param-type-unknown,
				// templatedata-doc-param-type-url, templatedata-doc-param-type-wiki-file-name,
				// templatedata-doc-param-type-wiki-page-name, templatedata-doc-param-type-wiki-template-name,
				// templatedata-doc-param-type-wiki-user-name
				wfMessage( 'templatedata-doc-param-type-' . $paramObj->type )->inLanguage( $lang )->text()
			)
			// Status
			. Html::element( 'td',
				[
					// CSS class names that can be used here:
					// mw-templatedata-doc-param-status-deprecated
					// mw-templatedata-doc-param-status-optional
					// mw-templatedata-doc-param-status-required
					// mw-templatedata-doc-param-status-suggested
					'class' => "mw-templatedata-doc-param-status-$status",
					'data-sort-value' => [
						'deprecated' => -1,
						'suggested' => 1,
						'required' => 2,
					][$status] ?? 0,
				],
				// Messages that can be used here:
				// templatedata-doc-param-status-deprecated
				// templatedata-doc-param-status-optional
				// templatedata-doc-param-status-required
				// templatedata-doc-param-status-suggested
				wfMessage( "templatedata-doc-param-status-$status" )->inLanguage( $lang )->text()
			)
			. '</tr>';
		}
		$html .= '</tbody></table>';

		return Html::rawElement( 'section', [ 'class' => 'mw-templatedata-doc-wrap' ], $html );
	}

}
