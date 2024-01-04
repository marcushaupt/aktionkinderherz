<?php
/**
* @version $Id: fckeditor.php, v 1.2.0 19:23 20.05.2006
* based on Angel Franco Calixto's fckeditor mambot
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$_MAMBOTS->registerFunction( 'onInitEditor', 'botInitEditor' );
$_MAMBOTS->registerFunction( 'onEditorArea', 'botEditorArea' );
$_MAMBOTS->registerFunction( 'onGetEditorContents', 'botGetEditorContents' );

function botInitEditor() {
	global $mosConfig_live_site;
return <<<EOD
<script type="text/javascript" src="$mosConfig_live_site/mambots/editors/fckeditor/fckeditor.js">
</script>
EOD;
}

function botEditorArea( $name, $content, $hiddenField, $width, $height, $col, $row ) {
	global $mosConfig_live_site, $database, $option, $_MAMBOTS, $mosConfig_absolute_path;

	$content = str_replace("&lt;", "<", $content);
	$content = str_replace("&gt;", ">", $content);
	$content = str_replace("&amp;", "&", $content);
	$content = str_replace("&nbsp;", " ", $content);
	$content = str_replace("&quot;", "\"", $content);
	
	$mainframe = new mosMainFrame( $database, $option, '.' );
	 
    $query = "SELECT id FROM #__mambots WHERE element = 'fckeditor' AND folder = 'editors'";
	$database->setQuery( $query );
	$id = $database->loadResult();
	$mambot = new mosMambot( $database );
	$mambot->load( $id );
	$params =& new mosParameters( $mambot->params );

	$toolbar = $params->get( 'toolbar', 'Compact' );
	$content_css = $params->get( 'content_css', '0' );
	$content_css_custom = $params->get( 'content_css_custom', '' );
	$text_direction	= $params->get( 'text_direction', 'ltr' );
	$newlines = $params->get( 'newlines', 'false' );
	$skin = $params->get( 'skin', 'default' );
	$wwidth = $params->get( 'wwidth', '480' );
	$hheight = $params->get( 'hheight', '480' );
	
	if ( $content_css ) {
		$template = $mainframe->getTemplate();
		
		$file = $mosConfig_absolute_path ."/templates/". $template ."/css/editor_content.css";
		if ( file_exists( $file ) ) {
			$content_css = 'templates/'.$template.'/css/editor_content.css';
		} else {
			$content_css = 'templates/'.$template.'/css/template_css.css';
		}
	} else {
		if ( $content_css_custom ) {
			$content_css = $content_css_custom;
		} else {
			$content_css = 'mambots/editors/fckeditor/editor/css/fck_editorarea.css';
		}
	}	
	
	if ( strpos( $width, '%' ) === false )
		$WidthCSS = $width . 'px' ;
	else
		$WidthCSS = $width ;

	if ( strpos( $height, '%' ) === false )
		$HeightCSS = $height . 'px' ;
	else
		$HeightCSS = $height ;
		
	$results = $_MAMBOTS->trigger( 'onCustomEditorButton' );
	$buttons = array();
	foreach ($results as $result) {
		if ( $result[0] ) {
			$buttons[] = '<img src="'.$mosConfig_live_site.'/mambots/editors-xtd/'.$result[0].'" onclick="InsertHTML(\''.$hiddenField.'\',\''.$result[1].'\')" />';
		}
	}
	$buttons = implode("", $buttons);		

return <<<EOD
<textarea name="$hiddenField" id="$hiddenField" cols="$col" rows="$row" style="width:{$WidthCSS}; height:{$HeightCSS};">$content</textarea>

<script type="text/javascript">
        var oFCKeditor = new FCKeditor('$hiddenField');
		oFCKeditor.BasePath = "$mosConfig_live_site/mambots/editors/fckeditor/" ;
		oFCKeditor.Config["CustomConfigurationsPath"] = oFCKeditor.BasePath + "joomlafckconfig.js";
		oFCKeditor.ToolbarSet = "$toolbar" ;
		oFCKeditor.Config['UseBROnCarriageReturn'] = "$newlines" ;
		oFCKeditor.Config['EditorAreaCSS'] = "$mosConfig_live_site/$content_css";
		oFCKeditor.Config['ContentLangDirection'] = "$text_direction" ;
		oFCKeditor.Config['SkinPath'] = oFCKeditor.BasePath + 'editor/skins/' + '$skin' + '/' ;
		oFCKeditor.Width = "$wwidth" ;
		oFCKeditor.Height = "$hheight" ;
		oFCKeditor.ReplaceTextarea() ;
		
		function InsertHTML(field, value) {
		// Get the editor instance that we want to interact with.
		var oEditor = FCKeditorAPI.GetInstance(field) ;

		// Check the active editing mode.
		if ( oEditor.EditMode == FCK_EDITMODE_WYSIWYG )
		{
			// Insert the desired HTML.
			oEditor.InsertHtml( value ) ;
		}
		else
			alert( 'Please switch to WYSIWYG mode.' ) ;
}
</script>
<br />
<p>$buttons</p>
EOD;
}

function botGetEditorContents($editorArea, $hiddenField) {

}
?>