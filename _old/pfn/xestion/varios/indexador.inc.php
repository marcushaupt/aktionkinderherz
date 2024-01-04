<?php
/****************************************************************************
* xestion/varios/indexador.inc.php
*
* Realiza el proceso de reindexaci�n de ficheros y directorios
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

$indexador_id_raiz = intval($vars->post('indexador_id_raiz'));

if ($indexador_id_raiz > 0) {
	$usuarios->init('raiz', $indexador_id_raiz);

	if ($usuarios->filas() === 1) {
		include_once ($PFN_paths['include'].'class_inc.php');
		include_once ($PFN_paths['include'].'class_indexador.php');

		$inc = new PFN_INC($conf);
		$indexador = new PFN_Indexador($conf);

		$indexador->niveles($niveles);
		$indexador->inc($inc);

		$txt = $indexador->reindexar($usuarios->get('id'), $usuarios->get('path'));
	} else {
		$erros[] = 36;
	}
} else {
	$erros[] = 36;
}
?>
