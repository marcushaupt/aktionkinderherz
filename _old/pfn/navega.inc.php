<?php
/****************************************************************************
* nagega.inc.php
*
* Carga lo necesario para la visualizaci�n de la navegaci�n principal
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

defined('OK') or die();

$tempo->rexistra('i:navega');

$lista = $vars->get('lista');
$orde = $vars->get('orde');
$pos = $vars->get('pos');

$niveles->posicion($lista);
$cada = $niveles->get_contido($conf->g('raiz','path').$dir,$orde,$pos);

$cnt_dir = $niveles->cnt('dir');
$cnt_arq = $niveles->cnt('arq');
$cnt_peso = PFN_peso($niveles->cnt('peso'));

if ($conf->g('inc','estado')) {
	include_once ($PFN_paths['include'].'class_inc.php');
	$inc = new PFN_INC($conf);

	$inc->carga_datos($conf->g('raiz','path').$dir.'/');
}

$tempo->rexistra('f:navega');

include ($PFN_paths['plantillas'].'posicion.inc.php');

$tempo->rexistra('posicion');

include ($PFN_paths['plantillas'].'navega.inc.php');
?>
