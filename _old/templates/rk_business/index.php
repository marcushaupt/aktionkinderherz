<?php defined( "_VALID_MOS" ) or die( "Direct Access to this location is not allowed." );$iso = split( '=', _ISO );echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php mosShowHead(); ?>
<meta http-equiv="Content-Type" content="text/html;><?php echo _ISO; ?>" />
<?php if ( $my->id ) { initEditor(); } ?>
<?php echo "<link rel=\"stylesheet\" href=\"$GLOBALS[mosConfig_live_site]/templates/$GLOBALS[cur_template]/css/template_css.css\" type=\"text/css\"/>" ; ?><?php echo "<head><link rel=\"shortcut icon\" href=\"$GLOBALS[mosConfig_live_site]http://www.aktionkinderherz.de/templates/rk_busines/images/favicon.ico\" />" ; ?></head>
<link rel="alternate" title="<?php echo $mosConfig_sitename; ?>" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/index2.php?option=com_rss&no_html=1" type="application/rss+xml" />
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
</head>
<body>
 <a name="up" id="up"></a>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
   <td colspan="2"><table align="left" border="0" cellpadding="0" cellspacing="0" width="780">
	  <tr>
	   <td><img name="rkbusiness_r1_c1" src="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_r1_c1.jpg" width="242" height="105" border="0" alt=""></td>
	   <td><img name="rkbusiness_r1_c5" src="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_r1_c5.jpg" width="20" height="105" border="0" alt=""></td>
	   <td width="498px" height="105px" background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_r1_c6.jpg"><?php mosLoadModules ( 'top' ); ?></td>
	   <td><img name="rkbusiness_r1_c7" src="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_r1_c7.jpg" width="20" height="105" border="0" alt=""></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
   <td background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_r2_c1.gif" width="100" height="27px" ><div id="search">
                    <?php mosLoadModules ( 'user4', -1 ); ?>
    </div></td>
   <td background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_r2_c1.gif"class="mainlevel-nav" width="680" ><?php mosLoadModules ( 'user3' ); ?></td>
  </tr>
  <tr>
   <td colspan="2"><img name="rkbusiness_r3_c1" src="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_r3_c1.jpg" width="780" height="129" border="0" alt=""></td>
  </tr>
  <tr>
   <td colspan="2">
   <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="11" height="25" background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_shadowl.jpg"><div>
            </div></td>
            <td height="25" bgcolor="#F1F1F1" style="border-bottom: 1px solid #999999; border-top: 5px solid #FFFFFF;"><?php mosPathWay(); ?></td>
            <td height="25" align="right" bgcolor="#F1F1F1" style="border-bottom: 1px solid #999999; border-top: 5px solid #FFFFFF;"><div class="date"><?php echo mosCurrentDate(); ?></div></td>
            <td width="11" height="25" align="right" background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_shadowr.jpg">&nbsp;</td>
          </tr>
      </table>
        <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top" style="padding-left:8px; background-repeat: repeat-y;" background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_shadowl.jpg">&nbsp;</td>
            <td valign="top" style="background-repeat: repeat-y;"background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_lb.gif"><?php if (mosCountModules('left')) { ?>
              <div class="leftrow">
                <?php mosLoadModules ( 'left' ); ?>
              </div>
              <?php } ?></td>
            <td valign="top" bgcolor="#FAFAFA" width="100%"><div class"main">
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr valign="top" bgcolor="#F1F1F1">
                  <?php if (mosCountModules('top')) { ?><td colspan="3" style="border-top: 3px solid #FFFFFF;">
                      <div>
                        <?php mosLoadModules ( 'user1' ); ?>
                      </div>
                      </td><?php } ?>
                </tr>
               <td valign="top" bgcolor="#F1F1F1" style="border-top: 3px solid #FFFFFF;"><div>
                 <?php mosLoadModules ( 'user2' ); ?>
</div></td>
                </tr>
                <tr align="left" valign="top">
                  <td colspan="3" style=" border-top: 4px solid #FFFFFF; padding: 5px;"><div class="main">
                      <?php mosMainBody(); ?>
                      </div></td>
                </tr>
                <tr bgcolor="#F1F1F1">
                  <td colspan="3" valign="top" style="border-top: 3px solid #FFFFFF;"><?php if (mosCountModules('bottom')) { ?>
                    <div>
                      <?php mosLoadModules ( 'bottom' ); ?>
                  </div>
                    <?php } ?></td>
                </tr>
              </table>
            </td>
            <td valign="top" style="background-repeat: repeat-y; "background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_rb.gif"><?php if (mosCountModules('right')) { ?>
                <div class="rightrow">
                  <?php mosLoadModules ( 'right' ); ?>
                </div>                
              <?php } ?></td>
            <td valign="top" style="padding-right: 8px; background-repeat: repeat-y;" background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_shadowr.jpg">&nbsp;</td>
          </tr>
        </table>
        <table width="100%" height="54px" border="0" cellpadding="0" cellspacing="0" background="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_center2.jpg">
  <tr>
    <td><div align="left"><a href="<?php echo sefRelToAbs($_SERVER['REQUEST_URI'])."#up"; ?>"><img src="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_ltop.jpg" width="30" height="20" border="0" alt="Top!"/></a></div></td>
    <td><div class="footer" align="center"><a href="" target="_blank"/a><br />
      Optimized for IE 6 &amp; Firefox 1.0 </div></td>
    <td><div align="right"><a href="<?php echo sefRelToAbs($_SERVER['REQUEST_URI'])."#up"; ?>"><img src="<?php echo $mosConfig_live_site;?>/templates/rk_business/images/rkbusiness_rtop.jpg" width="30" height="20" border="0" alt="Top!"/></a></div></td>
  </tr>
</table>
</td>
    </tr>
</table>
</body>
</html>