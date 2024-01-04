<?php
/*******************************************************************************
* instalar/include/paso_5.inc.php
*
* Quinto paso de la instalaci�n
*

PHPfileNavigator versi�n 2.3.1

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

$erros = array(); 

@set_time_limit(180);
@ini_set('memory_limit', -1);

if ($form['tipo'] == 'instalar') {
	include ($PFN_paths['instalar'].'include/instalar.inc.php');

	if (count($erros) > 0) {
		include ($PFN_paths['instalar'].'plantillas/paso_4.inc.php');
	} else {
		include ($PFN_paths['instalar'].'plantillas/instalar.inc.php');
	}
} else {
	include ($PFN_paths['instalar'].'include/actualizar.inc.php');
}

if ((count($erros) == 0) && $form['aviso_instalacion'] == 'true') {
	if ($form['tipo'] == 'instalar') {
		$msx_tit = 'Aviso de nova instalacion '.$PFN_version;
		$msx_txt = 'Version: '.$PFN_version
			."\n\n".'Host de instalacion: '.$form['ra_dominio']
			."\n\n".'Servidor: '.getenv('SERVER_NAME')
			."\n\n".'Correo: '.$form['ad_correo'];
		$msx_email = $form['ad_correo'];
	} else {
		$msx_tit = 'Aviso actualizacion de '.$basicas['version'].' a '.$PFN_version;
		$msx_txt = 'Version anterior: '.$basicas['version']
			."\n\n".'Version instalada: '.$PFN_version
			."\n\n".'Servidor: '.getenv('SERVER_NAME')
			."\n\n".'Correo: '.$basicas['email'];
		$msx_email = $basicas['email'];
	}

	@mail('phpfilenavigator@litoweb.net', $msx_tit, $msx_txt, 'FROM: '.$msx_email);
}
?>
