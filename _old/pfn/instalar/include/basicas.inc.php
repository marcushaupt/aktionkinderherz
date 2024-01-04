<?php
/*******************************************************************************
* instalar/include/basicas.inc.php
*
* Crea el fichero de configuraci�n basicas.inc.php
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

function basicas ($datos) {
	global $PFN_paths;

	$conf = (object) NULL;
	$arquivos = new PFN_Arquivos($conf);

	$licencia['script'] = 'data/conf/basicas.inc.php';
	$licencia['descricion'] = 'Fichero de configuraci�nes b�sicas';
	$PFN_version = $datos['version'];

	$texto = '<?php'."\n";
	$texto .= include ($PFN_paths['include'].'licencia.php');
	$texto .= "\n\n".'defined(\'OK\') or die();'
		."\n\n".'// Este fichero se crea automaticamente, pero se pueden'
		."\n".'// variar los valores almacenados si es necesario'
		."\n".'// This file is created automatically, but you can change'
		."\n".'// the values if it\'s necessary'
		."\n".'return array('
		."\n\t".'\'clave\' => \''.md5(microtime()).'\', // Clave de encriptaci�n / Encription key'
		."\n\t".'\'version\' => \''.$datos['version'].'\','
		."\n\t".'\'estilo\' => \''.$datos['estilo'].'\','
		."\n\t".'\'idioma\' => \''.$datos['idioma'].'\', // Language'
		."\n\t".'\'email\' => \''.$datos['email'].'\','
		."\n\t".'\'gd2\' => '.($datos['gd2']?'true':'false').', // GD2 instalado / GD2 installed'
		."\n\t".'\'zlib\' => '.($datos['zlib']?'true':'false').', // ZLIB instalado / ZLIB installed'
		."\n\t".'\'charset\' => \''.$datos['charset'].'\', // Juego de caracteres / Charset'
		."\n\t".'\'envio_alertas\' => '.($datos['envio_alertas']?'true':'false').', // Envio de correo alertando de intento de intrusion / Send mail notify an intrusion try access'
		."\n\t".'\'db\' => array( // Base de datos / Data base'
		."\n\t\t".'\'host\' => \''.$datos['db:host'].'\','
		."\n\t\t".'\'base_datos\' => \''.$datos['db:base_datos'].'\', // Nombre de la base de datos / Data base name'
		."\n\t\t".'\'usuario\' => \''.$datos['db:usuario'].'\', // Usuario / User'
		."\n\t\t".'\'contrasinal\' => \''.$datos['db:contrasinal'].'\', // Contrase�a / Password'
		."\n\t\t".'\'prefixo\' => \''.$datos['db:prefixo'].'\' // Prefijo para las tablas / Table prefix'
		."\n\t".')'
		."\n);\n?>";

	$arquivos->abre_escribe($PFN_paths['conf'].'basicas.inc.php', $texto);
}
?>
