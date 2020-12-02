function logEvent( eventName ) {
	mw.track( 'event.TemplateDataEditor', {
		/* eslint-disable camelcase */
		action: eventName,
		page_id: mw.config.get( 'wgArticleId' ),
		page_title: mw.config.get( 'wgPageName' ),
		page_namespace: mw.config.get( 'wgNamespaceNumber' ),
		rev_id: mw.config.get( 'wgCurRevisionId' ),
		user_edit_count: mw.config.get( 'wgUserEditCount', 0 ),
		user_id: mw.user.getId()
		/* eslint-enable camelcase */
	} );
}

module.exports = {
	logEvent: logEvent
};
