<?php
/****************************************************************************
* data/accions/multiple_mover.inc.php
*
* Realiza la visualización o acción de mover multiples ficheros y directorios
*

PHPfileNavigator versión 2.1.0

Copyright (C) 2004-2005 Lito <lito@eordes.com>

http://phpfilenavigator.litoweb.net/

Este programa es software libre. Puede redistribuirlo y/o modificarlo bajo los
términos de la Licencia Pública General de GNU según es publicada por la Free
Software Foundation, bien de la versión 2 de dicha Licencia o bien (según su
elección) de cualquier versión posterior. 

Este programa se distribuye con la esperanza de que sea útil, pero SIN NINGUNA
GARANTÍA, incluso sin la garantía MERCANTIL implícita o sin garantizar la
CONVENIENCIA PARA UN PROPÓSITO PARTICULAR. Véase la Licencia Pública General de
GNU para más detalles. 

Debería haber recibido una copia de la Licencia Pública General junto con este
programa. Si no ha sido así, escriba a la Free Software Foundation, Inc., en
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
		@set_time_limit($conf->g('tempo_maximo'));
		@ini_set('memory_limit', $conf->g('memoria_maxima'));

		include_once ($PFN_paths['include'].'class_extra.php');
		include_once ($PFN_paths['include'].'class_inc.php');
		include_once ($PFN_paths['include'].'class_indexador.php');

		$indexador = new PFN_Indexador($conf);
		$inc = new PFN_INC($conf);
		$extra->accions($accions);

		foreach ($multiple_escollidos as $v) {
			$erro = false;
			$cal = $accions->nome_correcto($v);
			$orixinal = $conf->g('raiz','path').$accions->path_correcto($dir.'/')
				.'/'.$cal;
			$destino = $conf->g('raiz','path').$accions->path_correcto($vars->post('escollido').'/')
				.'/'.$cal;

			if (!file_exists($orixinal)) {
				$erro = true;
				$estado = 9;
			}

			if (strstr($destino, $orixinal)) {
				$erro = true;
				$estado = 8;
			}

			if (!$erro && $accions->e_dir($orixinal)) {
				$accions->mover($orixinal, $destino);
				$estado = $accions->estado_num('multiple_mover');

				if ($accions->estado('multiple_mover')) {
					if (is_dir(PFN_get_path_extra($orixinal))) {
						$extra->mover($orixinal, $destino, true);
					}

					$i_destino = $accions->path_correcto($vars->post('escollido').'/');
					$indexador->mover("$dir/", "$i_destino/", "$cal/");
				} elseif (($estado == 6) && ($conf->g('raiz','peso_maximo') > 0)) {
					$erro = true;
					$peso_este = $accions->get_tamano("$orixinal/", true);
					$peso_este += $conf->g('raiz', 'peso_actual');

					$conf->p($peso_este, 'raiz', 'peso_actual');

					$usuarios->accion('peso', $peso_este, $conf->g('raiz','id'));
				} else {
					$erro = true;
				}
			} elseif (!$erro) {
				$accions->mover($orixinal, $destino);
				$estado = $accions->estado_num('multiple_mover');

				if ($accions->estado('multiple_mover')) {
					if (is_file($inc->nome_inc($orixinal))) {
						$extra->mover($inc->nome_inc($orixinal), $inc->nome_inc($destino), false);
					}

					if (is_file($imaxes->nome_pequena($orixinal))) {
						$extra->mover($imaxes->nome_pequena($orixinal), $imaxes->nome_pequena($destino), false);
					}

					$i_destino = $accions->path_correcto($vars->post('escollido').'/');
					$indexador->mover("$dir/", "$i_destino/", $cal);
				} elseif (($estado == 6) && ($conf->g('raiz','peso_maximo') > 0)) {
					$erro = true;
					$peso_este = PFN_espacio_disco($orixinal, true);
					$peso_este += $conf->g('raiz', 'peso_actual');

					$conf->p($peso_este, 'raiz', 'peso_actual');

					$usuarios->accion('peso', $peso_este, $conf->g('raiz','id'));
				} else {
					$erro = true;
				}
			}

			if ($erro) {
				$estado_accion .= $conf->t('estado.multiple_mover',intval($estado)).' '.$cal.'<br />';
				$cnt_erros++;
			}
		}
	}

	if ($cnt_erros == 0) {
		$estado_accion = $conf->t('estado.multiple_mover', 1);
	} elseif ($cnt_erros != count($multiple_escollidos)) {
		$estado_accion .= $conf->t('estado.multiple_mover', 7);
	}

	include ($PFN_paths['web'].'navega.inc.php');
} elseif ($conf->g('columnas','multiple') && count($multiple_escollidos) > 0) {
	foreach ($multiple_escollidos as $k => $v) {
		$arquivo = $conf->g('raiz','path').$accions->path_correcto($dir.'/')
			.'/'.$accions->nome_correcto($v);

		if (!file_exists($arquivo)) {
			$adv .= $conf->t('estado.multiple_mover', 7).' '.$accions->nome_correcto($v).'<br />';
			unset($multiple_escollidos[$k]);
		}
	}

	if (count($multiple_escollidos) > 0) {
		include_once ($PFN_paths['include'].'class_arbore.php');
		$arbore = new PFN_Arbore($conf);

		$arbore->imaxes($imaxes);
		$arbore->pon_radio('escollido');
		$arbore->pon_enlaces(false);

		$adv .= $conf->t('estado.multiple_mover', 2);

		$arbore->carga_arbore($conf->g('raiz','path'), "./", false);

		include ($PFN_paths['plantillas'].'posicion.inc.php');
		include ($PFN_paths['plantillas'].'multiple_mover.inc.php');
	} else {
		include ($PFN_paths['web'].'navega.inc.php');
	}
} else {
	include ($PFN_paths['web'].'navega.inc.php');
}

$tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
