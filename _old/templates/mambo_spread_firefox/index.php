<!-- Mambo Spread Firefox
A Mambo recreation of the Spread Firefox site.
Created by Damian Caynes
(C) 2004 Inspired Digital.
Released as GPL, everything I didn't create is of course (c) and tm Firefox.
(that's the logo images and background)
Feel free to use as you wish, please consider donating or linking back to Firefox if you do.
Remember, get firefox and TAKE BACK THE WEB!!! -->

<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $mosConfig_sitename; ?></title>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php
if ($my->id) {
	include ("editor/editor.php");
	initEditor();
}
?>
<?php include ("includes/metadata.php"); ?>
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
<link href="<?php echo $mosConfig_live_site;?>/templates/mambo_spread_firefox/css/template_css.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<LINK REL="alternate" TITLE="<?php echo $mosConfig_sitename; ?>" HREF="<?php echo $mosConfig_live_site;?>/index2.php?option=com_rss&no_html=1" TYPE="application/rss+xml" />
</head>
<body>
	<div align="center">
	<table width="95%" cellpadding="0" cellspacing="0" class="ffheader">
		<tr>
			<td>
<!-- This is the left end of the header, containing the corners and logo as well as an affiliate link to get me some cred on Spread Firefox ;) -->			
			<a href="http://www.spreadfirefox.com/?q=affiliates&amp;id=15531&amp;t=62"><img src="<?php echo $mosConfig_live_site;?>/templates/mambo_spread_firefox/images/fflogo.png" width="333" height="69" border="0"/></a>
			</td>
			<td class="fflogomid" width="100%" valign="top">	
			<form action='<?php echo sefRelToAbs("index.php"); ?>' method='post'>
			search: <input class="searchbox" type="text" name="searchword" height="16" size="15" value="" />
			<input class="form-submit" type="submit" value="Go" />
			</form>
			</td>
			<td>
			<img src="<?php echo $mosConfig_live_site;?>/templates/mambo_spread_firefox/images/fflogoend.png" width="8" height="69" />
			</td>
		</tr>
		</table>
		
		<table width="100%" cellpadding="0" cellspacing="0" class="ffmain">
			<tr>
				<td class="ffleft" valign="top">
				 <?php mosLoadModules('left'); ?>
				</td>
				
				<td valign="top" class="ffcontent">
<!-- This checks whether you're viewing the frontpage, if so display the top modules (newsflash), otherwise display the pathway -->			
				<?php if (mosCountModules( 'top' )) { 
					 mosLoadModules('top'); } 
					 else {?>
				<div class="path">You are here: <?php include ("templates/mambo_spread_firefox/pathway.php") ;?></div>
				<?php } ?>
				
				<br />
				<?php include_once("mainbody.php"); ?>
				</td>
				
				<td class="ffright" valign="top">
<!-- This is a hardcoded green module, containing the realtime firefox download stats, which can be easily removed -->				
					<table cellpadding="0" cellspacing="0" class="tablegreen">
						<tr>
							<td class="greentopleft" height="8" width="8">
							</td>
							<td class="greentop" height="8">
							</td>
							<td class="greentopright" height="8" width="8">
							</td>
						</tr>
						<tr>
							<td class="greenleft" height="8" width="8">
							</td>
							<td class="greencenter" valign="top">
							<img src="<?php echo $mosConfig_live_site;?>/templates/mambo_spread_firefox/images/download.gif" width="175" height="15" />
							<img src="http://spreadfirefox.com/community/progress_meter/campaigns/one/cache.png" />
							<br />
							<a href="http://www.getfirefox.com/" title="Get Firefox" target="_blank">Get Firefox</a> and <a href="http://spreadfirefox.com/community/?q=node/view/88" title="Spread the Word!" target="_blank">Spread the Word</a>!
							</td>
							<td class="greenright" height="8" width="8">
							</td>
						</tr>
						<tr>
							<td class="greenbotleft" height="8" width="8">
							</td>
							<td class="greenbot" height="8" >
							</td>
							<td class="greenbotright" height="8" width="8">
							</td>
						</tr>
				</table>
				<br />				
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td>
							<?php mosLoadModules('right'); ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td colspan="3">
<!-- Custom footer include, just so it isn't aligned to the right (?) -->
			<?php include_once("footer.php"); ?>
			</td>
		</tr>
	</table>
	</div>
</body>
</html>
