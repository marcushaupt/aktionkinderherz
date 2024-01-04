<?php
/*******************************************************************************
* instalar/include/actualizar.inc.php
*
* Ejectula la acci�n de actualizaci�n desde la versi�n 2.0.0 o posterior
*

PHPfileNavigator versi�n 2.3.0

Copyright (C) 2004-2006 Lito <lito@eordes.com>

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

$erros = $erros_q = $paso_feito = $feito = array();

$existe = implode('',$basicas['db']);

if (strlen($existe) == 0) {
	$erros[] = 18;
} else {
	if ($con = @mysql_connect($basicas['db']['host'], $basicas['db']['usuario'], $basicas['db']['contrasinal'])) {
		if (!@mysql_select_db($basicas['db']['base_datos'], $con)) {
			$erros[] = 15;
		}
	} else {
		$erros[] = 16;
	}
}

if (count($erros) == 0) {
	if ($basicas['version'] < 201) {
		include_once ($PFN_paths['instalar'].'include/actualizar_200-201.inc.php');
	}

	if ($vars->post('ignorar') == 'true') {
		$erros = array();
	}

	if ($basicas['version'] < 220) {
		include_once ($PFN_paths['instalar'].'include/actualizar_201-220.inc.php');
	}

	if ($vars->post('ignorar') == 'true') {
		$erros = array();
	}

	if ($basicas['version'] < 230) {
		include_once ($PFN_paths['instalar'].'include/actualizar_220-230.inc.php');
	}

	if ($vars->post('ignorar') == 'true') {
		$erros = array();
	}

	$conf->inicial('default');

	if (count($erros) == 0) {
		include ($PFN_paths['instalar'].'include/basicas.inc.php');

		basicas(array(
			'version' => $PFN_version,
			'idioma' => $form['idioma'],
			'estilo' => 'estilos/pfn/',
			'email' => $basicas['email'],
			'gd2' => $form['gd2'],
			'zlib' => $form['zlib'],
			'charset' => $form['charset'],
			'envio_alertas' => $basicas['envio_alertas'],
			'db:host' => $basicas['db']['host'],
			'db:base_datos' => $basicas['db']['base_datos'],
			'db:usuario' => $basicas['db']['usuario'],
			'db:contrasinal' => $basicas['db']['contrasinal'],
			'db:prefixo' => $basicas['db']['prefixo']
		));

		$conf->inicial('basicas');

		$feito[] = 'conf';
	}
}

if ($con) {
	@mysql_close($con);
}

include ($PFN_paths['instalar'].'plantillas/actualizar.inc.php');
?>
