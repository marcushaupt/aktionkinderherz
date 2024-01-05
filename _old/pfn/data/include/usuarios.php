<?php
/****************************************************************************
* data/include/usuarios.php
*
* Controla el acceso en cada petici�n
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

defined('OK') or die();

function envia_erro ($erro) {
	global $vars, $conf, $relativo;

	if ($conf->g('envio_alertas')) {
		$erros = array(
			1 => 'Intento de colar datos de usuario',
			2 => 'No existen los datos de usuario',
			3 => 'Datos de usuario incorrectos',
			4 => "Intento de acceso en la administraci�n de usuario no v�lido",
		);

		$t = 'Alerta de seguridad en '.$vars->server('SERVER_NAME');
		$m = 'Alerta por intento de acceso al servidor '.$vars->server('SERVER_NAME')
			."\nEn la URL ".$vars->server('PHP_SELF')
			."\nA las ".date('Y-m-d H:i')
			."\nDesde la IP ".$vars->ip()
			."\n\n".$erros[$erro];

		ob_start();
		echo "\n\nDatos de GET:\n";
		var_dump($vars->get(''));

		echo "\n\nDatos de POST:\n";
		var_dump($vars->post(''));

		echo "\n\nDatos de SESSION:\n";
		var_dump($vars->session(''));

		$m .= ob_get_contents();
		ob_end_clean();

		@mail($conf->g('email'),$t,$m);
	}

	$conf->inicial('default');

	@session_start();

	$sPFN = '';
	session_register('sPFN');
	session_unregister('sPFN');
	
	$url = $conf->g('saida');
	$url = 'index.php'?"$relativo$url":$url;
	$url .= (strstr($url, '?')?'&':'?');

	if ($conf->g("manter_session")) {
		$url .= session_name().'='.session_id().'&';
	} else {
		@session_unset();
		@session_destroy();
	}

	session_write_close();

	Header('Location: '.$url.'erro=1');
	exit;
}

unset($erro);

$tmp_sPFN = trim($vars->get('sPFN'));
$tmp_sPFN .= trim($vars->post('sPFN'));

if (!empty($tmp_sPFN)) {
	$usuarios->garda_rexistro('colar', 0);
	envia_erro(1);
}

session_start();

$sPFN = $vars->session('sPFN');

if (!is_array($sPFN) || !count($sPFN)) {
	$usuarios->garda_rexistro('vacios', 0);
	envia_erro(2);
}

$id = $vars->get('id');

if (empty($id)) {
	unset($id);
}

if (empty($id)
&& empty($sPFN['raiz']['id'])
&& basename($vars->server('PHP_SELF')) != 'menu.php') {
	session_write_close();

	Header('Location: '.$relativo.'menu.php?'.session_name().'='.session_id());
	exit;
} elseif (!empty($id)) {
	$sPFN['raiz']['id'] = $id;

	session_register('sPFN');
	$vars->session('sPFN', $sPFN);
}

if (!$usuarios->init('session')) {
	$usuarios->garda_rexistro('session', 0);
	envia_erro(3);
}

$conf->p($sPFN['raiz']['id'],'raiz','id');
$conf->p($sPFN['raiz']['unica'],'raiz','unica');
$conf->p($usuarios->get('nome'),'raiz','nome');
$conf->p($usuarios->get('path'),'raiz','path');
$conf->p($usuarios->get('web'),'raiz','web');
$conf->p($usuarios->get('host'),'raiz','host');
$conf->p($usuarios->get('conf'),'raiz','conf');
$conf->p($usuarios->get('mantemento'),'raiz','mantemento');
$conf->p($usuarios->get('peso_maximo'),'raiz','peso_maximo');
$conf->p($usuarios->get('peso_actual'),'raiz','peso_actual');

foreach ($sPFN['usuario'] as $k => $v) {
	$conf->p($v, 'usuario', $k);
}
?>