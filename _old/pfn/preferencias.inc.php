<?php
/****************************************************************************
* preferencias.inc.php
*
* Carga lo necesario para la visualizaci�n de la pantalla de preferencias
* de usuario
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

defined('OK') or die();

$txt_erro = $txt_estado = '';

if ($conf->g('usuario','cambiar_datos')) {
	$ok = $usuarios->init('w:usuario');

	if ($ok != 1) {
		$txt_erro = 'usuario_inexistente';
	}
} else {
	$txt_erro = 'sen_permiso';
}

if (empty($txt_erro) && ($vars->post('executa') == 'true')) {
	$conf->textos('estado');

	$nome = trim($vars->post('preferencias_nome'));
	$email = trim($vars->post('preferencias_email'));
	$contrasinal = trim($vars->post('preferencias_contrasinal'));
	$contrasinal_rep = trim($vars->post('preferencias_contrasinal_rep'));

	if (empty($nome)) {
		$txt_estado = $conf->t('estado.preferencias',2);
	} elseif (empty($email)) {
		$txt_estado = $conf->t('estado.preferencias',5);
	} elseif (strlen($contrasinal) > 0) {
		if (!eregi('^[a-z0-9]{8,}$', $contrasinal)) {
			$txt_estado = $conf->t('estado.preferencias',3);
		} elseif ($contrasinal != $contrasinal_rep) {
			$txt_estado = $conf->t('estado.preferencias',4);
		}
	}

	if (empty($txt_estado)) {
		$datos = array(
			'nome' => $nome,
			'email' => $email,
			'contrasinal' => (empty($contrasinal)?'':md5($contrasinal))
		);

		$ok = $usuarios->cambiar_preferencias($datos);

		if ($ok == -1) {
			$txt_estado = $conf->t('estado.preferencias',0);
		} else {
			if (!empty($contrasinal)) {
				$sPFN['usuario']['contrasinal'] = $datos['contrasinal'];
				session_register('sPFN');

				$vars->session('sPFN', $sPFN);
			}

			$txt_estado = $conf->t('estado.preferencias',1);
		}
	}

	$usuarios->init('w:usuario');
}

session_write_close();
?>
