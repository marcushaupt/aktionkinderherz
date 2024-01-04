<?php
/*******************************************************************************
* instalar/include/nada.inc.php
*
* Ejecuta la pantalla de fin de instalaci�n o de error
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

if (is_array($actual) && is_writable($PFN_paths['conf'].'basicas.inc.php')) {
	if ($con = @mysql_connect($actual['db']['host'], $actual['db']['usuario'], $actual['db']['contrasinal'])) {
		if (!@mysql_select_db($actual['db']['base_datos'], $con)) $erro[] = 18;
	} else $erro[] = 17;	
}
if (!is_writable($PFN_paths['conf'])) $erro[] = 19;
if (!is_writable($PFN_paths['tmp'])) $erro[] = 21;
if (!is_writable($PFN_paths['logs'])) $erro[] = 22;
if (!is_writable($PFN_paths['info'])) $erro[] = 23;

$accion = 'nada';

if (is_array($erro)) {
	include ($PFN_paths['instalar'].'plantillas/cab_instalar.inc.php');
} else {
	include ($PFN_paths['instalar'].'plantillas/ok.inc.php');
}

@mysql_close($con);
?>
