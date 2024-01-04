<?php
/*******************************************************************************
* instalar/include/funcions.inc.php
*
* Funciones b�sicas y comunes para la instalaci�n
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

function PFN_mover_inc ($dir) {
	global $PFN_paths;

	$od = @opendir($dir);

	while ($cada = @readdir($od)) {
		if ($cada == '.' || $cada == '..') {
			continue;
		}

		if (is_dir($dir.$cada)) {
			PFN_mover_inc($dir.$cada.'/');
		} elseif (eregi('^\..*(jpg|png|gif|jpeg)$', $cada)
		|| ereg('^\..*\.INC$', $cada)) {
			PFN_crea_directorio_recursivo($PFN_paths['extra'].$dir);

			if (eregi('^\..*(jpg|png|gif|jpeg)$', $cada)) {
				$destino = $PFN_paths['extra'].$dir.'/'.substr($cada, 1);
			} elseif (ereg('^\..*\.INC$', $cada)) {
				$destino = $PFN_paths['extra'].$dir.'/'.substr($cada, 1, -4).'.php';
			} else {
				$destino = $PFN_paths['extra'].$dir.'/'.$cada;
			}

			if (@copy($dir.$cada, $destino)) {
				@unlink($dir.$cada);
			}
		}
	}

	@closedir($od);
}
?>
