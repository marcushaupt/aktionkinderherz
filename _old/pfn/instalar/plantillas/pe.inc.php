<?php
/****************************************************************************
* instalar/plantillas/pe.inc.php
*
* plantilla para la visualizaci�n del pie de p�gina del instalador
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
?>
	</div>
	<br class="nada" />
</div>
<!--

Tempos de execucion:

<?php echo $tempo->dump(); ?>

//-->
<div id="pe_i">
	<div id="pe_texto"><a href="http://pfn.sourceforge.net/" onclick="window.open(this.href, '_blank'); return false"><?php echo $conf->t('PFN').'</a> - '.$conf->t('tempo_execucion').': '.$tempo->total().' '.$conf->t('segundos'); ?></div>
</div>
</body>
</html>
