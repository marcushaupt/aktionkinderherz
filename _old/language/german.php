<?php
/**
* @version $Id: german.php 4004 2006-06-12 17:44:14Z joomlagtt $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Beschr&auml;nkter Zugang.' );

// Site page note found
define( '_404', 'Die angefragte Seite konnte nicht gefunden werden.' );
define( '_404_RTS', 'Zur&uuml;ck zur Site' );

// common
DEFINE('_LANGUAGE','de');
DEFINE('_NOT_AUTH','Sie sind nicht berechtigt, diesen Bereich zu sehen.');
DEFINE('_DO_LOGIN','Sie m&uuml;ssen sich anmelden.');
DEFINE('_VALID_AZ09','%s ist nicht zul&auml;ssig. Bitte keine Leerzeichen, mindestens %d Stellen, 0-9,a-z,A-Z sollte enthalten sein.');
DEFINE('_VALID_AZ09_USER',"Bitte einen g&uuml;ltigen %s eingeben. Mindestens %d Stellen, 0-9,a-z,A-Z sollte enthalten sein.'");
DEFINE('_CMN_YES','Ja');
DEFINE('_CMN_NO','Nein');
DEFINE('_CMN_SHOW','Anzeigen');
DEFINE('_CMN_HIDE','Verstecken');

DEFINE('_CMN_NAME','Name');
DEFINE('_CMN_DESCRIPTION','Beschreibung');
DEFINE('_CMN_SAVE','Speichern');
DEFINE('_CMN_APPLY','Anwenden');
DEFINE('_CMN_CANCEL','Abbrechen');
DEFINE('_CMN_PRINT','Drucken');
DEFINE('_CMN_PDF','PDF');
DEFINE('_CMN_EMAIL','E-Mail');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','&Uuml;bergeordnetes(r)');
DEFINE('_CMN_ORDERING','Reihenfolge');
DEFINE('_CMN_ACCESS','Zugriffslevel');
DEFINE('_CMN_SELECT','Ausw&auml;hlen');

DEFINE('_CMN_NEXT','Vor');
DEFINE('_CMN_NEXT_ARROW'," &gt;&gt;");
DEFINE('_CMN_PREV','Zur&uuml;ck');
DEFINE('_CMN_PREV_ARROW',"&lt;&lt; ");

DEFINE('_CMN_SORT_NONE','Nicht sortieren');
DEFINE('_CMN_SORT_ASC','Aufsteigend sortieren');
DEFINE('_CMN_SORT_DESC','Absteigend sortieren');

DEFINE('_CMN_NEW','Neu');
DEFINE('_CMN_NONE','Nichts');
DEFINE('_CMN_LEFT','Links');
DEFINE('_CMN_RIGHT','Rechts');
DEFINE('_CMN_CENTER','Mitte');
DEFINE('_CMN_ARCHIVE','Archivieren');
DEFINE('_CMN_UNARCHIVE','Aus Archiv entfernen');
DEFINE('_CMN_TOP','Oben');
DEFINE('_CMN_BOTTOM','Unten');

DEFINE('_CMN_PUBLISHED','Ver&ouml;ffentlicht');
DEFINE('_CMN_UNPUBLISHED','Unver&ouml;ffentlicht');

DEFINE('_CMN_EDIT_HTML','HTML bearbeiten');
DEFINE('_CMN_EDIT_CSS','CSS bearbeiten');

DEFINE('_CMN_DELETE','L&ouml;schen');

DEFINE('_CMN_FOLDER','Verzeichnis');
DEFINE('_CMN_SUBFOLDER','Unterverzeichnis');
DEFINE('_CMN_OPTIONAL','Optional');
DEFINE('_CMN_REQUIRED','Pflichtfeld');

DEFINE('_CMN_CONTINUE','Weiter');

DEFINE('_STATIC_CONTENT','Statischer Inhalt');

DEFINE('_CMN_NEW_ITEM_LAST','Neue Beitr&auml;ge standardm&auml;&szlig;ig am Ende. Reihenfolge kann ge&auml;ndert werden nachdem der Begriff gespeichert wurde.');
DEFINE('_CMN_NEW_ITEM_FIRST','Neue Beitr&auml;ge standardm&auml;&szlig;ig am Anfang. Reihenfolge kann ge&auml;ndert werden nachdem der Begriff gespeichert wurde.');
DEFINE('_LOGIN_INCOMPLETE','Bitte Benutzername und Passwort vollständig ausfüllen.');
DEFINE('_LOGIN_BLOCKED','Ihr Benutzerkonto wurde gesperrt. Bitte kontaktieren Sie den Administrator.');
DEFINE('_LOGIN_INCORRECT','Benutzername oder Passwort falsch. Bitte versuchen Sie es noch einmal.');
DEFINE('_LOGIN_NOADMINS','Sie können sich nicht anmelden. Es sind noch keine Administratoren definiert.');
DEFINE('_CMN_JAVASCRIPT','!Warnung! F&uuml;r eine einwandfreie Funktion muss JavaScript aktiviert sein.');

DEFINE('_NEW_MESSAGE','Eine neue private Nachricht ist eingetroffen');
DEFINE('_MESSAGE_FAILED','Der Benutzer hat seine Mailbox gesperrt. Nachricht fehlgeschlagen.');

DEFINE('_CMN_IFRAMES', 'Diese Option wird nicht korrekt funktionieren. Leider unterst&uuml;tzt Ihr Browser keine Inline Frames');

DEFINE('_INSTALL_WARN','Bitte l&ouml;schen Sie zu Ihrer eigenen Sicherheit das Installationsverzeichnis, alle Dateien und alle Unterordner  - danach Seite neu laden');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>Template Datei nicht gefunden! Template suchen: </b></font>');
DEFINE('_NO_PARAMS','Es bestehen keine Parameter f&uuml;r dieses Element');
DEFINE('_HANDLER','Keine Routine f&uuml;r diesen Typ definiert');

/** mambots */
DEFINE('_TOC_JUMPTO','Artikel Inhalt');

/**  content */
DEFINE('_READ_MORE','weiter &hellip;');
DEFINE('_READ_MORE_REGISTER','Um weiterzulesen, bitte registrieren, &hellip;');
DEFINE('_MORE','Mehr &hellip;');
DEFINE('_ON_NEW_CONTENT', 'Ein neuer Beitrag wurde eingereicht von [ %s ], mit dem Titel [ %s ], aus der Sektion [ %s ] und der Kategorie [ %s ]' );
DEFINE('_SEL_CATEGORY','- Kategorie ausw&auml;hlen -');
DEFINE('_SEL_SECTION','- Bereich ausw&auml;hlen -');
DEFINE('_SEL_AUTHOR','- Autor ausw&auml;hlen -');
DEFINE('_SEL_POSITION','- Position ausw&auml;hlen -');
DEFINE('_SEL_TYPE','- Type ausw&auml;hlen -');
DEFINE('_EMPTY_CATEGORY','Diese Kategorie ist leer');
DEFINE('_EMPTY_BLOG','Keine Beitr&auml;ge vorhanden');
DEFINE('_NOT_EXIST','Die Seite, auf die Sie zugreifen m&ouml;chten, existiert nicht.<br />Bitte w&auml;hlen Sie eine Seite vom Hauptmen&uuml;.');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','W&auml;hlen');
DEFINE('_BUTTON_RESULTS','Ergebnis');
DEFINE('_USERNAME','Benutzername');
DEFINE('_LOST_PASSWORD','Passwort verloren?');
DEFINE('_PASSWORD','Passwort');
DEFINE('_BUTTON_LOGIN','Anmelden');
DEFINE('_BUTTON_LOGOUT','Abmelden');
DEFINE('_NO_ACCOUNT','Noch kein Benutzerkonto? <br />');
DEFINE('_CREATE_ACCOUNT','Registrieren');
DEFINE('_VOTE_POOR','Schlecht');
DEFINE('_VOTE_BEST','Sehr Gut');
DEFINE('_USER_RATING','Benutzer Bewertung');
DEFINE('_RATE_BUTTON','Bewerten');
DEFINE('_REMEMBER_ME','Angemeldet bleiben');

/** contact.php */
DEFINE('_ENQUIRY','Anfrage');
DEFINE('_ENQUIRY_TEXT','Das ist eine E-Mail Anfrage von');
DEFINE('_COPY_TEXT','Dies ist eine Kopie der Nachricht, die Sie an den Administrator auf %s gesendet haben');
DEFINE('_COPY_SUBJECT','Kopie von: ');
DEFINE('_THANK_MESSAGE','Danke für Ihre E-Mail'); // HTMLEntities werden eingefügt, sobald JavaScript im Code gefixt wurde.
DEFINE('_CLOAKING','Diese E-Mail Adresse ist gegen Spam Bots gesch&uuml;tzt, Sie m&uuml;ssen Javascript aktivieren, damit Sie es sehen k&ouml;nnen');
DEFINE('_CONTACT_HEADER_NAME','Name');
DEFINE('_CONTACT_HEADER_POS','Position');
DEFINE('_CONTACT_HEADER_EMAIL','E-Mail');
DEFINE('_CONTACT_HEADER_PHONE','Telefon');
DEFINE('_CONTACT_HEADER_FAX','Fax');
DEFINE('_CONTACTS_DESC','Die Kontaktliste dieser Website.');
DEFINE('_CONTACT_MORE_THAN','Sie können nicht mehr als eine E-Mail Addresse eintragen.');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','Kontakt');
DEFINE('_EMAIL_DESCRIPTION','E-Mail an diesen Kontakt senden:');
DEFINE('_NAME_PROMPT','Ihr Name:');
DEFINE('_EMAIL_PROMPT','Ihre E-Mail Adresse:');
DEFINE('_MESSAGE_PROMPT','Ihre Mitteilung:');
DEFINE('_SEND_BUTTON','Senden');
DEFINE('_CONTACT_FORM_NC','Bitte vergewissern Sie sich, dass alles ausgefüllt ist.'); // HTMLEntities werden eingefügt, sobald JavaScript im Code gefixt wurde.
DEFINE('_CONTACT_TELEPHONE','Telefon: ');
DEFINE('_CONTACT_MOBILE','Mobil: ');
DEFINE('_CONTACT_FAX','Fax: ');
DEFINE('_CONTACT_EMAIL','E-Mail: ');
DEFINE('_CONTACT_NAME','Name: ');
DEFINE('_CONTACT_POSITION','Position: ');
DEFINE('_CONTACT_ADDRESS','Adresse: ');
DEFINE('_CONTACT_MISC','Information: ');
DEFINE('_CONTACT_SEL','Kontakt ausw&auml;hlen:');
DEFINE('_CONTACT_NONE','Es sind keine Kontakte verf&uml;gbar.');
DEFINE('_CONTACT_ONE_EMAIL','Sie können nicht mehr als eine E-Mail Addresse eintragen.');
DEFINE('_EMAIL_A_COPY','Eine Kopie dieser Nachricht an Ihre E-Mail Adresse senden.');
DEFINE('_CONTACT_DOWNLOAD_AS','Information herunterladen als');
DEFINE('_VCARD','VCard');

/** pageNavigation */
DEFINE('_PN_LT','&lt;');
DEFINE('_PN_RT','&gt;');
DEFINE('_PN_PAGE','Seite');
DEFINE('_PN_OF','von');
DEFINE('_PN_START','Anfang');
DEFINE('_PN_PREVIOUS','Vorherige');
DEFINE('_PN_NEXT','N&auml;chste');
DEFINE('_PN_END','Ende');
DEFINE('_PN_DISPLAY_NR','Anzeige:');
DEFINE('_PN_RESULTS','Ergebnisse');

/** emailfriend */
DEFINE('_EMAIL_TITLE','E-Mail an Freund');
DEFINE('_EMAIL_FRIEND','An einen Freund senden.');
DEFINE('_EMAIL_FRIEND_ADDR','E-Mail Ihres Freundes:');
DEFINE('_EMAIL_YOUR_NAME','Ihr Name:');
DEFINE('_EMAIL_YOUR_MAIL','Ihre E-Mail:');
DEFINE('_SUBJECT_PROMPT','Betreff:');
DEFINE('_BUTTON_SUBMIT_MAIL','E-Mail senden');
DEFINE('_BUTTON_CANCEL','Abbrechen');
DEFINE('_EMAIL_ERR_NOINFO','Sie müssen Ihre E-Mail und die des Empfängers angeben.'); // HTMLEntities werden eingefügt, sobald JavaScript im Code gefixt wurde.
DEFINE('_EMAIL_MSG','Die folgende Seite von der "%s" Website wurde Ihnen von %s ( %s ) gesendet.

Sie k&ouml;nnen unter folgender URL darauf zugreifen: 
%s');
DEFINE('_EMAIL_INFO','Artikel gesendet von');
DEFINE('_EMAIL_SENT','Dieser Artikel wurde gesendet an');
DEFINE('_PROMPT_CLOSE','Fenster schlie&szlig;en');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' Beigesteuert von');
DEFINE('_WRITTEN_BY', ' Geschrieben von');
DEFINE('_LAST_UPDATED', 'Letzte Aktualisierung');
DEFINE('_BACK','[&nbsp;Zur&uuml;ck&nbsp;]');
DEFINE('_LEGEND','Erkl&auml;rung');
DEFINE('_DATE','Datum');
DEFINE('_ORDER_DROPDOWN','Sortierung:');
DEFINE('_HEADER_TITLE','Titel');
DEFINE('_HEADER_AUTHOR','Autor');
DEFINE('_HEADER_SUBMITTED','Eingereicht');
DEFINE('_HEADER_HITS','Zugriffe');
DEFINE('_E_EDIT','Bearbeiten');
DEFINE('_E_ADD','Hinzuf&uuml;gen');
DEFINE('_E_WARNUSER','Bitte aktuelle &Auml;nderungen speichern oder abbrechen');
DEFINE('_E_WARNTITLE','Dieser Beitrag muss einen Titel haben');
DEFINE('_E_WARNTEXT','Dieser Beitrag muss eine Einleitung haben');
DEFINE('_E_WARNCAT','Bitte eine Kategorie ausw&auml;hlen');
DEFINE('_E_CONTENT','Inhalt');
DEFINE('_E_TITLE','Titel:');
DEFINE('_E_CATEGORY','Kategorie:');
DEFINE('_E_INTRO','Einleitung');
DEFINE('_E_MAIN','Haupt-Text');
DEFINE('_E_MOSIMAGE','Einf&uuml;gen {mosimage}');
DEFINE('_E_IMAGES','Bilder');
DEFINE('_E_GALLERY_IMAGES','Galerie - Bilder');
DEFINE('_E_CONTENT_IMAGES','Inhalt - Bilder');
DEFINE('_E_EDIT_IMAGE','Bild bearbeiten');
DEFINE('_E_NO_IMAGE','Kein Bild');
DEFINE('_E_INSERT','Einf&uuml;gen');
DEFINE('_E_UP','Hinauf');
DEFINE('_E_DOWN','Hinunter');
DEFINE('_E_REMOVE','Entfernen');
DEFINE('_E_SOURCE','Quelle:');
DEFINE('_E_ALIGN','Ausrichtung:');
DEFINE('_E_ALT','Alt. Text:');
DEFINE('_E_BORDER','Rahmen:');
DEFINE('_E_CAPTION','Bilduntertitel');
DEFINE('_E_CAPTION_POSITION','Bilduntertitel Position');
DEFINE('_E_CAPTION_ALIGN','Bilduntertitel Ausrichtung');
DEFINE('_E_CAPTION_WIDTH','Bilduntertitel Breite');
DEFINE('_E_APPLY','Anwenden');
DEFINE('_E_PUBLISHING','Ver&ouml;ffentlichen');
DEFINE('_E_STATE','Status:');
DEFINE('_E_AUTHOR_ALIAS','Autor Alias:');
DEFINE('_E_ACCESS_LEVEL','Zugriffslevel:');
DEFINE('_E_ORDERING','Sortierung:');
DEFINE('_E_START_PUB','Start der Ver&ouml;ffentlichung:');
DEFINE('_E_FINISH_PUB','Ende der Ver&ouml;ffentlichung:');
DEFINE('_E_SHOW_FP','Auf Startseite zeigen:');
DEFINE('_E_HIDE_TITLE','Titel nicht anzeigen:');
DEFINE('_E_METADATA','Metadaten');
DEFINE('_E_M_DESC','Beschreibung:');
DEFINE('_E_M_KEY','Schl&uuml;sselw&ouml;rter:');
DEFINE('_E_SUBJECT','Betreff:');
DEFINE('_E_EXPIRES','Ablauftermin:');
DEFINE('_E_VERSION','Version:');
DEFINE('_E_ABOUT','&Uuml;ber');
DEFINE('_E_CREATED','Erstellt:');
DEFINE('_E_LAST_MOD','Letzte &Auml;nderung:');
DEFINE('_E_HITS','Zugriffe:');
DEFINE('_E_SAVE','Speichern');
DEFINE('_E_CANCEL','Abbrechen');
DEFINE('_E_REGISTERED','Nur f&uuml;r registrierte Benutzer');
DEFINE('_E_ITEM_INFO','Beitrags Information');
DEFINE('_E_ITEM_SAVED','Beitrag erfolgreich gespeichert.');
DEFINE('_ITEM_PREVIOUS','&lt; zur&uuml;ck');
DEFINE('_ITEM_NEXT','weiter &gt;');
DEFINE('_KEY_NOT_FOUND','Schl&uuml;ssel nicht gefunden');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','Derzeit gibt es keine archivierten Eintr&auml;ge f&uuml;r diesen Bereich, schauen Sie bitte sp&auml;ter nochmals vorbei');
DEFINE('_CATEGORY_ARCHIVE_EMPTY','Derzeit gibt es keine archivierten Eintr&auml;ge f&uuml;r diese Kategorie, schauen Sie bitte sp&auml;ter nochmals vorbei');
DEFINE('_HEADER_SECTION_ARCHIVE','Bereichs Archiv');
DEFINE('_HEADER_CATEGORY_ARCHIVE','Kategorien Archiv');
DEFINE('_ARCHIVE_SEARCH_FAILURE','Es gibt keine archivierten Eintr&auml;ge f&uuml;r %s %s');	// values are month then year
DEFINE('_ARCHIVE_SEARCH_SUCCESS','Hier sind die archivierten Eintr&auml;ge f&uuml;r %s %s');	// values are month then year
DEFINE('_FILTER','Filter:');
DEFINE('_ORDER_DROPDOWN_DA','Datum auf');
DEFINE('_ORDER_DROPDOWN_DD','Datum ab');
DEFINE('_ORDER_DROPDOWN_TA','Titel auf');
DEFINE('_ORDER_DROPDOWN_TD','Titel ab');
DEFINE('_ORDER_DROPDOWN_HA','Zugriffe auf');
DEFINE('_ORDER_DROPDOWN_HD','Zugriffe ab');
DEFINE('_ORDER_DROPDOWN_AUA','Autor auf');
DEFINE('_ORDER_DROPDOWN_AUD','Autor ab');
DEFINE('_ORDER_DROPDOWN_O','Reihenfolge');

/** poll.php */
DEFINE('_ALERT_ENABLED','Cookies m&uuml;ssen aktiviert sein!');
DEFINE('_ALREADY_VOTE','Sie haben heute schon bei dieser Umfrage abgestimmt!');
DEFINE('_NO_SELECTION','Es wurde nichts ausgew&auml;hlt, bitte versuchen Sie es nochmal');
DEFINE('_THANKS','Danke f&uuml;r Ihre Stimme!');
DEFINE('_SELECT_POLL','Umfrage aus Liste ausw&auml;hlen');

/** classes/html/poll.php */
DEFINE('_JAN','Januar');
DEFINE('_FEB','Februar');
DEFINE('_MAR','M&auml;rz');
DEFINE('_APR','April');
DEFINE('_MAY','Mai');
DEFINE('_JUN','Juni');
DEFINE('_JUL','Juli');
DEFINE('_AUG','August');
DEFINE('_SEP','September');
DEFINE('_OCT','Oktober');
DEFINE('_NOV','November');
DEFINE('_DEC','Dezember');
DEFINE('_POLL_TITLE','Umfrage - Ergebnisse');
DEFINE('_SURVEY_TITLE','Umfrage Titel:');
DEFINE('_NUM_VOTERS','Zahl der Stimmen');
DEFINE('_FIRST_VOTE','Erste Stimme');
DEFINE('_LAST_VOTE','Letzte Stimme');
DEFINE('_SEL_POLL','Umfrage ausw&auml;hlen:');
DEFINE('_NO_RESULTS','Es gibt keine Ergebnisse f&uuml;r diese Umfrage.');

/** registration.php */
DEFINE('_ERROR_PASS','Kein entsprechender Benutzer wurde gefunden');
DEFINE('_NEWPASS_MSG','Dem Benutzerkonto $checkusername ist diese E-Mail zugewiesen.\n'
.'Ein Web-Benutzer von $mosConfig_live_site verlangte die Zusendung eines neuen Passwortes.\n\n'
.'Ihr neues Passwort lautet: $newpass\n\nFalls Sie das nicht verlangt hatten, machen Sie sich keine Sorgen.'
.'Nur Sie k&ouml;nnen diese Nachricht sehen. Falls dies ein Fehler war, melden Sie sich einfach mit Ihrem'
.'neuen Passwort an und &auml;ndern das Passwort beliebig.');
DEFINE('_NEWPASS_SUB','$_sitename :: Neues Passwort f&uuml;r - $checkusername');
DEFINE('_NEWPASS_SENT','Neues Benutzer Passwort generiert und gesendet!');
DEFINE('_REGWARN_NAME','Bitte Ihren Namen eingeben.');
DEFINE('_REGWARN_UNAME','Bitte einen Benutzernamen eingeben.');
DEFINE('_REGWARN_MAIL','Bitte Ihre E-Mail Adresse eingeben.');
DEFINE('_REGWARN_PASS','Bitte ein g&uuml;ltiges Passwort eingeben.  Mindestens 6 Stellen, keine Leerzeichen, m&ouml;glich sind 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','Bitte Passwort wiederholen.');
DEFINE('_REGWARN_VPASS2','Passwort und Wiederholung stimmen nicht &uuml;berein, bitte versuchen Sie es noch einmal.');
DEFINE('_REGWARN_INUSE','Dieser Benutzername/Passwort wird schon verwendet. Bitte versuchen Sie etwas anderes.');
DEFINE('_REGWARN_EMAIL_INUSE', 'Diese E-Mail Adresse wurde schon registriert. Wenn Sie Ihr Passwort vergessen haben sollten, klicken Sie bitte auf "Passwort vergessen" und es wird Ihnen ein neues Passwort zugesandt.');
DEFINE('_SEND_SUB','Benutzer Details f&uuml;r %s auf %s');
DEFINE('_USEND_MSG_ACTIVATE', 'Hallo %s,

Vielen Dank für Ihre Registrierung bei %s. Ihr Benutzerkonto wurde generiert und muss vor der ersten Benutzung aktiviert werden.
Um Ihr Benutzerkonto zu aktivieren klicken Sie auf den folgenden Link oder kopieren Sie ihn und f&uuml;gen ihn in Ihren Browser ein:
%s

Nach der Aktivierung m&uuml;ssen Sie sich auf %s mit folgendem Benutzernamen und Passwort anmelden:

Benutzername - %s
Passwort - %s');
DEFINE('_USEND_MSG', 'Hallo %s,

Danke, dass Sie sich auf %s registriert haben.

Sie k&ouml;nnen sich nun auf %s mit Ihrem registrierten Benutzernamen und Passwort anmelden.');
DEFINE('_USEND_MSG_NOPASS','Hallo $name,\n\nSie wurden als Benutzer von $mosConfig_live_site hinzugef&uuml;gt.\n'
.'Sie k&ouml;nnen sich nun auf $mosConfig_live_site mit Ihrem Benutzernamen und Passwort anmelden.\n\n'
.'Bitte nicht auf diese Nachricht antworten, da sie automatisch generiert wurde und nur Ihrer Information dient\n');
DEFINE('_ASEND_MSG','Hallo %s,

Ein neuer Benutzer wurde auf %s registriert.
Diese E-Mail enth&auml;lt die Anmeldedaten:

Name - %s
E-Mail - %s
Benutzername - %s

Bitte nicht auf diese Nachricht antworten, da sie automatisch generiert wurde und nur Ihrer Information dient');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">Registrierung abgeschlossen!</div><br />&nbsp;&nbsp;'
.'Sie k&ouml;nnen sich jetzt anmelden.<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">Registrierung abgeschlossen!</div><br />Sie k&ouml;nnen sich jetzt anmelden.');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">Registrierung abgeschlossen!</div><br />Ihr Benutzerkonto wurde erstellt und ein Aktivierungs- Link wurde zu der von Ihnen angegebenen E-Mail Adresse zugesandt. Sie m&uuml;ssen nach dem Erhalt dieser E-Mail durch Klick auf den Aktivierungs- Link Ihr Benutzerkonto freischalten, bevor Sie sich mit Ihren Benutzerdaten anmelden k&ouml;nnen.');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">Aktivierung abgeschlossen!</div><br />Ihr Benutzerkonto wurde erfolgreich freigeschaltet. Sie k&ouml;nnen sich jetzt mit dem Benutzernamen und Passwort, dass Sie w&auml;hrend der Registrierung gew&auml;hlt haben, anmelden.');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">Ung&uuml;ltiger Aktivierungs Link!</div><br />Es ist kein solches Benutzerkonto in der Datenbank oder das Benutzerkonto wurde schon freigeschaltet.');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','Passwort vergessen?');
DEFINE('_NEW_PASS_DESC','Bitte geben Sie Ihren Benutzernamen und Ihre E-Mail Adresse ein und klicken Sie auf Passwort senden.<br />'
.'In K&uuml;rze erhalten Sie ein neues Passwort. Verwenden Sie dieses Passwort, um sich anzumelden.');
DEFINE('_PROMPT_UNAME','Benutzername:');
DEFINE('_PROMPT_EMAIL','E-Mail Adresse:');
DEFINE('_BUTTON_SEND_PASS','Passwort senden');
DEFINE('_REGISTER_TITLE','Registrierung');
DEFINE('_REGISTER_NAME','Name:');
DEFINE('_REGISTER_UNAME','Benutzername:');
DEFINE('_REGISTER_EMAIL','E-Mail:');
DEFINE('_REGISTER_PASS','Passwort:');
DEFINE('_REGISTER_VPASS','Passwort wiederholen:');
DEFINE('_REGISTER_REQUIRED','Felder mit einem Stern (*) sind verpflichtend anzugeben.');
DEFINE('_BUTTON_SEND_REG','Registrierung senden');
DEFINE('_SENDING_PASSWORD','Ihr Passwort wird an die angegebene E-Mail Adresse gesendet.<br />Sobald Sie Ihr neues Passwort erhalten haben,'
.'k&ouml;nnen Sie sich anmelden und danach das Passwort beliebig &auml;ndern.');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','Suchen');
DEFINE('_PROMPT_KEYWORD','Such-Schl&uuml;sselw&ouml;rter');
DEFINE('_SEARCH_MATCHES','ergab %d Treffer');
DEFINE('_CONCLUSION','Insgesamt $totalRows Ergebnisse.  Suche nach [ <b>$searchword</b> ] mit');
DEFINE('_NOKEYWORD','Nichts gefunden');
DEFINE('_IGNOREKEYWORD','Ein oder mehrere h&auml;ufig vorkommende W&ouml;rter wurden bei der Suche ignoriert');
DEFINE('_SEARCH_ANYWORDS','Jedes Wort');
DEFINE('_SEARCH_ALLWORDS','Alle W&ouml;rter');
DEFINE('_SEARCH_PHRASE','Exakter Ausdruck');
DEFINE('_SEARCH_NEWEST','Neueste zuerst');
DEFINE('_SEARCH_OLDEST','&Auml;lteste zuerst');
DEFINE('_SEARCH_POPULAR','Popul&auml;rste');
DEFINE('_SEARCH_ALPHABETICAL','Alphabetisch');
DEFINE('_SEARCH_CATEGORY','Bereich/Kategorie');
DEFINE('_SEARCH_MESSAGE','Suchbegriff muss mindestens 3 Zeichen und höchstens 20 Zeichen enthalten');
DEFINE('_SEARCH_ARCHIVED','Archiviert');
DEFINE('_SEARCH_CATBLOG','Kategorie Blog');
DEFINE('_SEARCH_CATLIST','Kategorie Liste');
DEFINE('_SEARCH_NEWSFEEDS','Newsfeeds');
DEFINE('_SEARCH_SECLIST','Bereichs Liste');
DEFINE('_SEARCH_SECBLOG','Bereichs Blog');


/** templates/*.php */
DEFINE('_ISO','charset=iso-8859-1');
DEFINE('_DATE_FORMAT','l, d. F. Y');  //Verwendet das PHP DATE Format - Abgekuerzt
/**
* Naechste Zeile aendern, um das Erscheinungsbild des Datums auf Ihrer Seite anzupassen
*
*z.B. DEFINE("_DATE_FORMAT_LC","%A, %d %B %Y %H:%M"); //Verwendet das PHP strftime Format
*/
DEFINE('_DATE_FORMAT_LC',"%A, %e. %B %Y"); //Verwendet das PHP strftime Format
DEFINE('_DATE_FORMAT_LC2',"%A, %e. %B %Y %H:%M");
DEFINE('_SEARCH_BOX','suchen...');
DEFINE('_NEWSFLASH_BOX','Schlagzeilen!');
DEFINE('_MAINMENU_BOX','Hauptmen&uuml;');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','Benutzermen&uuml;');
DEFINE('_HI','Hallo, ');

/** user.php */
DEFINE('_SAVE_ERR','Bitte alle Felder ausf&uuml;llen.');
DEFINE('_THANK_SUB','Danke f&uuml;r Ihren Beitrag. Ihr Beitrag wird erst begutachtet, bevor er erscheint.');
DEFINE('_THANK_SUB_PUB','Danke f&uuml;r Ihre Einsendung.');
DEFINE('_UP_SIZE','Sie k&ouml;nnen keine Dateien gr&ouml;sser als 15kb hochladen.');
DEFINE('_UP_EXISTS','Das Bild $userfile_name existiert bereits. Bitte benennen Sie die Datei um und versuchen es noch einmal.');
DEFINE('_UP_COPY_FAIL','Kopieren fehlgeschlagen');
DEFINE('_UP_TYPE_WARN','Sie k&ouml;nnen nur gif oder jpg Bilder hochladen.');
DEFINE('_MAIL_SUB','Neuer Beitrag eingereicht');
DEFINE('_MAIL_MSG','Hallo $adminName,\n\nEin neuer Beitrag des Typs $type, $title, wurde von $author'
.'f&uuml;r die $mosConfig_live_site Website eingereicht.\n'
.'Bitte gehen Sie auf $mosConfig_live_site/administrator um dem Beitrag des Typs $type zuzustimmen.\n\n'
.'Bitte nicht auf diese Nachricht antworten, da sie automatisch generiert wurde und nur Ihrer Information dient\n');
DEFINE('_PASS_VERR1','Falls Sie Ihr Passwort &auml;ndern, wiederholen Sie bitte das Passwort zur Verifizierung.');
DEFINE('_PASS_VERR2','Falls Sie Ihr Passwort &auml;ndern, versichern Sie sich bitte, dass Passwort und Wiederholung &uuml;bereinstimmen.');
DEFINE('_UNAME_INUSE','Dieser Benutzername wird schon verwendet.');
DEFINE('_UPDATE','Aktualisierung');
DEFINE('_USER_DETAILS_SAVE','Ihre Einstellungen wurden gespeichert.');
DEFINE('_USER_LOGIN','Anmeldung');

/** components/com_user */
DEFINE('_EDIT_TITLE','Ihre Daten bearbeiten');
DEFINE('_YOUR_NAME','Ihr Name:');
DEFINE('_EMAIL','E-Mail:');
DEFINE('_UNAME','Benutzername:');
DEFINE('_PASS','Passwort:');
DEFINE('_VPASS','Passwort wiederholen:');
DEFINE('_SUBMIT_SUCCESS','Einreichung erfolgreich!');
DEFINE('_SUBMIT_SUCCESS_DESC','Ihr Beitrag wurde erfolgreich unseren Administratoren &uuml;bermittelt. Vor Ver&ouml;ffentlichung auf dieser Seite wird er &uuml;berpr&uuml;ft.');
DEFINE('_WELCOME','Willkommen!');
DEFINE('_WELCOME_DESC','Willkommen auf der Benutzer Sektion unserer Seite');
DEFINE('_CONF_CHECKED_IN','Alle ausgecheckten Beitr&auml;ge wurden jetzt eingecheckt');
DEFINE('_CHECK_TABLE','Tabelle kontrollieren');
DEFINE('_CHECKED_IN','Eingecheckt');
DEFINE('_CHECKED_IN_ITEMS',' Beitr&auml;ge');
DEFINE('_PASS_MATCH','Passw&ouml;rter stimmen nicht &uuml;berein');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','Sie m&uuml;ssen einen Kundennamen eingeben.');
DEFINE('_BNR_CONTACT','Sie m&uuml;ssen einen Kontakt f&uuml;r den Kunden w&auml;hlen.');
DEFINE('_BNR_VALID_EMAIL','Sie m&uuml;ssen eine g&uuml;ltige E-Mail Adresse f&uuml;r den Kunden w&auml;hlen.');
DEFINE('_BNR_CLIENT','Sie m&uuml;ssen einen Kunden w&auml;hlen,');
DEFINE('_BNR_NAME','Sie m&uuml;ssen einen Namen f&uuml;r den Banner w&auml;hlen.');
DEFINE('_BNR_IMAGE','Sie m&uuml;ssen ein Bild f&uuml;r den Banner w&auml;hlen.');
DEFINE('_BNR_URL','Sie m&uuml;ssen eine(n) URL/angepassten Banner Code f&uuml;r den Banner w&auml;hlen.');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','Sie sind bereits angemeldet!');
DEFINE('_LOGOUT','Zum Abmelden hier klicken');
DEFINE('_LOGIN_TEXT','Bitte melden Sie sich an, um vollen Zugriff zu erlangen'); 
DEFINE('_LOGIN_SUCCESS','Sie haben sich erfolgreich angemeldet');
DEFINE('_LOGOUT_SUCCESS','Sie haben sich erfolgreich abgemeldet');
DEFINE('_LOGIN_DESCRIPTION','Bitte anmelden, um auf den privaten Bereich der Website zuzugreifen');
DEFINE('_LOGOUT_DESCRIPTION','Sie sind jetzt im privaten Bereich der Website angemeldet, zum Abmelden auf die Schaltfl&auml;che klicken.');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','Weblinks');
DEFINE('_WEBLINKS_DESC','Wir sind regelm&auml;&szlig;ig in den Weiten des WWW unterwegs. Besonders interessante Seiten werden '
.'hier gelistet.  <br />W&auml;hlen Sie von der Liste unten zuerst ein Thema, dann eine URL aus.');
DEFINE('_HEADER_TITLE_WEBLINKS','Weblink');
DEFINE('_SECTION','Bereich:');
DEFINE('_SUBMIT_LINK','Weblink einreichen');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','Beschreibung:');
DEFINE('_NAME','Name:');
DEFINE('_WEBLINK_EXIST','Es existiert schon ein Weblink mit diesem Namen, bitte versuchen Sie es noch einmal.');
DEFINE('_WEBLINK_TITLE','Ihr Weblink muss einen Titel enthalten.');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','Feed Name');
DEFINE('_FEED_ARTICLES','# Artikel');
DEFINE('_FEED_LINK','Feed Link');

/** whos_online.php */
DEFINE('_WE_HAVE', 'Aktuell ');
DEFINE('_AND', ' und ');
DEFINE('_GUEST_COUNT','%s Gast');
DEFINE('_GUESTS_COUNT','%s G&auml;ste');
DEFINE('_MEMBER_COUNT','%s Mitglied');
DEFINE('_MEMBERS_COUNT','%s Mitglieder');
DEFINE('_ONLINE',' online');
DEFINE('_NONE','Kein Benutzer Online');

/** modules/mod_random_image */
DEFINE('_NO_IMAGES','Keine Bilder');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','Zeit');
DEFINE('_MEMBERS_STAT','Mitglieder');
DEFINE('_HITS_STAT','Zugriffe');
DEFINE('_NEWS_STAT','News');
DEFINE('_LINKS_STAT','Weblinks');
DEFINE('_VISITORS','Besucher');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* Das zuerst veröffentlichte Thema/Item in diesem Men&uuml; (Mainmenu = Hauptmen&uuml;) ist voreingestellt für "Homepage" dieser Site. *');
DEFINE('_MAINMENU_DEL','* Sie können das Men&uuml; nicht `löschen` da es für die zuverlässige Funktion von Joomla! erforderlich ist *');
DEFINE('_MENU_GROUP','* Einige `Men&uuml; Arten` tauchen in mehr als einer Gruppe auf *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', 'Neues Benutzerkonto' );
DEFINE('_NEW_USER_MESSAGE', 'Hallo %s,


Sie wurden vom Administrator auf der Website von %s als Benutzer angemeldet.

Diese E-Mail beinhaltet Ihren Benutzernamen und Passwort, damit Sie sich auf %s anmelden können: 

Benutzername - %s
Passwort - %s


Bitte nicht auf diese Nachricht antworten, da sie automatisch generiert wurde und nur Ihrer Information dient.');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "Dies ist eine E-Mail von '%s'

Nachricht:
" );


/** includes/pdf.php */
DEFINE('_PDF_GENERATED','Generiert:');
DEFINE('_PDF_POWERED','Powered by Joomla!');
?>