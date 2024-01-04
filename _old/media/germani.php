<?php
/*
* DOCMan 1.3.0 default template
* @version $Id: english.php,v 1.10 2005/08/06 13:10:12 johanjanssens Exp $
* @package DOCMan_1.3.0
* @copyright (C) 2003 - 2005 The DOCMan Development Team
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Oficial website: http://www.mambodocman.com/
* -------------------------------------------
* Default english language file
* Creator: The DOCMan development team
* Email: admin@mambodocman.com
* Revision: 1.0
* Date: Mar 2005
*/
// ensure this file is being included by a parent file */
defined("_VALID_MOS") or die("Direct Access to this location is not allowed.");

DEFINE ('_DML_TPL_DATEFORMAT_LONG','%d.%m.%Y %H:%M'); 
DEFINE ('_DML_TPL_DATEFORMAT_SHORT','%d.%m.%Y');

// General
DEFINE("_DML_TPL_FILES" 		, "Dateien");
DEFINE("_DML_TPL_CATS" 			, "Kategorien");
DEFINE("_DML_TPL_DOCS" 			, "Dokumente");
DEFINE("_DML_TPL_CAT_VIEW" 		, "Downloads Home");
DEFINE("_DML_TPL_MUST_LOGIN" 	, "Du must dich einloggen um neue Dateien vorzuschlagen");
DEFINE("_DML_TPL_SUBMIT" 		, "Neues Dokument vorschlagen");
DEFINE("_DML_TPL_SEARCH_DOC" 	, "Dokument suchen");
DEFINE("_DML_TPL_LICENSE_DOC" 	, "Dokumentenlizenz");

// Titles 
DEFINE("_DML_TPL_TITLE_BROWSE"  , "Downloads");
DEFINE("_DML_TPL_TITLE_EDIT" 	, "Dokument bearbeiten");
DEFINE("_DML_TPL_TITLE_SEARCH"  , "Ein Dokument suchen");
DEFINE("_DML_TPL_TITLE_DETAILS" , "Dokumentendetails");
DEFINE("_DML_TPL_TITLE_MOVE"    , "Dokument verschieben");
DEFINE("_DML_TPL_TITLE_UPDATE"  , "Dokument updaten");
DEFINE("_DML_TPL_TITLE_UPLOAD"  , "Dokument vorschlagen");

// Documents
DEFINE("_DML_TPL_HITS" 			, "Zugriffe");
DEFINE("_DML_TPL_DATEADDED" 	, "Vorschlagsdatum");
DEFINE("_DML_TPL_HOMEPAGE" 		, "Homepage");

//Document search
DEFINE ("_DML_TPL_ORDER_BY" 	, "Sortieren nach");
DEFINE ("_DML_TPL_ORDER_NAME" 	, "Name");
DEFINE ("_DML_TPL_ORDER_DATE" 	, "Datum,");
DEFINE ("_DML_TPL_ORDER_HITS" 	, "Zugriffe");
DEFINE ("_DML_TPL_ORDER_ASCENT" , "aufsteigend");
DEFINE ("_DML_TPL_ORDER_DESCENT", "absteigend");

//Document edit

//Document move
DEFINE("_DML_TPL_MOVE_DOC" 		, "Dokument in andere Kategorie verschieben");

//Document update
DEFINE("_DML_TPL_UPDATE_DOC" 	   , "Dokument updaten");
DEFINE("_DML_TPL_UPDATE_OVERWRITE" , "&Uuml;berschreibt das Dokument IMMER wenn der Dateiname gleich ist.");

//Document upload
DEFINE("_DML_TPL_UPLOAD_STEP" 	   , "Schritt");
DEFINE("_DML_TPL_UPLOAD_OF" 	   , "von");
DEFINE("_DML_TPL_UPLOAD_NEXT" 	   , "N&auml;chstes");
DEFINE("_DML_TPL_UPLOAD_DOC" 	   , "Upload Assistent");
DEFINE("_DML_TPL_TRANSFER" 		   , "Von einem anderen Webserver &uuml;bertragen");
DEFINE("_DML_TPL_LINK" 		   	   , "Von einem anderen Server verlinken");
DEFINE("_DML_TPL_UPLOAD" 		   , "Vom lokalen Rechner hochladen");

//Document tasks
DEFINE("_DML_TPL_DOC_DOWNLOAD" 	, "Download");
DEFINE("_DML_TPL_DOC_VIEW" 		, "Anzeigen");
DEFINE("_DML_TPL_DOC_DETAILS" 	, "Details");
DEFINE("_DML_TPL_DOC_EDIT" 		, "&Auml;ndern");
DEFINE("_DML_TPL_DOC_MOVE" 		, "Verschieben");
DEFINE("_DML_TPL_DOC_DELETE" 	, "L&ouml;schen");
DEFINE("_DML_TPL_DOC_UPDATE" 	, "Updaten");
DEFINE("_DML_TPL_DOC_CHECKOUT" 	, "Auschecken");
DEFINE("_DML_TPL_DOC_CHECKIN" 	, "Einchecken");
DEFINE("_DML_TPL_DOC_UNPUBLISH"	, "Unver&ouml;ffentlichen");
DEFINE("_DML_TPL_DOC_PUBLISH" 	, "Ver&ouml;ffentlichen");
DEFINE("_DML_TPL_DOC_RESET" 	, "Zur&uuml;cksetzen");
DEFINE("_DML_TPL_DOC_APPROVE" 	, "Best&auml;tigen");

DEFINE("_DML_TPL_BACK" 		   , "Zur&uuml;ck");

//Document details
DEFINE("_DML_TPL_DETAILSFOR" 	, "Details f&uuml;r");
DEFINE("_DML_TPL_NAME" 			, "Name");
DEFINE("_DML_TPL_DESC" 			, "Beschreibung");
DEFINE("_DML_TPL_FNAME"			, "Dateiname");
DEFINE("_DML_TPL_FSIZE"			, "Dateigr&ouml;e");
DEFINE("_DML_TPL_FTYPE"			, "Dateityp");
DEFINE("_DML_TPL_SUBBY"			, "Ersteller");
DEFINE("_DML_TPL_SUBDT"			, "Erstellt am:");
DEFINE("_DML_TPL_OWNER"			, "Betrachter");
DEFINE("_DML_TPL_MAINT"			, "Verwaltet von");
DEFINE("_DML_TPL_DOWNLOADS" 	, "Downloads");
DEFINE("_DML_TPL_LASTUP"		, "Zuletzt ge&auml;ndert");
DEFINE("_DML_TPL_LASTBY"		, "Zuletzt ge&auml;ndert von");
DEFINE("_DML_TPL_HOME" 			, "Homepage" );
DEFINE("_DML_TPL_MIME" 			, "Mime Typ");
DEFINE("_DML_TPL_CHECKED_OUT"	, "Ausgecheckt");
DEFINE("_DML_TPL_CHECKED_BY"	, "Ausgecheckt von");
DEFINE("_DML_TPL_MD5_CHECKSUM"	, "MD5 Pr&uuml;fsumme");
DEFINE("_DML_TPL_CRC_CHECKSUM"	, "CRC Pr&uuml;fsumme");

?>
