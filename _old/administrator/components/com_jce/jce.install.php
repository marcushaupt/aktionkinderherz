<?php
// Don't allow direct linking
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function com_install(){
//db operations
	global $database, $mosConfig_absolute_path;

	$database->setQuery( "SELECT id FROM #__components WHERE name= 'JCE Admin'" );
	$id = $database->loadResult();

	//remove admin menu images
	$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/blank.png' WHERE parent = '$id'" );
	$database->query();

	//add new admin menu images
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/controlpanel.png' WHERE parent='$id' AND name = 'JCE Konfiguration'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/language.png' WHERE parent='$id' AND name = 'JCE Sprachen'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/add_section.png' WHERE parent='$id' AND name = 'JCE Plugins'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/content.png' WHERE parent='$id' AND name = 'JCE Layout'");
	$database->query();
	
	//Install Default English Language
	$database->setQuery( "INSERT INTO #__jce_langs VALUES ('', 'German', 'de', '1')" );
	$database->query();
	
	//Install Default Plugins
    //Commands
    
    //Plugins
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Kontext Men&uuml;', 'contextmenu', 'plugin', '', '', 18, 0, 0, 0, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Textrichtung', 'directionality', 'plugin', 'ltr,rtl', 'directionality', 18, 3, 8, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Emotions', 'emotions', 'plugin', 'emotions', 'emotions', 18, 4, 14, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Vollbild', 'fullscreen', 'plugin', 'fullscreen', 'fullscreen', 18, 4, 6, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Einf&uuml;gen', 'paste', 'plugin', 'pasteword,pastetext', 'paste', 18, 1, 16, 1, 1, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Vorschau', 'preview', 'plugin', 'preview', 'preview', 18, 4, 1, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Tabellen', 'table', 'plugin', 'tablecontrols', 'buttons', 18, 2, 8, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Drucken', 'print', 'plugin', 'print', 'print', 18, 4, 3, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Suchen Ersetzen', 'searchreplace', 'plugin', 'search,replace', 'searchreplace', 18, 1, 17, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    //Commands
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Textfarbe', 'forecolor', 'command', 'forecolor', 'forecolor', 18, 3, 4, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Fett', 'bold', 'command', 'bold', 'bold', 18, 1, 5, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Kursiv', 'italic', 'command', 'italic', 'italic', 18, 1, 6, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Unterstrichen', 'underline', 'command', 'underline', 'underline', 18, 1, 7, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Text Hintergrundfarbe', 'backcolor', 'command', 'backcolor', 'backcolor', 18, 3, 5, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Link aufheben', 'unlink', 'command', 'unlink', 'unlink', 18, 2, 11, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Schriftartauswahl', 'fontselect', 'command', 'fontselect', 'fontselect', 18, 3, 2, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Schriftfarbenauswahl', 'fontsizeselect', 'command', 'fontsizeselect', 'fontsizeselect', 18, 3, 3, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Styleauswahl', 'styleselect', 'command', 'styleselect', 'styleselect', 18, 3, 1, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Neues Dokument, 'newdocument', 'command', 'newdocument', 'newdocument', 18, 1, 4, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Hilfe', 'help', 'command', 'help', 'help', 18, 1, 3, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Durchgestrichen', 'strikethrough', 'command', 'strikethrough', 'strikethrough', 18, 1, 12, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Einr&uuml;ckung', 'indent', 'command', 'indent', 'indent', 18, 1, 11, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Ausr&uuml;ckung', 'outdent', 'command', 'outdent', 'outdent', 18, 1, 10, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'R&uuml;ckg&auml;ngig', 'undo', 'command', 'undo', 'undo', 18, 1, 1, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Wiederholen', 'redo', 'command', 'redo', 'redo', 18, 1, 2, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Horizontale Linie', 'hr', 'command', 'hr', 'hr', 18, 2, 1, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'HTML', 'html', 'command', 'code', 'code', 18, 1, 13, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Link', 'link', 'command', 'link', 'link', 18, 2, 10, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Nummerierte Liste', 'numlist', 'command', 'numlist', 'numlist', 18, 1, 9, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Ungeordnete Liste', 'bullist', 'command', 'bullist', 'bullist', 18, 1, 8, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Zwischenablage', 'clipboard', 'command', 'cut,copy,paste', 'clipboard', 18, 1, 16, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Unterskript', 'sub', 'command', 'sub', 'sub', 18, 2, 2, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Superskript', 'sup', 'command', 'sup', 'sup', 18, 2, 3, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Hilfslinien', 'visualaid', 'command', 'visualaid', 'visualaid', 18, 3, 7, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Sonderzeichen, 'charmap', 'command', 'charmap', 'charmap', 18, 3, 6, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Blocksatz', 'full', 'command', 'justifyfull', 'justifyfull', 18, 2, 7, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Ausrichtung Mitte', 'center', 'command', 'justifycenter', 'justifycenter', 18, 2, 5, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Ausrichtung Links', 'left', 'command', 'justifyleft', 'justifyleft', 18, 2, 6, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Ausrichtung Rechts', 'right', 'command', 'justifyright', 'justifyright', 18, 2, 4, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Formatierung entfernen', 'removeformat', 'command', 'removeformat', 'removeformat', 18, 1, 15, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Anker', 'anchor', 'command', 'anchor', 'anchor', 18, 2, 9, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
    $database->setQuery( "INSERT INTO #__jce_plugins VALUES ('', 'Format w&auml;hlen', 'formatselect', 'command', 'formatselect', 'formatselect', 18, 3, 9, 1, 0, '', 1, 0, 0, '', '')" );
    $database->query();
}
?>
