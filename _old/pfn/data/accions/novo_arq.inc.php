<?php
/****************************************************************************
* data/accions/novo_arq.inc.php
*
* Carga lo necesario para la visualizaci�n de la pantalla de creaci�n de
* un fichero fichero nuevo
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

$tempo->rexistra('preplantillas');

include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');

$tempo->rexistra('precodigo');

include_once ($PFN_paths['include'].'class_inc.php');
$inc = new PFN_INC($conf);

$erro = true;

if ($vars->post('executa')) {
	$accions->arquivos($arquivos);

	$cal = $accions->nome_correcto($vars->post('cal'));
	$destino = $conf->g('raiz','path').$accions->path_correcto($dir.'/');

	$accions->novo_arq($cal, $destino, $vars->post('texto'), $vars->post('sobreescribir'));
	$estado = $accions->estado_num('novo_arq');
	$estado_accion = $conf->t('estado.novo_arq',intval($estado));

	if ($accions->estado('novo_arq')) {
		$erro = false;

		if ($conf->g('raiz','peso_maximo') > 0) {
			$peso_este = PFN_espacio_disco($destino.'/'.$cal, true);

			if (($peso_este + $conf->g('raiz', 'peso_actual')) > $conf->g('raiz','peso_maximo')) {
				@unlink($destino.'/'.$cal);
				$estado_accion = $conf->t('estado.novo_arq', 6);
				$erro = true;
			}
		}

		$ancho_banda = $accions->log_ancho_banda($peso_este);

		if (!$ancho_banda) {
			@unlink($destino.'/'.$cal);
			$estado_accion = $conf->t('estado.novo_arq', 7);
			$erro = true;
		}

		if (!$erro && $conf->g('inc','estado')) {
			include_once ($PFN_paths['include'].'class_arquivos.php');

			$arquivos = new PFN_Arquivos($conf);
			$inc->arquivos($arquivos);
			$arq_inc = $inc->crea_inc($destino.'/'.$cal,'arq');
		}

		if (!$erro && $conf->g('inc','indexar')) {
			include_once ($PFN_paths['include'].'class_indexador.php');

			$indexador = new PFN_Indexador($conf);
			$indexador->alta_modificacion("$dir/", $cal, $arq_inc);
		}

		if (!$erro && ($conf->g('raiz','peso_maximo') > 0)) {
			$peso_este += $conf->g('raiz', 'peso_actual');

			if ($conf->g('inc','estado')) {
				$peso_este += PFN_espacio_disco($arq_inc, true);
			}

			$conf->p($peso_este, 'raiz', 'peso_actual');
			$usuarios->init('peso', $peso_este, $conf->g('raiz','id'));
		}
	}
}

if ($erro) {
	$accions->arquivos($arquivos);

	$editar_ancho = intval($vars->post('ancho'));
	$editar_alto = intval($vars->post('alto'));

	$editar_ancho = ($editar_ancho == 0)?650:$editar_ancho;
	$editar_alto = ($editar_alto == 0)?400:$editar_alto;

	$vars->post('texto2',$vars->post('texto'));

	include ($PFN_paths['plantillas'].'posicion.inc.php');
	include ($PFN_paths['plantillas'].'novo_arq.inc.php');
} else {
	include ($PFN_paths['web'].'navega.inc.php');
}

$tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
