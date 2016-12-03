/**
 * Template data edit ui target
 *
 * @class
 * @abstract
 * @extends OO.ui.Element
 * @mixin OO.EventEmitter
 *
 * @constructor
 */
mw.TemplateData.Target = function mwTemplateDataTarget() {
	// Parent constructor
	mw.TemplateData.Target.super.apply( this, arguments );

	// Mixin constructor
	OO.EventEmitter.call( this );

	this.$element.addClass( 'tdg-editscreen-main' );
	// TODO: Move more init code into this class
};

/* Inheritance */

OO.inheritClass( mw.TemplateData.Target, OO.ui.Element );

OO.mixinClass( mw.TemplateData.Target, OO.EventEmitter );

/* Methods */

/**
 * Get wikitext from the editor
 *
 * @method
 * @abstract
 * @return {string} Wikitext
 */
mw.TemplateData.Target.prototype.getWikitext = null;

/**
 * Write wikitext back to the target
 *
 * @method
 * @abstract
 * @param {string} newWikitext New wikitext
 */
mw.TemplateData.Target.prototype.setWikitext = null;

/**
 * Textarea target
 *
 * @class
 * @extends mw.TemplateData.Target
 *
 * @constructor
 * @param {jQuery} $textarea Editor textarea
 */
mw.TemplateData.TextareaTarget = function mwTemplateDataTextareaTarget( $textarea ) {
	// Parent constructor
	mw.TemplateData.TextareaTarget.super.call( this );

	this.$textarea = $textarea;
};

/* Inheritance */

OO.inheritClass( mw.TemplateData.TextareaTarget, mw.TemplateData.Target );

mw.TemplateData.TextareaTarget.prototype.getWikitext = function () {
	return this.$textarea.val();
};

mw.TemplateData.TextareaTarget.prototype.setWikitext = function ( newWikitext ) {
	this.$textarea.val( newWikitext );
};
