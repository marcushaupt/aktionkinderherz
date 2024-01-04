<?php
/****************************************************************************
* data/accions/multiple_permisos.inc.php
*
* Realiza la visualizaci�n o acci�n de cambiar los permisos a multiples ficheros
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

$multiple_escollidos = (array)$vars->post('multiple_escollidos');
$estado_accion = '';
$cnt_erros = 0;
$adv = '';

include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');

$tempo->rexistra('precodigo');

if ($conf->g('columnas','multiple')
&& $vars->post('executa')
&& (count($multiple_escollidos) > 0)) {
	if (!empty($dir)) {
		$perimisos = 0;

		foreach (array('p400','p200','p100','p040','p020','p010','p004','p002','p001') as $v) {
			$permisos += $vars->post($v);
		}

		foreach ($multiple_escollidos as $v) {
			$erro = false;
			$cal = $v = $accions->nome_correcto($v);
			$arquivo = $conf->g('raiz','path').$accions->path_correcto($dir.'/')
				.'/'.$cal;

			if (empty($v) || ($v == '.') || ($v == './') || !file_exists($arquivo)) {
				$erro = true;
				$estado = 2;
			}

			if (!$erro) {
				$accions->permisos($arquivo, $permisos);
				$estado = $accions->estado_num('multiple_permisos');
			}

			if ($erro || !$accions->estado('multiple_permisos')) {
				$estado_accion .= $conf->t('estado.multiple_permisos',intval($estado)).' '.$cal.'<br />';
				$cnt_erros++;
			}
		}
	}

	if ($cnt_erros == 0) {
		$estado_accion = $conf->t('estado.multiple_permisos', 1);
	} elseif ($cnt_erros != count($multiple_escollidos)) {
		$estado_accion .= $conf->t('estado.multiple_permisos', 3);
	}

	include ($PFN_paths['web'].'navega.inc.php');
} elseif ($conf->g('columnas','multiple') && count($multiple_escollidos) > 0) {
	foreach ($multiple_escollidos as $k => $v) {
		$v = $accions->nome_correcto($v);
		$arquivo = $conf->g('raiz','path').$accions->path_correcto($dir.'/').'/'.$v;

		if (empty($v) || ($v == '.') || ($v == './') || !file_exists($arquivo)) {
			$adv = $conf->t('estado.multiple_permisos', 2).' '.$v.'<br />';
			unset($multiple_escollidos[$k]);
		} else {
			$multiple_escollidos[$k] = $v;
		}
	}

	if (count($multiple_escollidos) > 0) {
		include ($PFN_paths['plantillas'].'posicion.inc.php');
		include ($PFN_paths['plantillas'].'multiple_permisos.inc.php');
	} else {
		include ($PFN_paths['web'].'navega.inc.php');
	}
} else {
	include ($PFN_paths['web'].'navega.inc.php');
}

$tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
