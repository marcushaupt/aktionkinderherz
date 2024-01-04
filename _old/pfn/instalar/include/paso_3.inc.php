<?php
/*******************************************************************************
* instalar/include/paso_3.inc.php
*
* Tercer paso de la instalaci�n
*

PHPfileNavigator versi�n 2.3.0

Copyright (C) 2004-2005 Lito <lito@eordes.com>

http://phpfilenavigator.litoweb.net/

Este programa es software libre. Puede redistribuirlo y/o modificarlo bajo los
t�rminos de la Licencia P�blica General de GNU seg�n es publicada por la Free
Software Foundation, bien de la versi�n 2 de dicha Licencia o bien (seg�n su
elecci�n) de cualquier versi�n posterior. 

Este programa se distribuye con la esperanza de que sea �til, pero SIN NINGUNA
GARANT�A, incluso sin la garant�a MERCANTIL impl�cita o sin garantizar la
CONVENIENCIA PARA UN PROP�SITO PARTICULAR. V�ase la Licencia P�blica General de
GNU para m�s detalles. 

Deber�a haber recibido una copia de la Licencia P�blica General junto con este
programa. Si no ha sido as�, escriba a la Free Software Foundation, Inc., en
675 Mass Ave, Cambridge, MA 02139, EEUU. 
*******************************************************************************/

defined('OK') or die();

$comprobar = array();
$erros = $erro_mysql = $erro_gd = false;

//  Comprobacion de version de PHP > 4.0.6
$php_version = split('[/.-]', phpversion());
$php_version = intval($php_version[0].$php_version[1].$php_version[2]);

if ($php_version > 406) {
	$comprobar[0] = 'ok';
} else {
	$comprobar[0] = 'erro';
	$erros = true;
}

// Comprobacion de MySQL compilado y version > 4.0.0
if (extension_loaded('mysql')) {
	$mysql_version = split('[/.-]', mysql_get_client_info());
	$mysql_version = intval($mysql_version[0].$mysql_version[1].$mysql_version[2]);

	if ($mysql_version < 400) {
		$comprobar[1] = 'erro';
		$erros = 1;
	} else {
		$comprobar[1] = 'ok';
	}
} else {
	$comprobar[1] = 'erro';
	$erros = $erro_mysql = 1;
}

// Comprobacion de Librerias GD
include_once ($PFN_paths['instalar'].'include/parsear_phpinfo.php');

if (extension_loaded('gd')) {
	ereg('([0-9\.]+)', parsear_phpinfo('gd','GD Version'), $gd_version);
	$gd_version[0] = split('[/.-]', $gd_version[1]);
	$gd_version[0] = intval(substr(intval($gd_version[0][0]).intval($gd_version[0][1]).intval($gd_version[0][2]), 0, 3)); 

	if ($gd_version[0] >= 200) {
		$comprobar[2] = 'ok';
	} else {
		$comprobar[2] = 'aviso';
	}
} else {
	$comprobar[2] = 'erro';
	$erros = $erro_gd = 1;
}

if (extension_loaded('zlib')) {
	ereg('([0-9\.]+)', parsear_phpinfo('zlib','Compiled Version'), $zlib_version);
	$comprobar[3] = 'ok';
} else {
	$comprobar[3] = 'aviso';
}

// Comprobacion de safe_mode
$safe_mode = ini_get('safe_mode');

if (($safe_mode == 1) || ($safe_mode == 'On')) {
	$comprobar[4] = 'aviso';
} else {
	$comprobar[4] = 'ok';
}

// Comprobacion de maxima capacidad de subida
$upload_max_filesize[0] = ini_get('upload_max_filesize');
eregi('([0-9\.]+)', $upload_max_filesize[0], $upload_max_filesize[1]);
$upload_max_filesize[1] = intval($upload_max_filesize[1][1]);

if ($upload_max_filesize[1] < 10) {
	$comprobar[5] = 'aviso';
} else {
	$comprobar[5] = 'ok';
}

// Comprobacion de uso maximo de memoria
$memory_limit[0] = get_cfg_var('memory_limit');
eregi('([0-9\.]+)', $memory_limit[0], $memory_limit[1]);
$memory_limit[1] = intval($memory_limit[1][1]);

if ($memory_limit[1] < 30) {
	$comprobar[6] = 'aviso';
} else {
	$comprobar[6] = 'ok';
}

include ($PFN_paths['instalar'].'plantillas/paso_3.inc.php');
?>
