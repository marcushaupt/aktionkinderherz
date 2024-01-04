<?php
/****************************************************************************
* comprobar.php
*
* Control de login que redirije para el men� o vuelve al index
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

include ('paths.php');
include_once ($PFN_paths['include'].'borra_cache.php');
include_once ($PFN_paths['include'].'funcions.php');
include_once ($PFN_paths['include'].'class_conf.php');
include_once ($PFN_paths['include'].'class_vars.php');
include_once ($PFN_paths['include'].'mysql.php');
include_once ($PFN_paths['include'].'clases.php');
include_once ($PFN_paths['include'].'class_usuarios.php');
include_once ($PFN_paths['include'].'class_sesion.php');

$sesion->encriptar(false,true);

$conf->inicial('login');
$usuarios->vars($vars);

$ok = true;
$sPFN = array();
$usuario = $usuarios->login('usuario');
$contrasinal = $usuarios->login('contrasinal');

$usuarios->init('intentos');

if ($usuarios->get('intentos') >= $usuarios->intentos_errados) {
	$ok = false;
}

if ($ok && $usuarios->init('login',$usuario,$contrasinal)) {
	$sPFN['usuario'] = array(
		'id' => $usuarios->get('id'),
		'usuario' => $usuario,
		'contrasinal' => $contrasinal,
		'admin' => $usuarios->get('admin'),
		'id_grupo' => $usuarios->get('id_grupo'),
		'conf_defecto' => $usuarios->get('conf_defecto'),
		'mantemento' => $usuarios->get('mantemento'),
		'descargas_maximo' => $usuarios->get('descargas_maximo'),
		'cambiar_datos' => $usuarios->get('cambiar_datos'),
	);

	if (!$usuarios->sesion_iniciada) {
		session_start();
	}

	session_register('sPFN');
	$vars->session('sPFN', $sPFN);

	session_write_close();

	$usuarios->garda_rexistro('login',1);

	Header('Location: menu.php?'.session_name().'='.session_id());
	exit;
} else {
	$usuarios->usuario = $usuarios->corrixe($usuario);
	$usuarios->garda_rexistro('login',0);

	$url = $vars->server('HTTP_REFERER');

	if (empty($url)) {
		$url = 'index.php?erro=1';
	} elseif (!strstr($url, 'erro=1')) {
		$url .= (strstr($url, '?')?'&':'?').'erro=1';
	}
	
	Header('Location: '.$url);
	exit;
}
?>
