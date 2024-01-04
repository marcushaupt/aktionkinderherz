<?php
/****************************************************************************
* xestion/raices/index.inc.php
*
* Comprobaciones antes de modificar o a�adir una raiz
*

PHPfileNavigator versi�n 2.1.0

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

$Dgrupos = $Dconfs = array();

if (!is_writable($PFN_paths['info'])) {
	$erro[] = 'Xinfonon_writable';
}

if (empty($id_raiz)) {
	$usuarios->init('grupos_configuracions_usuarios');
} else {
	$usuarios->init('grupos_configuracions_usuarios_raiz', $id_raiz);
}

for (; $usuarios->mais(); $usuarios->seguinte()) {
	$Dgrupos[$usuarios->get('id_grupo')]['nome'] = $usuarios->get('grupo');
	$Dgrupos[$usuarios->get('id_grupo')]['id_conf'] = $usuarios->get('id_conf');
	$Dgrupos[$usuarios->get('id_grupo')]['usuarios'][$usuarios->get('id_usuario')] = array($usuarios->get('usuario'), $usuarios->get('relacion'));
}

$usuarios->init('configuracions_valen');

for (; $usuarios->mais(); $usuarios->seguinte()) {
	$Dconfs[$usuarios->get('id')] = $usuarios->get('conf');
}

$usuarios->init('raiz', $id_raiz);

$peso_maximo = $usuarios->get('peso_maximo');
$peso_actual = $usuarios->get('peso_actual');
?>
