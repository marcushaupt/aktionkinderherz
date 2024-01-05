<?php
/*******************************************************************************
* instalar/plantillas/actualizar_220-230.inc.php
*
* Plantilla para el resultado de actualizar desde 2.2.0 a 2.3.0
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

<br /><h3><?php echo $conf->t('i:actualizar_220-230'); ?></h3>

<?php if (in_array('mysql_220-230', $feito)) {?>
	<?php if ($erros['mysql_220-230']) { ?>
		<div class="capa_erro">
			<strong><?php echo $conf->t('i:consultas_mysql'); ?></strong><br />
			<?php echo $conf->t('i:consultas_erro'); ?>
			<br />
			<?php foreach ($erros_q['mysql_220-230'] as $v) { ?>
				<div class="aviso">
					<?php echo $conf->t('i:consulta'); ?>:
					<br /><?php echo $v['consulta']; ?>
					<br /><br /><?php echo $conf->t('i:erro'); ?>:
					<br /><?php echo $v['erro']; ?>
				</div>
			<?php } ?>
		</div>
	<?php } else { ?>
	<div class="capa_ok">
		<strong><?php echo $conf->t('i:consultas_mysql'); ?></strong><br />
		<?php echo $conf->t('i:consultas_ok'); ?>
	</div>
	<?php } ?>
<?php } ?>

<?php if (in_array('dirs_220-230', $feito)) {?>
<div class="capa_ok">
	<strong><?php echo $conf->t('i:creacion_directorios'); ?></strong><br />
	<?php echo $conf->t('i:crear_directorios_ok'); ?>
</div>
<?php } ?>

<?php if (in_array('inc_220-230', $feito)) {?>
<div class="capa_ok">
	<strong><?php echo $conf->t('i:arq_inc'); ?></strong><br />
	<?php echo $conf->t('i:arq_inc_ok'); ?>
</div>
<?php } ?>