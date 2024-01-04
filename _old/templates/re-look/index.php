<?php echo "<?xml version=\"1.0\"?>"; defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<?php //templates/ echo $cur_template; ?>
<link href="templates/<?php echo $cur_template; ?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="templates/<?php echo $cur_template; ?>/images/favicon.ico" />
</head>
<body>
<?php mosLoadComponent( "banners" ); ?>
<div id="top_search">
  <form action='<?php echo sefRelToAbs("index.php"); ?>' method='post'>
    <input class="submit" type="text" name="searchword" height="16" size="15" value="<?php echo _SEARCH_BOX; ?>"  onblur="if(this.value=='') this.value='<?php echo _SEARCH_BOX; ?>';" onfocus="if(this.value=='<?php echo _SEARCH_BOX; ?>') this.value='';" />
    <input type="hidden" name="option" value="search" />
  </form>
</div>
<div id="wrapper">
  <div id="header"></div>
  <div id="top_nav">
    <ul>
      <li><a href="<?php echo sefRelToAbs("$link_1"); ?>" title="<?php echo $text_1; ?>" class="mainlevel">  <?php echo $text_1; ?></a></li>
      <li><a href="<?php echo sefRelToAbs("$link_2"); ?>" title="<?php echo $text_2; ?>" class="mainlevel"><?php echo $text_2; ?></a></li>
      <li><a href="<?php echo sefRelToAbs("$link_3"); ?>" title="<?php echo $text_3; ?>" class="mainlevel"><?php echo $text_3; ?></a></li>
      <li><a href="<?php echo sefRelToAbs("$link_4"); ?>" title="<?php echo $text_4; ?>" class="mainlevel"><?php echo $text_4; ?></a> </li>
      <li><a href="<?php echo sefRelToAbs("$link_5"); ?>" title="<?php echo $text_5; ?>" class="mainlevel"><?php echo $text_5; ?></a> </li>
      <li><a href="<?php echo sefRelToAbs("$link_6"); ?>" title="<?php echo $text_6; ?>" class="mainlevel"><?php echo $text_6; ?></a> </li>
      <li><a href="<?php echo sefRelToAbs("$link_7"); ?>" title="<?php echo $text_7; ?>" class="mainlevel"><?php echo $text_7; ?></a> </li>
    </ul>
  </div>
  
  <div id="container">
    <div id="side_panel">
      <div id="general_nav"> 
        <h3>Title</h3>
        <?php if ( mosCountModules('left') ) { ?>
<div id="left">
<?php mosLoadModules('left') ?>
</div>
<?php } ?> 
        <h3>User1 Title </h3>
        <p> 
          <?php if ( mosCountModules('user1') ) { ?>
<div id="user1">
<?php mosLoadModules('user1') ?>
</div>
<?php } ?> 
        
        </p>
        </div>
      <div id="user1">
<h3>User2</h3>
        <?php if ( mosCountModules('user2') ) { ?>
<div id="user1">
<?php mosLoadModules('user2') ?>
</div>
<?php } ?> 
        
      </div>
    </div>
    <div id="content">
      <div class="entry">
        <p class="posted">
          <?php include "pathway.php"; ?>
        </p>
        <?php include ("mainbody.php"); ?>
      </div>
      <div class="entry">
        <center>
          <?php mosLoadModules ( 'bottom' ); ?>
        </center>
      </div>
    </div>
    <div id="copyright">
      <?php include ("includes/footer.php"); ?>
    </div>
  </div>
</div>
</body>
</html>