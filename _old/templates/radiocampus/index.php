<?php echo "<?xml version=\"1.0\"?".">"; ?>
<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $mosConfig_sitename; ?></title>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php include ("includes/metadata.php"); ?>
<?php include ("editor/editor.php"); ?>
<script language="JavaScript" type="text/javascript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
<link href="<?php echo $mosConfig_live_site;?>/templates/radiocampus/css/template_css.css" rel="stylesheet" type="text/css" />
<?php initEditor(); ?>
</head>

<body>
<br><br><br>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" valign="top">
<tr><td>
<table width="100%" height="45" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="<?php echo $mosConfig_live_site;?>/templates/logo_top_pa.jpg" width="800" height="90"></td>
  </tr>
 </table>
<table width="100%" height="25" border="0" align="center" cellpadding="0" cellspacing="0" background="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/background_top.jpg" height="25">
  <tr>
  	<td>
	 &nbsp;<span class="pathway"><strong>Seitenindex:</strong>&nbsp;<?php include "pathway.php"; ?></span>
        </td>
	<td align="right" class="Date"><?php echo (strftime (_DATE_FORMAT_LC)); ?>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#005D83">
  <tr valign="top">
    <td width="160" height="184" bgcolor="#007294"><!--hier ist die breite für die linke spalte-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="1" height="10"></td>
       </tr>
        <tr>
          <td width="10" height="35" class="borderleft">&nbsp;</td>
          <td width="87%" valign="top" class="bordertopbottom">
            <?php mosLoadModules ( 'left' ); ?>
          </td>
          <td width="10" class="borderright">&nbsp;</td>
        </tr>
      </table>
      <br>
	  <?php if ( mosCountModules( 'user1' ) > 0 ) { ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="6%" height="35" class="borderleft">&nbsp;</td>
          <td width="87%" valign="top" class="bordertopbottom">
            <?php mosLoadModules ( 'user1' ); ?>
          </td>
          <td width="7%" class="borderright">&nbsp;</td>
        </tr>
      </table>
	  <br>
	  <?php }; ?>
<!--suche entweder ausbauen oder neue oder keine
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
          <td width="6%" height="35" class="borderleft">&nbsp;</td>
	  <td width="87%" valign="top" class="bordertopbottom">
             <form action='index.php' method='post'>
	     <div align="center">
	     <input class="inputbox" type="text" name="searchword" size="15" value="<?php echo _SEARCH_BOX; ?>" onblur="if(this.value==") this.value='<?php echo _SEARCH_BOX; ?>') this.value=";" />
	     <input type="hidden" name="option" value="search" />
	     </div>
	     </form>
          </td>
          <td width="7%" class="borderright">&nbsp;</td>
        </tr>
     </table>-->
  </td>
    <td width="483"><!--hier ist die breite für den content in der mitte-->
    	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="10" height="10"></td>
		<td></td>
		<td></td>
	</tr>
	<?php if ( mosCountModules( 'top' ) > 0 ) { ?>
	 <tr>
                <td class="borderleft_main">&nbsp;</td>
                <td class="bordertopbottom_main"><?php mosLoadModules ( 'top' ); ?></td>
                <td class="borderright_main"><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="10" height="10"></td>
         </tr>
         <tr>
                <td><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="10" height="10"></td>
                <td></td>
                <td></td>
        </tr>
	<?php }; ?>
	 <tr>
          <td width="1%" height="40" class="borderleft_main">&nbsp;</td>
          <td width="96%" valign="top" class="bordertopbottom_main"> <br />
            <?php include ("mainbody.php"); ?>
          </td>
          <td width="3%" class="borderright_main">&nbsp;</td>
        </tr>
      </table>
      </td>
    <td width="157"><!--hier ist die breite für die rechte spalte-->
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="1" height="10"></td>
	  <td></td>
	</tr>
	<tr>
	<td><img src="<?php echo $mosConfig_live_site;?>/templates/fruehchen.jpg" width="147" class="bildrechts"></td>
	<td><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="10" height="10"></td>
	</tr>
	<tr>
           <td><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="1" height="10"></td>
           <td><td>
        </tr>
       </table>
	<?php if ( mosCountModules( 'right' ) > 0 ) { ?>
         <table width="159" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="43" class="borderleft_main"><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="1" height="1"></td>
          <td width="149" valign="top" class="bordertopbottom_main">
            <?php mosLoadModules ( 'right' ); ?>
          </td>
          <td class="borderright_main"><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="10" height="1"></td>
	  </tr>
      </table>
	  <?php }; ?>
	  <?php if ( mosCountModules( 'user2' ) > 0 ) { ?>
      <table width="159" border="0" cellspacing="0" cellpadding="0">
      <tr>
	<td></td>
	<td><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="1" height="10"></td>
	<td></td>
      </tr>
        <tr>
          <td height="43" class="borderleft_main"><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="1" height="1"></td>
          <td width="149" align="top" class="bordertopbottom_main">
            <?php mosLoadModules ( 'user2' ); ?>
          </td>
          <td class="borderright_main"><img src="<?php echo $mosConfig_live_site;?>/templates/radiocampus/images/spacer.gif" width="10" height="1"></td>
        </tr>
      </table>
	  <br>
	  <?php }; ?>
	  </td>
  </tr>
</table>
<br>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" border="1">
  <tr>
    <td align="center" valign="middle">
      <?php include_once('includes/footer.php'); ?>
    </td>
  </tr>
</table>
<br /> <br />
</td></tr></table>
</body>
</html>