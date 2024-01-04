<?php
/*******************************************************************************
* instalar/include/paso_4.inc.php
*
* Cuarto paso de la instalaci�n
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

$erros = array();

$form['db_servidor'] = empty($form['db_servidor'])?'localhost':$form['db_servidor'];
$form['db_prefixo'] = empty($form['db_prefixo'])?'pfn_':$form['db_prefixo'];

$form['ra_path'] = empty($form['ra_path'])?($vars->server('DOCUMENT_ROOT').'/'):$form['ra_path'];
$form['ra_web'] = empty($form['ra_web'])?'/':$form['ra_web'];
$form['ra_dominio'] = empty($form['ra_dominio'])?$vars->server('SERVER_NAME'):$form['ra_dominio'];

include ($PFN_paths['instalar'].'plantillas/paso_4.inc.php');
?>
