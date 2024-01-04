<?php
/****************************************************************************
* accion.php
*
* Controla y ejecuta los permisos sobre la realización de una acción
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

include ('paths.php');

$borra_cache = is_array($_GET)?($_GET['accion'].$_POST['accion']):($HTTP_GET_VARS['accion'].$HTTP_POST_VARS['accion']);
$borra_cache = ($borra_cache != 'descargar');

include ($PFN_paths['include'].'basicweb.php');

session_write_close();

$tempo->rexistra('precarga');

$vars->server('PHP_SELF','navega.php');

$accion = $niveles->nome_correcto($vars->get('accion').$vars->post('accion'));

include_once ($PFN_paths['include']."class_imaxes.php");
include_once ($PFN_paths['include']."class_arquivos.php");

$imaxes = new PFN_Imaxes($conf);
$arquivos = new PFN_Arquivos($conf);

if (!empty($accion) && $conf->g('permisos',$accion)
&& is_file($PFN_paths['accions']."$accion.inc.php")) {
	define('ACCION', true);

	$conf->textos('estado');

	include_once ($PFN_paths['include']."class_accions.php");
	$accions = new PFN_Accions($conf);

	$tempo->rexistra('precomprobacion');

	$cal = $arquivo = $ucal = $tipo = $enlace_abs = '';
	$e_imaxe = $redimensionar = $redimensionar_dir = $ver_contido = false;
	$editar = $extraer = $ver_comprimido = $descargar = $correo = false;

	if (!in_array($accion, array('crear_dir','subir_arq','subir_url','multiple_copiar','multiple_mover','multiple_eliminar','multiple_permisos','multiple_descargar','buscador','novo_arq'))) {
		$cal = $vars->post('executa')?$vars->post('cal'):$vars->get('cal');
		$cal = $accions->nome_correcto($cal);
		$arquivo = str_replace(array('/./','/'),'/',$conf->g('raiz','path').$accions->path_correcto($dir.'/').'/'.$cal);
		$ucal = rawurlencode($cal);
		$tipo = is_file($arquivo)?'arq':(is_dir($arquivo)?'dir':'');
		$fin = ($tipo == 'dir')?'/':'';
		$enlace_abs = $niveles->enlace($dir, $cal).$fin;

		$tempo->rexistra('pretipo');

		if (empty($tipo) || empty($cal) || (!$niveles->filtrar($cal) && $cal != '.')) {
			Header('Location: '.PFN_quita_url(array('cal','accion'), true, true));
			exit;
		} elseif ($tipo == 'arq') {
			$e_imaxe = $imaxes->e_imaxe($arquivo);
			$redimensionar = $e_imaxe && $conf->g('permisos','redimensionar');
			$ver_contido = !$e_imaxe && $arquivos->editable($cal) && $conf->g('permisos','ver_contido');
			$editar = !$e_imaxe && $arquivos->editable($cal) && $conf->g('permisos','editar');
			$extraer = !$e_imaxe && $arquivos->vale_extraer($arquivo);
			$ver_comprimido = !$e_imaxe && $arquivos->vale_extraer($arquivo, true);
			$descargar = $conf->g('permisos','descargar');
			$correo = $conf->g('permisos','correo');
		} else {
			$redimensionar_dir = $conf->g('permisos','redimensionar_dir');
		}
	}

	$tempo->rexistra('preaccion');

	include ($PFN_paths['accions']."$accion.inc.php");

	$tempo->rexistra('postaccion');
} else {
	$tempo->rexistra('preplantillas');

	include ($PFN_paths['plantillas'].'cab.inc.php');
	include ($PFN_paths['web'].'opcions.inc.php');

	$tempo->rexistra('precodigo');

	include ($PFN_paths['web'].'navega.inc.php');

	$tempo->rexistra('postcodigo');

	include ($PFN_paths['plantillas'].'pe.inc.php');
}
?>
