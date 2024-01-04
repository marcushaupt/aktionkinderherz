<?php
/****************************************************************************
* data/accions/buscador.inc.php
*
* Realiza la visualizaci�n da accion de buscar
*

PHPfileNavigator versi�n 2.2.0

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

$tempo->rexistra('preplantillas');

include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');

$tempo->rexistra('precodigo');

include ($PFN_paths['plantillas'].'posicion.inc.php');

if ($vars->post('executa')
	&& $vars->post('palabra_buscar') != ''
	&& is_array($vars->post('campos_buscar'))
) {
	include_once ($PFN_paths['include'].'class_indexador.php');
	$indexador = new PFN_Indexador($conf);

	$cada = '';
	$resultados = $indexador->buscar(
		"$dir/",
		$vars->post('palabra_buscar'),
		$vars->post('campos_buscar'),
		$vars->post('donde_buscar')
	);

	if (count($resultados)) {
		foreach ($resultados as $k => $v) {
			$cada = $conf->g('raiz','path').$accions->path_correcto($v['directorio'])
				.'/'.$v['arquivo'];

			if (!file_exists($cada)) {
				$indexador->eliminar($accions->path_correcto($v['directorio']).'/', $v['arquivo']);
				unset($resultados[$k]);
			}
		}

		include_once ($PFN_paths['include'].'class_inc.php');

		$inc = new PFN_INC($conf);
		$arquivos->niveles($niveles);
	}

	include ($PFN_paths['plantillas'].'buscador_formulario.inc.php');
	include ($PFN_paths['plantillas'].'buscador_resultados.inc.php');
} else {
	include ($PFN_paths['plantillas'].'buscador_formulario.inc.php');
}

$tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
