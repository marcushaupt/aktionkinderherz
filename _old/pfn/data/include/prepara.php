<?php
/****************************************************************************
* data/include/prepara.php
*
* Precarga y controla el valor de ciertas variables
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

PFN_quita_url_SERVER(array('id','accion','cal','lista','completo','executa','posX','posY','modo','ancho','alto','sobreescribir'));

$conf->carga();

$niveles = new PFN_Niveles($conf);

$dir = $niveles->path_correcto($vars->get('dir'));
$vars->get('dir',$dir);

$ver_imaxes = $vars->get('ver_imaxes');
$estado_accion = '';

$info_raiz = $niveles->path_correcto($PFN_paths['info'].'raiz'.$conf->g('raiz','id'));
$info_usuario = $niveles->path_correcto($PFN_paths['info'].'usuario'.$sPFN['usuario']['id']);

$conf->p($info_usuario, 'info_usuario');
$conf->p($info_raiz, 'info_raiz');

if (defined('MENU')) {
	$conf->p(0, 'raiz', 'peso_maximo');
	$conf->p(0, 'raiz', 'peso_actual');
}

if (is_file($info_usuario.'/descargas.'.(date('Ym')).'.php')) {
	$conf->p(include ($info_usuario.'/descargas.'.(date('Ym')).'.php'), 'usuario', 'descargas_actual');
}
?>
