<?php
/*******************************************************************************
* instalar/plantillas/paso_6.inc.php
*
* Plantilla para el sexto paso de la instalaci�n
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
<h2><?php echo $conf->t('i:remate'); ?></h2>

<br /><?php echo $conf->t('i:intro_remate'); ?><br />

<div class="bloque_info">
	<div id="resumo_dir">
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=10&amp;type=0" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/paypal.png" alt="[<?php echo $doar_paypal; ?> $10]" /><br /><?php echo $doar; ?> $10</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=20&amp;type=0" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/paypal.png" alt="[<?php echo $doar_paypal; ?> $20]" /><br /><?php echo $doar; ?> $20</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=30&amp;type=0" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/paypal.png" alt="[<?php echo $doar_paypal; ?> $30]" /><br /><?php echo $doar; ?> $30</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=50&amp;type=0" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/paypal.png" alt="[<?php echo $doar_paypal; ?> $50]" /><br /><?php echo $doar; ?> $50</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=100&amp;type=0" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/paypal.png" alt="[<?php echo $doar_paypal; ?> $100]" /><br /><?php echo $doar; ?> $100</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=150&amp;type=0" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/paypal.png" alt="[<?php echo $doar_paypal; ?> $150]" /><br /><?php echo $doar; ?> $150</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=200&amp;type=0" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/paypal.png" alt="[<?php echo $doar_paypal; ?> $200]" /><br /><?php echo $doar; ?> $200</a>

		<br class="nada" />

		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=10&amp;type=1" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/tarxeta_credito.png" alt="[<?php echo $doar_tarxeta; ?> $10]" /><br /><?php echo $doar; ?> $10</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=20&amp;type=1" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/tarxeta_credito.png" alt="[<?php echo $doar_tarxeta; ?> $20]" /><br /><?php echo $doar; ?> $20</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=30&amp;type=1" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/tarxeta_credito.png" alt="[<?php echo $doar_tarxeta; ?> $30]" /><br /><?php echo $doar; ?> $30</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=50&amp;type=1" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/tarxeta_credito.png" alt="[<?php echo $doar_tarxeta; ?> $50]" /><br /><?php echo $doar; ?> $50</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=100&amp;type=1" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/tarxeta_credito.png" alt="[<?php echo $doar_tarxeta; ?> $100]" /><br /><?php echo $doar; ?> $100</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=150&amp;type=1" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/tarxeta_credito.png" alt="[<?php echo $doar_tarxeta; ?> $150]" /><br /><?php echo $doar; ?> $150</a>
		<a href="https://sourceforge.net/donate/index.php?group_id=142312&amp;amt=200&amp;type=1" onclick="window.open(this.href); return false" class="subcontido" style="text-align: center"><img src="<?php echo $relativo.$conf->g('estilo'); ?>imx/tarxeta_credito.png" alt="[<?php echo $doar_tarxeta; ?> $200]" /><br /><?php echo $doar; ?> $200</a>
		<br class="nada" />
	</div>
</div>
