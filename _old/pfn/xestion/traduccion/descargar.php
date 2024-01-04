<?php
/****************************************************************************
* xestion/traduccion/descargar.inc.php
*
* Realiza la acci�n de descarga de un fichero de idioma
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

$relativo = '../../';

include ($relativo.'paths.php');
include_once ($PFN_paths['include'].'basicweb.php');
include_once ($PFN_paths['include'].'Xusuarios.php');

session_write_close();

PFN_quita_url_SERVER('idioma');

$idioma = $vars->get('idioma');

if (($conf->g('zlib') == true)
&& ereg('^[a-z]+$', $idioma)
&& is_dir($PFN_paths['idiomas'].$idioma)) {
	@set_time_limit($conf->g('tempo_maximo'));
	@ini_set('memory_limit', $conf->g('memoria_maxima'));

	$conf->p(array('^\.'), 'oculto');

	include_once ($PFN_paths['include'].'class_easyzip.php');

	$EasyZIP->comeza($PFN_paths['idiomas'].$idioma);
	$contido = &$EasyZIP->zipFile();
	$tamano = strlen($contido);

	header('Pragma: private');
	header('Expires: 0');
	header('Cache-control: private, must-revalidate');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Content-Type: application/force-download; charset='.$conf->g('charset'));
	header('Content-Transfer-Encoding: binary');
	header('Content-Disposition: attachment; filename="'.$idioma.'.zip"');
	header('Content-Length: '.$tamano);

	echo $contido;
	exit;
} else {
	Header('Location: '.$vars->server('HTTP_REFERER'));
	exit;
}
?>
