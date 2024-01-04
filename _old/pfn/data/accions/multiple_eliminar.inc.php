<?php
/****************************************************************************
* data/accions/multiple_eliminar.inc.php
*
* Realiza la visualizaci�n o acci�n de eliminar multiples ficheros
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
&& ($vars->post('executa') || !$conf->g('confirmar_eliminar'))
&& (count($multiple_escollidos) > 0)) {
	include_once ($PFN_paths['include'].'class_extra.php');
	include_once ($PFN_paths['include'].'class_inc.php');
	include_once ($PFN_paths['include'].'class_indexador.php');

	$indexador = new PFN_Indexador($conf);
	$inc = new PFN_INC($conf);
	$extra->accions($accions);

	if (!empty($dir)) {
		foreach ($multiple_escollidos as $v) {
			$erro = false;
			$cal = $v = $accions->nome_correcto($v);
			$arquivo = $conf->g('raiz','path').$accions->path_correcto($dir.'/')
				.'/'.$cal;
			$e_dir = $accions->e_dir($arquivo);

			if (empty($v) || ($v == '.') || ($v == './') || !file_exists($arquivo)) {
				$erro = true;
				$estado = 4;
			}

			if (!$erro) {
				if ($conf->g('raiz','peso_maximo') > 0) {
					if ($e_dir) {
						$peso_este = $accions->get_tamano("$arquivo/");
					} else {
						$peso_este = PFN_espacio_disco($arquivo, true);
					}
				}

				$accions->eliminar($arquivo);
				$estado = $accions->estado_num('multiple_eliminar');
			}

			if (!$erro && $accions->estado('multiple_eliminar')) {
				if ($e_dir) {
					if (is_dir(PFN_get_path_extra($arquivo))) {
						if ($conf->g('raiz','peso_maximo') > 0) {
							$peso_este += $accions->get_tamano(PFN_get_path_extra("$arquivo/"), true);
						}

						$extra->eliminar($arquivo, true);
					}
				} else {
					if (is_file($inc->nome_inc($arquivo))) {
						if ($conf->g('raiz','peso_maximo') > 0) {
							$peso_este += PFN_espacio_disco($inc->nome_inc($arquivo), true);
						}

						$extra->eliminar($inc->nome_inc($arquivo), false);
					}

					if (is_file($imaxes->nome_pequena($arquivo))) {
						if ($conf->g('raiz','peso_maximo') > 0) {
							$peso_este += PFN_espacio_disco($imaxes->nome_pequena($arquivo), true);
						}

						$extra->eliminar($imaxes->nome_pequena($arquivo), false);
					}
				}
			} else {
				$estado_accion .= $conf->t('estado.multiple_eliminar',intval($estado)).' '.$cal.'<br />';
				$cnt_erros++;

				if ($e_dir && $estado != 4) {
					clearstatcache();
					$peso_este = $accions->get_tamano("$arquivo/");
					$peso_este += $accions->get_tamano(PFN_get_path_extra("$arquivo/"), true);
				}
			}

			if (($estado !== 4) && ($e_dir || !$erro) && ($conf->g('raiz','peso_maximo') > 0)) {
				$peso_este = $conf->g('raiz', 'peso_actual') - $peso_este;
				$peso_este = ($peso_este < 0)?0:$peso_este;

				$conf->p($peso_este, 'raiz', 'peso_actual');
				$usuarios->accion('peso', $peso_este, $conf->g('raiz','id'));
			}
		}
	}

	if ($cnt_erros == 0) {
		$estado_accion = $conf->t('estado.multiple_eliminar', 1);
	} elseif ($cnt_erros != count($multiple_escollidos)) {
		$estado_accion .= $conf->t('estado.multiple_eliminar', 3);
	}

	include ($PFN_paths['web'].'navega.inc.php');
} elseif ($conf->g('columnas','multiple') && count($multiple_escollidos) > 0) {
	foreach ($multiple_escollidos as $k => $v) {
		$v = $accions->nome_correcto($v);
		$arquivo = $conf->g('raiz','path').$accions->path_correcto($dir.'/').'/'.$v;

		if (empty($v) || ($v == '.') || ($v == './') || !file_exists($arquivo)) {
			$adv = $conf->t('estado.multiple_eliminar', 7).' '.$v.'<br />';
			unset($multiple_escollidos[$k]);
		} else {
			$multiple_escollidos[$k] = $v;
		}
	}

	if (count($multiple_escollidos) > 0) {
		include ($PFN_paths['plantillas'].'posicion.inc.php');
		include ($PFN_paths['plantillas'].'multiple_eliminar.inc.php');
	} else {
		include ($PFN_paths['web'].'navega.inc.php');
	}
} else {
	include ($PFN_paths['web'].'navega.inc.php');
}

$tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
