<?php
/****************************************************************************
* data/accions/eliminar.inc.php
*
* Realiza la visualizaci�n o acci�n de eliminar un fichero o directorio
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

include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');

$tempo->rexistra('precodigo');

$erro = false;

if ($vars->post('executa') || !$conf->g('confirmar_eliminar')) {
	if (!empty($cal) && !empty($dir)) {
		include_once ($PFN_paths['include'].'class_extra.php');
		include_once ($PFN_paths['include'].'class_inc.php');
		include_once ($PFN_paths['include'].'class_indexador.php');

		$indexador = new PFN_Indexador($conf);
		$inc = new PFN_INC($conf);
		$extra->accions($accions);

		if ($tipo == 'dir') {
			$peso_este = 0;

			if ($conf->g('raiz','peso_maximo') > 0) {
				$peso_este = $accions->get_tamano("$arquivo/", true);
			}

			$accions->eliminar($arquivo);
			$estado = $accions->estado_num('eliminar_dir');
			$estado_accion = $conf->t('estado.eliminar_dir',intval($estado));

			if ($accions->estado('eliminar_dir')) {
				if (is_dir(PFN_get_path_extra($arquivo))) {
					if ($conf->g('raiz','peso_maximo') > 0) {
						$peso_este += $accions->get_tamano(PFN_get_path_extra("$arquivo/"), true);
					}

					$extra->eliminar($arquivo, true);
				}

				$indexador->eliminar("$dir/", "$cal/");
			} elseif ($conf->g('raiz','peso_maximo') > 0) {
				clearstatcache();

				$peso_este = $accions->get_tamano("$arquivo/", true);
				$peso_este += $accions->get_tamano(PFN_get_path_extra("$arquivo/"), true);
			}

			if ($conf->g('raiz','peso_maximo') > 0) {
				$peso_este = $conf->g('raiz', 'peso_actual') - $peso_este;

				$peso_este = ($peso_este < 0)?0:$peso_este;
				$conf->p($peso_este, 'raiz', 'peso_actual');
				$usuarios->accion('peso', $peso_este, $conf->g('raiz','id'));
			}
		} else {
			if ($conf->g('raiz','peso_maximo') > 0) {
				$peso_este = PFN_espacio_disco($arquivo, true);
			}

			$accions->eliminar($arquivo);
			$estado = $accions->estado_num('eliminar_arq');
			$estado_accion = $conf->t('estado.eliminar_arq',intval($estado));

			if ($accions->estado('eliminar_arq')) {
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

				$indexador->eliminar("$dir/", $cal);

				if ($conf->g('raiz','peso_maximo') > 0) {
					$peso_este = $conf->g('raiz', 'peso_actual') - $peso_este;

					$peso_este = ($peso_este < 0)?0:$peso_este;
					$conf->p($peso_este, 'raiz', 'peso_actual');
					$usuarios->accion('peso', $peso_este, $conf->g('raiz','id'));
				}
			}
		}
	}

	include ($PFN_paths['web'].'navega.inc.php');
} else {
	if (file_exists($arquivo)) {
		if ($tipo == 'dir') {
			$contido = $accions->get_contido($arquivo);
	
			if (count($contido['dir']['nome']) || count($contido['arq']['nome'])) {
				include_once ($PFN_paths['include'].'class_arbore.php');
				$arbore = new PFN_Arbore($conf);

				$arbore->imaxes($imaxes);
				$arbore->carga_arbore("$arquivo/", "$dir/$cal/", true);

				$adv = $conf->t('estado.eliminar_dir',3);
			} else {
				$adv = $conf->t('estado.eliminar_dir',2);
			}
	
			include ($PFN_paths['plantillas'].'posicion.inc.php');
			include ($PFN_paths['plantillas'].'info_cab.inc.php');
			include ($PFN_paths['plantillas'].'eliminar_dir.inc.php');
		} else {
			include ($PFN_paths['plantillas'].'posicion.inc.php');
			include ($PFN_paths['plantillas'].'info_cab.inc.php');
			include ($PFN_paths['plantillas'].'eliminar_arq.inc.php');
		}
	} else {
		include ($PFN_paths['web'].'navega.inc.php');
	}
}

$tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
