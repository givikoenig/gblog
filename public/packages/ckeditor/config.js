/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

config.extraPlugins = 'codemirror';
config.codemirror_theme = 'rubyblue';
config.codemirror = {
    lineNumbers: true,
    highlightActiveLine: true,
    enableSearchTools: true,
    showSearchButton: true,
    showFormatButton: true,
    showCommentButton: true,
    showUncommentButton: true,
    showAutoCompleteButton: true
};

config.allowedContent = true;
config.basicEntities = false;


config.filebrowserBrowseUrl = 'http://givik.ru/packages/kcfinder/browse.php?opener=ckeditor&type=files';
config.filebrowserImageBrowseUrl = 'http://givik.ru/packages/kcfinder/browse.php?opener=ckeditor&type=images';
config.filebrowserFlashBrowseUrl = 'http://givik.ru/packages/kcfinder/browse.php?opener=ckeditor&type=flash';
config.filebrowserUploadUrl = 'http://givik.ru/packages/kcfinder/upload.php?opener=ckeditor&type=files';
config.filebrowserImageUploadUrl = 'http://givik.ru/packages/kcfinder/upload.php?opener=ckeditor&type=images';
config.filebrowserFlashUploadUrl = 'http://givik.ru/packages/kcfinder/upload.php?opener=ckeditor&type=flash';
};
