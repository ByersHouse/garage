/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'ru';
	// config.uiColor = '#AADC6E';
	config.enterMode = CKEDITOR.ENTER_BR;
	CKEDITOR.dtd.$removeEmpty.span = 0;
	config.extraPlugins = 'codemirror';
	config.protectedSource.push(/<i[^>]*><\/i>/g);
};
