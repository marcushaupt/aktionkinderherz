<?php
/****************************************************************************
* data/accions/renomar.inc.php
*
* Realiza la visualización o acción de renombrar un fichero o directorio
*

PHPfileNavigator versión 2.2.0

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

$tempo->rexistra('precodigo');

include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');

include_once ($PFN_paths['include'].'class_inc.php');
include_once ($PFN_paths['include'].'class_extra.php');

$extra->accions($accions);
$inc = new PFN_INC($conf);

$erro = false;

if ($vars->post('executa')) {
	if ($vars->post('novo_nome') != '' && !empty($dir) && !empty($cal)) {
		$antes = $conf->g('raiz','path').$accions->path_correcto($dir.'/').'/'.$cal;
		$agora = $conf->g('raiz','path').$accions->path_correcto($dir.'/')
			.'/'.$accions->nome_correcto($vars->post('novo_nome'));

		if (!eregi('\.[a-z0-9]+$', $agora) && is_file($antes)) {
			$partes = explode('.', $antes);
			$agora .= '.'.end($partes);
		}

		$accions->renomear($antes, $agora);
		$estado = $accions->estado_num('renomear');
		$estado_accion = $conf->t('estado.renomear',intval($estado));

		if ($accions->estado('renomear')) {
			if ($tipo == 'dir') {
				if (is_dir(PFN_get_path_extra($antes))) {
					$extra->renomear($antes, $agora, true);
				}
			} else {
				if (is_file($inc->nome_inc($antes))) {
					$extra->renomear($inc->nome_inc($antes),$inc->nome_inc($agora), false);
				}

				if (is_file($imaxes->nome_pequena($antes))) {
					$extra->renomear($imaxes->nome_pequena($antes),$imaxes->nome_pequena($agora), false);
				}
			}

			if ($conf->g('inc','indexar')) {
				include_once ($PFN_paths['include'].'class_indexador.php');

				$i_antes = explode('/',$antes);
				$i_antes = $accions->nome_correcto(end($i_antes));
				$i_agora = explode('/',$agora);
				$i_agora = $accions->nome_correcto(end($i_agora));

				$indexador = new PFN_Indexador($conf);

				if ($accions->e_dir($agora)) {
					$indexador->renomear("$dir/", "$i_antes/", "$i_agora/");
				} else {
					$indexador->renomear("$dir/", $i_antes, $i_agora);
				}
			}
		}
	}

	include ($PFN_paths['web'].'navega.inc.php');
} else {
	if (file_exists($arquivo)) {
		include ($PFN_paths['plantillas'].'posicion.inc.php');
		include ($PFN_paths['plantillas'].'info_cab.inc.php');
		include ($PFN_paths['plantillas'].'renomear.inc.php');
	} else {
		include ($PFN_paths['web'].'navega.inc.php');
	}
}

$tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
