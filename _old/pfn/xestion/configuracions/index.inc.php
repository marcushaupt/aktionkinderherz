<?php
/****************************************************************************
* xestion/configuracions/index.inc.php
*
* Carga los datos y relaciones de un fichero de configuraci�n
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

defined('OK') && defined('XESTION') or die();

if ($vars->get('erros') != '') {
	$erros = explode(',', $vars->get('erros'));
} else {
	$erros = array();
}

$editar = $eliminar = $existe_arq = false;
$ok = ($vars->get('ok') == '')?false:intval($vars->get('ok'));

$existe = $usuarios->init('configuracion', $id_conf);
$nome = $usuarios->get('conf');
$vale = $usuarios->get('vale');
$nome_arq = $niveles->path_correcto($PFN_paths['conf'].$nome.'.inc.php');

if ($existe) {
	$eliminar = true;

	if (is_file($nome_arq)) {
		$existe_arq = true;
		$stat = stat($nome_arq);

		if (is_writable($nome_arq)) {
			$editar = true;
		} else {
			$erros[] = 19;
		}
	} else {
		$erros[] = 18;
	}
} else {
	$erros[] = 18;
	$stat = array();
}
?>
