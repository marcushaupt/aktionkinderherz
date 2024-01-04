<?php
/*******************************************************************************
* instalar/include/actualizar_220-230.inc.php
*
* Ejectula la acci�n de actualizaci�n desde la versi�n entre 2.2.0 y 2.3.0
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

if (count($erros) == 0) {
	$arq_mysql = $PFN_paths['instalar'].'mysql/actualizar_220-230.sql';
	$consultas = @fread(@fopen($arq_mysql, 'r'), @filesize($arq_mysql));
	$consultas = str_replace('EXISTS ', 'EXISTS '.$basicas['db']['prefixo'], $consultas);
	$consultas = str_replace('ALTER IGNORE TABLE ', 'ALTER IGNORE TABLE '.$basicas['db']['prefixo'], $consultas);
	$consultas = explode(';', $consultas);

	foreach ((array)$consultas as $q) {
		$q = trim($q);

		if (empty($q)) {
			continue;
		}

		if (!@mysql_query($q, $con)) {
			$erros['mysql_220-230'] = 17;
			$erros_q['mysql_220-230'][] = array(
				'consulta' => $q,
				'erro' => mysql_error($con)
			);
		}
	}

	$consultas = include ($PFN_paths['instalar'].'mysql/actualizar_200-230.php');

	foreach ($consultas as $q) {
		$q = trim($q);

		if (empty($q)) {
			continue;
		}

		if (!@mysql_query($q, $con)) {
			$erros['mysql_220-230'] = 17;
			$erros_q['mysql_220-230'][] = array(
				'consulta' => $q,
				'erro' => mysql_error($con)
			);
		}
	}

	include_once ($PFN_paths['include'].'class_niveles.php');
	include_once ($PFN_paths['include'].'class_accions.php');

	$niveles = new PFN_Niveles($conf);
	$accions = new PFN_Accions($conf);

	// Movemos el directorio tmp/
	if (is_dir($PFN_paths['web'].'tmp')) {
		$accions->mover($PFN_paths['web'].'tmp', $PFN_paths['servidor'].'tmp/');
	} else {
		mkdir($PFN_paths['tmp']);
	}

	if (is_dir($PFN_paths['web'].'tmp')) {
		@rmdir($PFN_paths['web'].'tmp');
	}

	if (!is_file($PFN_paths['tmp'].'index.html')) {
		copy($PFN_paths['data'].'index.html', $PFN_paths['tmp'].'index.html');
	}

	chmod($PFN_paths['tmp'], 0700);

	// Movemos el directorio data/logs/
	if (is_dir($PFN_paths['data'].'logs')) {
		$accions->mover($PFN_paths['data'].'logs', $PFN_paths['servidor'].'logs/');
	} else {
		mkdir($PFN_paths['logs']);
	}

	if (is_dir($PFN_paths['data'].'logs')) {
		@rmdir($PFN_paths['data'].'logs');
	}

	if (!is_file($PFN_paths['logs'].'index.html')) {
		copy($PFN_paths['data'].'index.html', $PFN_paths['logs'].'index.html');
	}

	chmod($PFN_paths['logs'], 0700);

	// Movemos el directorio data/info/
	if (is_dir($PFN_paths['data'].'info')) {
		$accions->mover($PFN_paths['data'].'info', $PFN_paths['servidor'].'info/');
	} else {
		mkdir($PFN_paths['info']);
	}

	if (is_dir($PFN_paths['data'].'info')) {
		@rmdir($PFN_paths['data'].'info');
	}

	if (!is_file($PFN_paths['info'].'index.html')) {
		copy($PFN_paths['data'].'index.html', $PFN_paths['info'].'index.html');
	}

	chmod($PFN_paths['info'], 0700);

	// Creamos el directorio extra
	if (!is_dir($PFN_paths['extra'])) {
		if (mkdir($PFN_paths['extra'])) {
			copy($PFN_paths['data'].'index.html', $PFN_paths['extra'].'index.html');
		}
	}

	chmod($PFN_paths['extra'], 0700);

	$conf->inicial('basicas');

	include_once ($PFN_paths['include'].'mysql.php');
	include_once ($PFN_paths['include'].'clases.php');
	include_once ($PFN_paths['include'].'class_usuarios.php');

	include_once ($PFN_paths['instalar'].'include/funcions.inc.php');

	// Copiamos todos los ficheros de informacion adicional para un directorio
	// propio
	$usuarios->init('raices');

	for (; $usuarios->mais(); $usuarios->seguinte()) {
		PFN_mover_inc($usuarios->get('path'));
	}

	$paso_feito[] = '220-230';
	array_push($feito, 'mysql_220-230','dirs_220-230','inc_220-230');
}
?>
