<?php
/*******************************************************************************
* instalar/plantillas/actualizar.inc.php
*
* Plantilla para  ver el resultado de las actualizaciones
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
<h2><?php echo $conf->t('i:actualizar'); ?></h2>

<br /><?php echo $conf->t('i:intro_actualizar'); ?><br /><br />

<form action="index.php" method="post">
<fieldset>
<input type="hidden" id="paso" name="paso" value="<?php echo count($erros)?5:6; ?>" />

<?php if (count($erros) > 0) { ?>
<input type="hidden" name="ignorar" value="true" />
<?php } ?>

<input type="hidden" name="idioma" value="<?php echo $form['idioma']; ?>" />
<input type="hidden" name="aviso_instalacion" value="<?php echo $form['aviso_instalacion']; ?>" />
<input type="hidden" name="tipo" value="<?php echo $form['tipo']; ?>" />
<input type="hidden" name="zlib" value="<?php echo $form['zlib']; ?>" />
<input type="hidden" name="gd2" value="<?php echo $form['gd2']; ?>" />
<input type="hidden" name="charset" value="<?php echo $form['charset']; ?>" />
<input type="hidden" name="db_servidor" value="<?php echo $form['db_servidor']; ?>" />
<input type="hidden" name="db_nome" value="<?php echo $form['db_nome']; ?>" />
<input type="hidden" name="db_usuario" value="<?php echo $form['db_usuario']; ?>" />
<input type="hidden" name="db_prefixo" value="<?php echo $form['db_prefixo']; ?>" />
<input type="hidden" name="ad_nome" value="<?php echo addslashes($form['ad_nome']); ?>" />
<input type="hidden" name="ad_usuario" value="<?php echo $form['ad_usuario']; ?>" />
<input type="hidden" name="ad_correo" value="<?php echo $form['ad_correo']; ?>" />
<input type="hidden" name="ra_nome" value="<?php echo addslashes($form['ra_nome']); ?>" />
<input type="hidden" name="ra_path" value="<?php echo $form['ra_path']; ?>" />
<input type="hidden" name="ra_web" value="<?php echo $form['ra_web']; ?>" />
<input type="hidden" name="ra_dominio" value="<?php echo $form['ra_dominio']; ?>" />

<?php if (in_array(18, $erros)) { ?>
<div class="capa_erro">
	<strong><?php echo $conf->t('i:arq_configuracion'); ?></strong><br />
	<?php echo $conf->t('i:erros', '18'); ?>
</div>
<?php } else { ?>
	<?php if (in_array(15, $erros) || in_array(16, $erros)) { ?>
		<div class="capa_erro">
  		<strong><?php echo $conf->t('i:conexion_mysql'); ?></strong><br />
	  	<?php echo $conf->t('i:mysql_erro'); ?>
		</div>
	<?php } else { ?>
		<div class="capa_ok">
  		<strong><?php echo $conf->t('i:conexion_mysql'); ?></strong><br />
		  <?php echo $conf->t('i:mysql_ok'); ?>
		</div>

		<?php
		if (in_array('200-201', $paso_feito)) {
			include ($PFN_paths['instalar'].'plantillas/actualizar_200-201.inc.php');
		}

		if (in_array('201-220', $paso_feito)) {
			include ($PFN_paths['instalar'].'plantillas/actualizar_201-220.inc.php');
		}

		if (in_array('220-230', $paso_feito)) {
			include ($PFN_paths['instalar'].'plantillas/actualizar_220-230.inc.php');
		}
		?>
	<?php } ?>
<?php } ?>

<?php if (in_array('conf', $feito)) { ?>
<div class="capa_ok">
	<strong><?php echo $conf->t('i:arq_configuracion'); ?></strong><br />
	<?php echo $conf->t('i:arq_configuracion_ok'); ?>
</div>
<?php } ?>

<br />

<input type="submit" value="<?php echo $conf->t(count($erros)?'i:reintentar':'continuar_paso_6'); ?>" class="dereita" />
</fieldset>
</form>
