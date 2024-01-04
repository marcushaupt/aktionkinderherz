<?php
/****************************************************************************
* data/accions/mover.inc.php
*
* Realiza la visualización o acción de mover un fichero o directorio
*

PHPfileNavigator versión 2.0.0

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

include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');

$tempo->rexistra('precodigo');

$erro = false;

if ($vars->post('executa')) {
	if (!empty($cal) && !empty($dir)) {
		include_once ($PFN_paths['include'].'class_extra.php');
		include_once ($PFN_paths['include'].'class_inc.php');
		include_once ($PFN_paths['include'].'class_indexador.php');

		$indexador = new PFN_Indexador($conf);
		$inc = new PFN_INC($conf);
		$extra->accions($accions);

		$orixinal = $arquivo;
		$destino = $conf->g('raiz','path').$accions->path_correcto($vars->post('escollido').'/')
			.'/'.$cal;

		if (strstr($destino, $orixinal)) {
			$estado_accion = $conf->t('estado.mover_dir',7);
			$erro = true;
		}

		if (!$erro && $tipo == 'dir') {
			$accions->mover($orixinal, $destino);
			$estado = $accions->estado_num('mover_dir');
			$estado_accion = $conf->t('estado.mover_dir',intval($estado));

			if ($accions->estado('mover_dir')) {
				if (is_dir(PFN_get_path_extra($orixinal))) {
					$extra->mover($orixinal, $destino, true);
				}

				$i_destino = $accions->path_correcto($vars->post('escollido').'/');
				$indexador->mover("$dir/", "$i_destino/", "$cal/");
			}
		} elseif (!$erro) {
			$accions->mover($orixinal,$destino);
			$estado = $accions->estado_num('mover_arq');
			$estado_accion = $conf->t('estado.mover_arq',intval($estado));

			if ($accions->estado('mover_arq')) {
				if (is_file($inc->nome_inc($orixinal))) {
					$extra->mover($inc->nome_inc($orixinal), $inc->nome_inc($destino), false);
				}

				if (is_file($imaxes->nome_pequena($orixinal))) {
					$extra->mover($imaxes->nome_pequena($orixinal), $imaxes->nome_pequena($destino), false);
				}

				$i_destino = $accions->path_correcto($vars->post('escollido').'/');
				$indexador->mover("$dir/", "$i_destino/", $cal);
			}
		}
	}

	include ($PFN_paths['web'].'navega.inc.php');
} else {
	if (file_exists($arquivo)) {
		include_once ($PFN_paths['include'].'class_arbore.php');
		$arbore = new PFN_Arbore($conf);

		$arbore->imaxes($imaxes);
		$arbore->pon_radio('escollido');
		$arbore->pon_enlaces(false);

		if ($accions->e_dir($arquivo)) {
			$contido = $accions->get_contido($arquivo);
			$arbore->pon_copia($arquivo);
	
			if (count($contido['dir']['nome']) || count($contido['arq']['nome'])) {
				$adv = $conf->t('estado.mover_dir',2);
			} else {
				$adv = $conf->t('estado.mover_dir',3);
			}
		} else {
			$adv = $conf->t('estado.mover_arq',2);
		}

		$arbore->carga_arbore($conf->g('raiz','path'), './', false);

		include ($PFN_paths['plantillas'].'posicion.inc.php');
		include ($PFN_paths['plantillas'].'info_cab.inc.php');
		include ($PFN_paths['plantillas'].'mover.inc.php');
	} else {
		include ($PFN_paths['web'].'navega.inc.php');
	}
}

$tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
