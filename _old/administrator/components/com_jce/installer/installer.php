<?php
/**
* @version $Id: admin.installer.php 328 2005-10-02 15:39:51Z Jinx $
* @package Joomla
* @subpackage Installer
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// XML library
require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
require_once( $mosConfig_absolute_path . "/administrator/components/com_jce/installer/installer.html.php" );
require_once( $mosConfig_absolute_path . "/administrator/components/com_jce/installer/installer.class.php" );

function jceInstaller( $option, $client, $opt )
{
    global $mosConfig_absolute_path;
    $element = mosGetParam( $_REQUEST, 'element', '' );
    
    $path = $mosConfig_absolute_path . "/administrator/components/com_jce/installer/$element/$element.php";

    // map the element to the required derived class
    $classMap = array(
    	'plugins' => 'JCEPluginInstaller',
    	'language' 	=> 'JCELanguageInstaller'
    );

    if (array_key_exists ( $element, $classMap )) {
    	require_once( $mosConfig_absolute_path . "/administrator/components/com_jce/installer/$element/$element.class.php" );

    	switch ( $opt ) {

    		case 'uploadfile':
    			uploadPackage( $classMap[$element], $option, $element, $client );
    			break;

    		case 'installfromdir':
    			installFromDirectory( $classMap[$element], $option, $element, $client );
    			break;

    		case 'remove':
    			removeElement( $classMap[$element], $option, $element, $client );
    			break;

    		case 'show':
    			$path = $mosConfig_absolute_path . "/administrator/components/com_jce/installer/$element/$element.php";

    			if (file_exists( $path )) {
    				require $path;
    			} else {
    				echo "Installation des Elements wurde nicht gefunden [$element]";
    			}
    			break;
    	}
    } else {
    	echo "Installation des Elements ist nicht vorhanden [$element]";
    }
}

/**
* @param string The class name for the installer
* @param string The URL option
* @param string The element name
*/
function uploadPackage( $installerClass, $option, $element, $client ) {
	$installer = new $installerClass();

	// Check if file uploads are enabled
	if (!(bool)ini_get('file_uploads')) {
		HTML_installer::showInstallMessage( "The installer can't continue before file uploads are enabled. Please use the install from directory method.",
			'Installer - Error', $installer->returnTo( $option, '&task=install&element='.$element, $client ) );
		exit();
	}

	// Check that the zlib is available
	if(!extension_loaded('zlib')) {
		HTML_installer::showInstallMessage( "Die Installation kann nicht fortgesetzt werden, bevor zlib installiert wurde",
			'Installations - Fehler', $installer->returnTo( $option, '&task=install&element='.$element, $client ) );
		exit();
	}

	$userfile = mosGetParam( $_FILES, 'userfile', null );

	if (!$userfile) {
		HTML_installer::showInstallMessage( 'Keine Datei ausgew&auml;hlt', 'Hochladen des neuen Moduls - Fehler',
			$installer->returnTo( $option, '&task=install&element='.$element, $client ));
		exit();
	}

	$userfile_name = $userfile['name'];

	$msg = '';
	$resultdir = uploadFile( $userfile['tmp_name'], $userfile['name'], $msg );

	if ($resultdir !== false) {
		if (!$installer->upload( $userfile['name'] )) {
			HTML_installer::showInstallMessage( $installer->getError(), 'Hochladen '.$element.' - Hochladen fehlgeschlagen',
				$installer->returnTo( $option, '&task=install&element='.$element, $client ) );
		}
		$ret = $installer->install();

		HTML_installer::showInstallMessage( $installer->getError(), 'Hochladen '.$element.' - '.($ret ? 'Erfolgreich' : 'fehlgeschlagen'),
			$installer->returnTo( $option, '&task=install&element='.$element, $client ) );
		cleanupInstall( $userfile['name'], $installer->unpackDir() );
	} else {
		HTML_installer::showInstallMessage( $msg, 'Hochladen '.$element.' -  Hochladen fehlgeschlagen',
			$installer->returnTo( $option, '&task=install&element='.$element, $client ) );
	}
}

/**
* Install a template from a directory
* @param string The URL option
*/
function installFromDirectory( $installerClass, $option, $element, $client ) {
	$userfile = mosGetParam( $_REQUEST, 'userfile', '' );

	if (!$userfile) {
		mosRedirect( "index2.php?option=$option&element=module", "Bitte w&auml;hlen sie einen Ordner" );
	}

	$installer = new $installerClass();

	$path = mosPathName( $userfile );
	if (!is_dir( $path )) {
		$path = dirname( $path );
	}

	$ret = $installer->install( $path );
	HTML_installer::showInstallMessage( $installer->getError(), 'neues Hochladen '.$element.' - '.($ret ? 'Erfolgreich' : 'Fehler'), $installer->returnTo( $option, '&task=install&element='.$element, $client ) );
}
/**
*
* @param
*/
function removeElement( $installerClass, $option, $element, $client ) {
	$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
	if (!is_array( $cid )) {
		$cid = array(0);
	}

	$installer 	= new $installerClass();
	$result 	= false;
	if ($cid[0]) {
		$result = $installer->uninstall( $cid[0], $option, $client );
	}

	$msg = $installer->getError();

	mosRedirect( $installer->returnTo( $option, '&task=install&element='.$element, $client ), $result ? 'Erfolgreich ' . $msg : 'fehlgeschlagen ' . $msg );
}
/**
* @param string The name of the php (temporary) uploaded file
* @param string The name of the file to put in the temp directory
* @param string The message to return
*/
function uploadFile( $filename, $userfile_name, &$msg ) {
	global $mosConfig_absolute_path;
	$baseDir = mosPathName( $mosConfig_absolute_path . '/media' );

	if (file_exists( $baseDir )) {
		if (is_writable( $baseDir )) {
			if (move_uploaded_file( $filename, $baseDir . $userfile_name )) {
				if (mosChmod( $baseDir . $userfile_name )) {
					return true;
				} else {
					$msg = 'Konnte die Zugriffsrechte der gehochladenen Datei nicht &auml;ndern.';
				}
			} else {
				$msg = 'Konnte die hochgeladene Datei nach <code>/media</code> Verzeichnis nicht verschieben.';
			}
		} else {
			$msg = 'Hochladen gescheitert, <code>/media</code> Verzeichnis ist nicht beschreibbar.';
		}
	} else {
		$msg = 'Hochladen gescheitert, das als <code>/media</code> Verzeichnis existiert nicht, besteht nicht.';
	}
	return false;
}
?>
