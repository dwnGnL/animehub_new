/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.indentClasses = ["ul-grey", "ul-red", "text-red", "ul-content-red", "circle", "style-none", "decimal", "paragraph-portfolio-top", "ul-portfolio-top", "url-portfolio-top", "text-grey"];
	//config.contentsCss = ["/css/bootstrap.css", "/css/styles.css"];
	config.contentsCss = ["/css/styles.css"];
	customConfig: '/js/bootstrap.min.js';
	config.bodyClass = 'mystyle';
	
config.toolbar = 'Full';
	config.protectedSource.push(/<(style)[^>]*>.*<\/style>/ig);
	config.protectedSource.push(/<(script)[^>]*>.*<\/script>/ig);// разрешить теги <script>
	config.protectedSource.push(/<(i)[^>]*>.*<\/i>/ig);// разрешить теги <i>
	config.protectedSource.push(/<\?[\s\S]*?\?>/g);// разрешить php-код
	config.protectedSource.push(/<!--dev-->[\s\S]*<!--\/dev-->/g);
	config.allowedContent = true;
	CKEDITOR.on( 'instanceReady', function( ev )
{
    ev.editor.on( 'doubleclick' , function( evt )
    {
        return false;
    });
});
	config.disableNativeSpellChecker = false;
	config.extraPlugins = 'bgimage,lineheight,tableresize,hkemoji,smiley,html5video,youtube,fakeobjects,dialog,preview,SimpleLink';
	config.fontawesomePath = '/js/ckeditor/plugins/fontawesome/font-awesome/css/font-awesome.min.css';
	config.smiley_path=CKEDITOR.basePath+'plugins/smiley/images/';
	config.smiley_images=['angel_smile.gif', 'angry_smile.gif', 'broken_heart.gif', 'cake.png', 'confused_smile.gif', 'cry_smile.gif', 'devil_smile.gif', 'embaressed_smile.gif', 'envelope.gif', 'heart.gif', 'kiss.gif', 'lightbulb.gif', 'omg_smile.gif', 'regular_smile.gif', 'sad_smile.gif', 'shades_smile.gif', 'teeth_smile.gif', 'thumbs_down.gif', 'thumbs_up.gif', 'tounge_smile.gif', 'whatchutalkingabout_smile.gif', 'wink_smile.gif','mellow.png','0.png', '1.png', '2.png', '3.png', '4.png', '5.png', '6.png', '7.png', '8.png', '9.png', '10.png', '11.png', '12.png', '13.png', '14.png', '15.png', '16.png', '17.png', '18.png', '19.png', '20.png', '21.png', '22.png', '23.png', '24.png', '25.png', '26.png', '27.png', '28.png', '29.png', '30.png', '31.png', '32.png', '33.png', '34.png', '35.png', '36.png', '37.png', '38.png', '39.png', '40.png', '41.png', '42.png', '43.png', '44.png', '45.png', '46.png', '47.png', '48.png', '49.png', '50.png', '51.png', '52.png', '53.png', '54.png', '55.png', '56.png', '57.png', '58.png', '59.png', '60.png', '61.png', '62.png', '63.png', '64.png', '65.png', '66.png', '67.png', '68.png', '69.png', '70.png', '71.png', '72.png', '73.png', '74.png', '75.png', '76.png', '77.png', '78.png', '79.png', '80.png', '81.png', '82.png', '83.png', '84.png', '85.png', '86.png', '87.png', '88.png', '89.png', '90.png', '91.png', '92.png', '93.png', '94.png', '95.png', '96.png', '97.png', '98.png', '99.png', '100.png'];
	config.smiley_descriptions=['', ':(', '', '', ':~', ':\'(', '', '', '', '', '', '', ':-O', ':-)', ':-(', '8-)', ':D', '', '', ':-P', ':|', ';-)','','', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
	config.codeSnippet_languages = {
    javascript: 'JavaScript',
    php: 'PHP',
		html: 'HTML',
		css: 'CSS',
		mysql: 'MYSQL'
	};	
	config.removePlugins = 'contextmenu, spellchecker, about, save, newpage, print, templates, scayt, flash, pagebreak,link, find, autoembed, div, find,layoutmanager,colordialog,embedbase,forms,iframe,lineheight,magicline,pagebreak,pastefromword,prism,scayt,showblocks,elementspath,liststyle,tableselection,tabletools,tableresize,contextmenu'
};
