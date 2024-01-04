<?php
/****************************************************************************
* data/accions/enlazar.inc.php
*
* Realiza la visualizaci�n o acci�n de enlazar un fichero o directorio
*

PHPfileNavigator versi�n 2.0.0

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

$erro = false;

include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');

$tempo->rexistra('precodigo');

if ($vars->post('executa')) {
	if (!empty($cal) && !empty($dir)) {
		$orixinal = $arquivo;
		$destino = $conf->g('raiz','path').$accions->path_correcto($vars->post('escollido').'/')
			.'/'.$cal;

		if (strstr($destino, $orixinal)) {
			$estado_accion = $conf->t('estado.copiar_dir',7);
			$erro = true;
		}

		if (!$erro && $tipo == 'dir') {
			$accions->enlazar($orixinal, $destino);
			$estado = $accions->estado_num('enlazar_dir');
			$estado_accion = $conf->t('estado.enlazar_dir',intval($estado));
			
			if ($accions->estado('enlazar_dir')) {
				if ($conf->g('inc','indexar')) {
					include_once ($PFN_paths['include'].'class_indexador.php');
					$indexador = new PFN_Indexador($conf);

					$i_destino = $accions->path_correcto($vars->post('escollido').'/');
					$indexador->copiar("$dir/", "$i_destino/", "$cal/");
				}
			}
		} elseif (!$erro) {
			$accions->enlazar($orixinal,$destino);
			$estado = $accions->estado_num('enlazar_arq');
			$estado_accion = $conf->t('estado.enlazar_arq',intval($estado));

			if ($accions->estado('enlazar_arq')) {
				if ($conf->g('inc','estado')) {
					include_once ($PFN_paths['include'].'class_inc.php');

					$inc = new PFN_INC($conf);
					$inc->copiar($orixinal, $destino);
				}

				if ($conf->g('inc','indexar')) {
					include_once ($PFN_paths['include'].'class_indexador.php');

					$i_destino = $accions->path_correcto($vars->post('escollido').'/');

					$indexador = new PFN_Indexador($conf);
					$indexador->copiar("$dir/", "$i_destino/", $cal);
				}

				if ($conf->g('imaxes','pequena')) {
					$imaxes->copiar($orixinal,$destino);
				}
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
				$adv = $conf->t('estado.enlazar_dir',2);
			} else {
				$adv = $conf->t('estado.enlazar_dir',3);
			}
		} else {
			$adv = $conf->t('estado.enlazar_arq',2);
		}

		$arbore->carga_arbore($conf->g('raiz','path'), './', false);

		include ($PFN_paths['plantillas'].'posicion.inc.php');
		include ($PFN_paths['plantillas'].'info_cab.inc.php');
		include ($PFN_paths['plantillas'].'enlazar.inc.php');
	} else {
		include ($PFN_paths['web'].'navega.inc.php');
	}
}

$tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
