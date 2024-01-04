<?php
// Modified Rey Gigataras 10 March 2004  [Version 1.5]
// Reference:  http://forum.mamboserver.com/viewtopic.php?t=7880&highlight=

// $Id: frontend.html.php,v 1.3 2004/02/25 23:06:17 rcastley Exp $
/**
* Content code
* @package Mambo Open Source
* @Copyright (C) 2000 - 2003 Miro International Pty Ltd
* @ All rights reserved
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.3 $
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class modules_html {
   function module( &$module, &$params, $Itemid ) {
		global $mosConfig_live_site, $mosConfig_sitename, $mosConfig_lang, $mosConfig_absolute_path;
		?>
		<table cellspacing="0" cellpadding="1" class="moduletable">
		<?php if ($module->showtitle!=0) { ?>
  			<tr>
    			<th valign="top"><?php print $module->title;?></th>
    		</tr>
		<?php } ?>
    		<tr>
    			<td><?php echo $module->content;?></td>
			</tr>
      	</table>
		<br />
   <?php
   }
   
   function module2( &$module, &$params, $Itemid ) {
      global $mosConfig_live_site, $mosConfig_sitename, $mosConfig_lang, $mosConfig_absolute_path;
		global $mainframe, $database, $my, $class_suffix, $colour;
		$moduleclass = @$params->moduleclass ? $params->moduleclass : '';
     $colour = @$params->colour ? $params->colour : '';
	 
	       // check for custom language file
      if (file_exists( "modules/$module->module.$mosConfig_lang.php" )) {
         include( "modules/$module->module.$mosConfig_lang.php" );
      } else if (file_exists( "modules/$module->module.eng.php" )) {
         include( "modules/$module->module.eng.php" );
      }

       if ($colour!="") {
		?>
	<table cellpadding="0" cellspacing="0" class="table<?php echo $colour; ?>">
		<tr>
			<td class="<?php echo $colour; ?>topleft" >
			</td>
			<td class="<?php echo $colour; ?>top">
			</td>
			<td class="<?php echo $colour; ?>topright">
			</td>
		</tr>
		<tr>
			<td class="<?php echo $colour; ?>left">
			</td>
			<td class="<?php echo $colour; ?>center">
			<?php
			}
			?>
			
    <table class="moduletable<?php echo $moduleclass; ?>" width="100%" cellpadding="0" cellspacing="0">
      <?php if ($module->showtitle!=0) { ?>
      <tr>
         <th valign="top" <?php if ($colour!="") { ?>class="<?php echo $colour; ?>" <?php } ?>><?php print $module->title;?></th>
      </tr>
      <?php
      }
      ?>
      <tr>
         <td>
      <?php
      include( "modules/$module->module.php" );
      if (isset( $content)) {
         echo $content;
      }
         ?>
         </td>
      </tr>
    </table>
	
		<?php if ($colour!="") {
		?>
		</td>
		<td class="<?php echo $colour; ?>right">
		</td>
	</tr>
			<tr>
			<td class="<?php echo $colour; ?>botleft">
			</td>
			<td class="<?php echo $colour; ?>bot">
			</td>
			<td class="<?php echo $colour; ?>botright">
			</td>
		</tr>

	</table>
			<?php
			}
			?>
	<br />
   <?php
   }
}
?>