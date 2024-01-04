<?php
/****************************************************************************
* data/accions/multiple_descargar.inc.php
*
* Realiza la visualizaci�n o acci�n de descargar multiples ficheros y
* directorios
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

defined('OK') && defined('ACCION') or die();

PFN_quita_url_SERVER('nome_comprimido');

$nome_comprimido = $vars->get('nome_comprimido');
$multiple_escollidos = (array)$vars->post('multiple_escollidos');
$erro = false;

if ($conf->g('columnas','multiple')
&& ($conf->g('zlib') == true)
&& (count($multiple_escollidos) > 0)
&& !empty($nome_comprimido)
&& !empty($dir)) {
	@set_time_limit($conf->g('tempo_maximo'));
	@ini_set('memory_limit', $conf->g('memoria_maxima'));

	include_once ($PFN_paths['include'].'class_easyzip.php');
	$EasyZIP->pon_dirbase($conf->g('raiz','path')
		.$accions->path_correcto($dir.'/')
		.'/'.$multiple_escollidos[0]);

	foreach ($multiple_escollidos as $v) {
		$erro = false;
		$cal = $accions->nome_correcto($v);
		$arquivo = $conf->g('raiz','path').$accions->path_correcto($dir.'/').'/'.$cal;

		if (!file_exists($arquivo)) {
			$erro = true;
		}

		if (!$erro && $accions->e_dir($arquivo)) {
			$EasyZIP->addDir($arquivo);
		} elseif (!$erro) {
			$EasyZIP->addFile($arquivo);
		}
	}

	$contido = &$EasyZIP->zipFile();

	include_once ($PFN_paths['include'].'class_arquivos.php');
	include_once ($PFN_paths['include'].'class_inc.php');

	$arquivos = new PFN_Arquivos($conf);
	$inc = new PFN_INC($conf);

	$inc->arquivos($arquivos);
	$inc->carga_datos($arquivo);
	$accions->arquivos($arquivos);

	$tamano = strlen($contido);

	$estado = $accions->log_ancho_banda($tamano);

	if ($estado === true) {
		$nome_comprimido = strstr($nome_comprimido, '.zip')?$nome_comprimido:($nome_comprimido.'.zip');

		header('Pragma: private');
		header('Expires: 0');
		header('Cache-control: private, must-revalidate');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Content-Type: application/force-download');
		header('Content-Transfer-Encoding: binary');
		header('Content-Disposition: attachment; filename="'.str_replace(array(' ','"'),'_',$nome_comprimido).'"');
		header('Content-Length: '.$tamano);

		echo $contido;
	} elseif ($estado === -1) {
		$erro = true;
		$estado_accion = $conf->t('estado.descargar', 3);
	} else {
		$erro = true;
		$estado_accion = $conf->t('estado.descargar', 2);
	}

	unset($contido);
} else {
	$erro = true;
}

if ($erro) {
	include ($PFN_paths['plantillas'].'cab.inc.php');
	include ($PFN_paths['web'].'opcions.inc.php');

	$tempo->rexistra('precodigo');

	include ($PFN_paths['web'].'navega.inc.php');

	$tempo->rexistra('postcodigo');

	include ($PFN_paths['plantillas'].'pe.inc.php');
}
?>
