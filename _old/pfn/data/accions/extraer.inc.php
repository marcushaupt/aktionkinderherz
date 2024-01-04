<?php
/****************************************************************************
* data/accions/extraer.inc.php
*
* Descomprime un fichero tar/gzip/bzip2 en el servidor
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

defined('OK') && defined('ACCION') or die();

$erro = 0;

if ($arquivos->vale_extraer($arquivo)) {
	include_once ($PFN_paths['include'].'class_extraer.php');

	$ext = explode('.', $cal);
	$ext = strtolower(end($ext));

	switch ($ext) {
		case 'tar':
			$extraer = new PFN_tar_file($arquivo);
			break;
		case 'gz':
		case 'tgz':
		case 'gzip':
			$extraer = new PFN_gzip_file($arquivo);
			break;
		case 'bzip':
		case 'bzip2':
		case 'bz':
		case 'bz2':
//			$extraer = new PFN_bzip_file($arquivo);
//			break;
		default:
			$erro = 1;
			break;
	}

	if ($erro) {
		$estado_accion = $conf->t('estado.extraer', 2);
	} else {
		@set_time_limit($conf->g('tempo_maximo'));
		@ini_set('memory_limit', $conf->g('memoria_maxima'));

		$visto = array();
		$estado_accion = '';

		if ($conf->g('inc','indexar')) {
			include_once ($PFN_paths['include'].'class_indexador.php');

			$indexador = new PFN_Indexador($conf);
			$extraer->indexador($indexador, "$dir/");
		}

		$extraer->pon_opcion('overwrite', intval($vars->get('sobreescribir')));
		$extraer->niveles($niveles);
		$extraer->limite_peso($conf->g('raiz','peso_actual'), $conf->g('raiz','peso_maximo'));

		$erro = $extraer->extract_files();

		$accions->log_accion('extraer', $arquivo);

		if ($conf->g('raiz','peso_maximo') > 0) {
			$peso_este = $extraer->get_actual();

			$conf->p($peso_este, 'raiz', 'peso_actual');
			$usuarios->accion('peso', $peso_este, $conf->g('raiz','id'));
		}

		if (count($erro)) {
			foreach ($erro as $v) {
				if (!in_array($v, $visto)) {
					$visto[] = $v;
					$estado_accion .= '<br />'.$conf->t('estado.extraer', $v);
				}
			}
		} else {
			$estado_accion = $conf->t('estado.extraer', 1);
		}
	}
}

$tempo->rexistra('preplantillas');
	
include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');
	
$tempo->rexistra('precodigo');
	
include ($PFN_paths['web'].'navega.inc.php');
	
$tempo->rexistra('postcodigo');
	
include ($PFN_paths['plantillas'].'pe.inc.php');
?>
