<?php
/*******************************************************************************
* instalar/idiomas/idiomas.inc.php
*
* Devuelve un array con los idiomas disponibles
*

PHPfileNavigator versi�n 1.6.3

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

$idiomas = array();

is_dir($PFN_paths['idiomas'].'gl')?($idiomas['gl'] = 'Galego'):false;
is_dir($PFN_paths['idiomas'].'es')?($idiomas['es'] = 'Castellano'):false;
is_dir($PFN_paths['idiomas'].'en')?($idiomas['en'] = 'English'):false;
is_dir($PFN_paths['idiomas'].'it')?($idiomas['it'] = 'Italiano'):false;
is_dir($PFN_paths['idiomas'].'nl')?($idiomas['nl'] = 'Dutch'):false;
is_dir($PFN_paths['idiomas'].'fr')?($idiomas['fr'] = 'Fran�ais'):false;
is_dir($PFN_paths['idiomas'].'de')?($idiomas['de'] = 'Deutsch'):false;

return $idiomas;
?>
