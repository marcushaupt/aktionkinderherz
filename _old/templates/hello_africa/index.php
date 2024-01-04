<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// needed to seperate the ISO number from the language file constant _ISO
$iso = split( '=', _ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if ( $my->id ) {
	initEditor();
}
?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/templates/hello_africa/css/template_css.css" />
</head>
<body bgcolor="#CF4C36" class="body">
<center>
<table width="760" border="0" cellspacing="0" cellpadding="0" class="main_table">
  <tr>
    <td colspan="2" bgcolor="#999966" height="6"><img src="<?php echo $mosConfig_live_site;?>/templates/hello_africa/images/separator.gif" width="758" height="6" alt="" /></td>
    </tr>
  <tr valign="top">
    <td width="178" bgcolor="#FFE3A4" class="left_td">
	<?php mosLoadModules ('left'); ?>
        <?php if (mosCountModules ('user1')) { 
		  mosLoadModules ('user1'); } ?>
        <?php if (mosCountModules ('user2')) { 
		  mosLoadModules ('user2'); } ?>
</td>
    <td width="578" bgcolor="#FFFFFF" class="right_td">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#FEB05E" valign="middle">
    <td width="50%" height="34" align="left" class="top_td" style="padding-left:14px; font-size:10px; font-weight:bold; color:#993300;"><?php echo mosCurrentDate(); ?></td>
    <td width="50%" height="34" align="right" class="top_td" style="padding-right:10px;">
		<form action='index.php' method='post' style="margin-bottom: 0;">
    <input size="26" type="text" name="searchword" class="inputbox" value="<?php echo _SEARCH_TITLE ?>..." onblur="if(this.value=='') this.value='<?php echo _SEARCH_TITLE ?>...';" onfocus="if(this.value=='<?php echo _SEARCH_TITLE ?>...') this.value='';" />
    <input type="image" name="option" value="search" src="<?php echo $mosConfig_live_site;?>/templates/hello_africa/images/search.gif" width="17" height="18" alt="<?php echo _SEARCH_TITLE ?>" />
	<input type="hidden" name="option" value="search" style="margin-bottom: 5px;"/>
		</form>
	</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FEB05E"><a href="<?php echo $mosConfig_live_site;?>" target="_self"><img src="<?php echo $mosConfig_live_site;?>/templates/hello_africa/images/header.jpg" alt="" width="578" height="122" border="0" /></a></td>
    </tr>
  <tr valign="middle">
    <td colspan="2" bgcolor="#FEE07D" class="path_td"><?php mosPathWay(); ?></td>
	</tr>
		<?php if (mosCountModules ('top')) { ?>
  <tr valign="top">
    <td colspan="2" bgcolor="#FFEFCA" class="mod_top"><?php mosLoadModules ('top'); ?></td>
    </tr>
	<?php } ?>
	<tr valign="top">
	<td colspan="2" align="left" style="padding:4px 1px;"><?php mosMainBody(); ?></td>
    </tr>
	        <?php if (mosCountModules ('bottom')) { ?>
  <tr valign="bottom">
    <td colspan="2" align="center" class="ban"><?php mosLoadModules ('bottom'); ?></td>
    </tr>
	<?php } ?>
</table>
	</td>
  </tr>
  <tr valign="middle" bgcolor="#FEB05E">
    <td width="178" height="34" class="bot_td1"><img src="<?php echo $mosConfig_live_site;?>/templates/hello_africa/images/bottom.jpg" alt="" width="178" height="34" border="0" /></td>
    <td width="578" align="right" class="bot_td2">
			        <?php if (mosCountModules ('user3')) { ?>
		<div align="left"><?php mosLoadModules ('user3'); ?></div></td>
    </tr>
	<?php } ?>

	</td>
  </tr>
</table>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr valign="middle">
    <td height="30" align="right">Free Design by [ Anch ] <a href="http://support.gorsk.net" target="_blank" title="Template Support Site"><font color="#333300">Gorsk.net Studio</font></a></td>
  </tr>
</table>

</center>
<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>
