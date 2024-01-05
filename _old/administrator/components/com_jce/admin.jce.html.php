<?php
/**
* @version $Id: admin.mosce.html.php,v 1.0 2005/02/27 22:15:00 Ryan Demmer$
* @package mosCE Admin
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo_4.5.1
*/
class HTML_JCEAdmin {
    function showAdmin()
    {
        global $mosConfig_live_site;
        ?>
        <form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="cpanel">
			JCE Konfiguration
			</th>
        </tr>
        <tr>
        <td width="55%" valign="top">
	    <div id="cpanel">
            <div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=config&hidemainmenu=1">
        				<div class="iconimage">
        					<img src="<?php echo $mosConfig_live_site;?>/administrator/images/config.png" alt="Editor Konfiguration" align="middle" name="image" border="0" />				</div>
        				Editor Konfiguration</a>
        		</div>
    		</div>
    		<div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=showplugins">
        				<div class="iconimage">
        					<img src="<?php echo $mosConfig_live_site;?>/administrator/images/module.png" alt="Zeige Plugins" align="middle" name="image" border="0" />				</div>
        				Zeige Plugins</a>
        		</div>
    		</div>
    		<div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=install&element=plugins">
        				<div class="iconimage">
        					<img src="<?php echo $mosConfig_live_site;?>/administrator/images/install.png" alt="Installiere Plugins" align="middle" name="image" border="0" />				</div>
        				Installiere Plugins</a>
        		</div>
    		</div>
    		<div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=editlayout&hidemainmenu=1">
        				<div class="iconimage">
        					<img src="<?php echo $mosConfig_live_site;?>/administrator/images/templatemanager.png" alt="&Auml;ndere Layout" align="middle" name="image" border="0" />				</div>
        				&Auml;ndere Layout</a>
        		</div>
    		</div>
    		<div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=lang&hidemainmenu=1">
        				<div class="iconimage">
        					<img src="<?php echo $mosConfig_live_site;?>/administrator/images/langmanager.png" alt="Sprach Verwalter" align="middle" name="image" border="0" />				</div>
        				Sprach Verwalter</a>
        		</div>
    		</div>
		</div>
		</td>
        </tr>
        </table>
        <?php
    }




        function showconfig( &$row, &$lists, $option) {
                global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_lang;
                $tabs = new mosTabs(0);

                if (!file_exists("$mosConfig_absolute_path/administrator/components/com_jce/info/admin_info_$mosConfig_lang.txt"))
                {
                  $admin_info_lang = "english";
                }else{
                  $admin_info_lang = "$mosConfig_lang";
                }
                
                if (!file_exists("$mosConfig_absolute_path/mambots/editors/jce/jscripts/tiny_mce/info/editor_info_$mosConfig_lang.php"))
                {
                  $editor_info_lang = "english";
                }else{
                  $editor_info_lang = "$mosConfig_lang";
                }

                ?>
                <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
                <table class="adminheading">
                <tr>
                        <th class="config">
                        JCE 1.0.0 Configuration :
                        <span class="componentheading">
                        jce_config.php is :
                         <?php echo is_writable( '../mambots/editors/jce/jscripts/tiny_mce/jce_config.php' ) ? '<b><font color="green"> Writeable</font></b>' : '<b><font color="red">Unwriteable</font></b>'?>
                        </span>
                        </th>
                </tr>
                </table>
                <script language="javascript" type="text/javascript">
                function submitbutton(pressbutton) {
                        var form = document.adminForm;
                        if (pressbutton == 'save') {
                                //if (confirm ("Are you sure?")) {
                                submitform( pressbutton );
                                //}
                        } else {
                                document.location.href = 'index2.php';
                        }
                }
                </script>
                <form action="index2.php" method="post" name="adminForm">
                <?php
                $tabs->startPane("mosCE");
                $tabs->startTab(_EDITOR_OPTIONS,"editor_options");
                ?>
                <table class="adminform">
                <tr>
                    <td colspan="2">The URL specified in $mosConfig_live_site in configuration.php is <strong><?php echo $mosConfig_live_site ?></strong><br />
                    You <strong>MUST</strong> access this site from this <strong>exact URL</strong> when editing content.
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_LANG ?>:
                        </td>
                        <td><?php echo $lists['editor_lang']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_LANG_LIST ?>:
                        </td>
                        <td><input type="text" class="text_area" size="50" name="editor_lang_list" value="<?php echo $row->editor_lang_list; ?>"></td>
                </tr>

                <tr>
                        <td width="185">
                        <?php echo _EDITOR_CSS_OVERRIDE ?>:
                        </td>
                        <td><?php echo $lists['editor_css_override'];
                        $tip = _EDITOR_CSS_OVERRIDE_TIP;
                                echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_CUSTOM_CSS ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="30" name="editor_custom_css" value="<?php echo $row->editor_custom_css; ?>">
                        <?php $tip = _EDITOR_CUSTOM_CSS_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_NEWLINES ?>:
                        </td>
                        <td><?php echo $lists['editor_newlines'];
                        $tip = _EDITOR_NEWLINES_TIP;
                                echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_CONVERT_URLS ?>:
                        </td>
                        <td><?php echo $lists['editor_convert_urls'];
                        $tip = _EDITOR_CONVERT_URLS_TIP;
                                echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_SCRIPT ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_script_acl'];?>
                        &nbsp;
                        &nbsp;
                        <?php echo _EDITOR_SCRIPT_ELMS ?>
                        <input type="text" class="text_area" size="40" name="editor_script_elms" value="<?php echo $row->editor_script_elms; ?>">
                        <?php $tip = _EDITOR_SCRIPT_ELMS_TIP;
                               echo mosToolTip( $tip );?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IFRAME ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_iframe_acl'];?>
                        &nbsp;
                        <?php echo _EDITOR_IFRAME_ELEMENTS ?>
                        <input type="text" class="text_area" size="40" name="editor_iframe_elms" value="<?php echo $row->editor_iframe_elms; ?>">
                        <?php $tip = _EDITOR_IFRAME_ELEMENTS_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_XTD_ELMS ?>:
                        </td>
                        <td><input type="text" class="text_area" size="80" name="editor_xtd_elms" value="<?php echo $row->editor_xtd_elms; ?>">
                        <?php $tip = _EDITOR_XTD_ELMS_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_ONCLICK_ELMS ?>:
                        </td>
                        <td><input type="text" class="text_area" size="80" name="editor_onclick_elms" value="<?php echo $row->editor_onclick_elms; ?>">
                        <?php $tip = _EDITOR_ONCLICK_ELMS_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_TMPL_DIR ?>:
                        </td>
                        <td><?php echo $mosConfig_absolute_path;?><input type="text" class="text_area" size="30" name="editor_tmpl_dir" value="<?php echo $row->editor_tmpl_dir; ?>">
                        <?php $tip = _EDITOR_TMPL_DIR_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_DIRECTION ?>:
                        </td>
                        <td><?php echo $lists['editor_direction']; ?></td>
                </tr>
                <tr>
                <td valign="top">
                        <?php echo _EDITOR_PREVIEW_BGCOLOR ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="10" name="editor_preview_bgcolor" value="<?php echo $row->editor_preview_bgcolor; ?>">&nbsp;
                        <?php $tip = _EDITOR_PREVIEW_BGCOLOR_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                </table>
                <?php
                $tabs->endTab();
                $tabs->startTab(_EDITOR_LAYOUT,"editor_layout");
                ?>
                <table class="adminform" border="1">
                <tr>
                    <td>Preview :</td>
                    <td>
                        <div style="width:<?php echo $row->editor_width; ?>px; border: 1px solid #cccccc; background:#F0F0EE;">
                            <div style="padding:3px; border-bottom:1px solid #cccccc" />
                            <?php $row_buttons1 = explode(',', $row->editor_layout_row1);
                            foreach ($row_buttons1 as $btnImg1){
                              echo'<img src="components/com_mosce/images/'.$btnImg1.'.gif" alt="'.$btnImg1.'" title="'.$btnImg1.'" />';
                            }?></div>
                            <div style="padding:3px; border-bottom:1px solid #cccccc" />
                            <?php $row_buttons2 = explode(',', $row->editor_layout_row2);
                            foreach ($row_buttons2 as $btnImg2){
                              echo'<img src="components/com_mosce/images/'.$btnImg2.'.gif" alt="'.$btnImg2.'" title="'.$btnImg2.'" />';
                            }?></div>
                            <div style="padding:3px; border-bottom:1px solid #cccccc" />
                            <?php $row_buttons3 = explode(',', $row->editor_layout_row3);
                            foreach ($row_buttons3 as $btnImg3){
                              echo'<img src="components/com_mosce/images/'.$btnImg3.'.gif" alt="'.$btnImg3.'" title="'.$btnImg3.'" />';
                            }?></div>
                            <div style="padding:3px; "/>
                            <?php $row_buttons4 = explode(',', $row->editor_layout_row4);
                            foreach ($row_buttons4 as $btnImg4){
                              echo'<img src="components/com_mosce/images/'.$btnImg4.'.gif" alt="'.$btnImg4.'" title="'.$btnImg4.'" />';
                            }?></div>
                        </div>
                    </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_WIDTH ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="5" name="editor_width" value="<?php echo $row->editor_width; ?>">&nbsp;px
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_HEIGHT ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="5" name="editor_height" value="<?php echo $row->editor_height; ?>">&nbsp;px
                        </td>
                </tr>
                <tr>
                        <td valign="top" colspan="2">
                        <?php echo _EDITOR_LAYOUT_TIP ?>
                        </td>
                </tr>
                <tr>
                        <td width="100">
                        <?php echo _EDITOR_LAYOUT_ROW1 ?>:
                        </td>
                        <td><textarea class="text_area" cols="70" rows="5" name="editor_layout_row1"><?php echo $row->editor_layout_row1; ?></textarea></td>
                </tr>
                <tr>
                        <td width="100">
                        <?php echo _EDITOR_LAYOUT_ROW2 ?>:
                        </td>
                        <td><textarea class="text_area" cols="70" rows="5" name="editor_layout_row2"><?php echo $row->editor_layout_row2; ?></textarea></td>
                </tr>
                <tr>
                        <td width="100">
                        <?php echo _EDITOR_LAYOUT_ROW3 ?>:
                        </td>
                        <td><textarea class="text_area" cols="70" rows="5" name="editor_layout_row3"><?php echo $row->editor_layout_row3; ?></textarea></td>
                </tr>
                <tr>
                        <td width="100">
                        <?php echo _EDITOR_LAYOUT_ROW4 ?>:
                        </td>
                        <td><textarea class="text_area" cols="70" rows="5" name="editor_layout_row4"><?php echo $row->editor_layout_row4; ?></textarea></td>
                </tr>
                </table>
                <?php
                $tabs->endTab();
                $tabs->startTab(_EDITOR_PLUGINS,"editor_plugins");
                ?>
                <table class="adminform">
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_FONT_TOOLS ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_font_tools_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IMGMANAGER ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_plugin_imgmanager_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_FILEMANAGER ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_plugin_filemanager_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_ADVLINK ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_plugin_advlink_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_EMOTIONS ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_plugin_emotions_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_FLASH ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_plugin_flash_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_TABLE ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_plugin_table_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_PRINT ?>:
                        </td>
                        <td><?php echo $lists['editor_plugin_print']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_SEARCH_REPLACE ?>:
                        </td>
                        <td><?php echo $lists['editor_plugin_searchreplace']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_EXTRA_PLUGINS ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="30" name="editor_extra_plugins" value="<?php echo $row->editor_extra_plugins; ?>">
                        <?php $tip = _EDITOR_EXTRA_PLUGINS_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                </table>
                <?php
                $tabs->endTab();
                $tabs->startTab(_EDITOR_IMGMANAGER_OPTIONS,"editor_im");
                ?>
                <table class="adminform">
                <tr>
                    <td valign="top"><strong>
                    <?php $safe_mode = new mosCE_Config();
                    if ($safe_mode->get_safe_mode() == 'ON'){?>
                        <?php echo _EDITOR_SAFE_MODE_ON;
                    }else{
                        echo _EDITOR_SAFE_MODE_OFF;
                    }?>
                    </strong></td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_BASE_DIR ?>:
                        </td>
                        <td>
                        <?php echo $mosConfig_absolute_path; ?>
                        <input type="text" class="text_area" size="30" name="editor_im_base_dir" value="<?php echo $row->editor_im_base_dir; ?>">
                        <?php $tip = _EDITOR_IM_BASE_DIR_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_BASE_URL ?>:
                        </td>
                        <td>
                        <?php echo $mosConfig_live_site; ?>
                        <input type="text" class="text_area" size="30" name="editor_im_base_url" value="<?php echo $row->editor_im_base_url; ?>">
                        <?php $tip = _EDITOR_IM_BASE_URL_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_IMAGE_CLASS ?>:
                        </td>
                        <td><?php
                            $safe_mode = new mosCE_Config();
                            if (!get_extension_funcs('gd') && $safe_mode->get_safe_mode() == 'ON'){?>
                                <strong><font color="red"><?php echo _EDITOR_IM_NO_GDLIB ?></font></strong>
                                <?php $tip = _EDITOR_IM_IMAGE_CLASS_TIP;
                                echo mosToolTip( $tip );
                            }else{
                                echo $lists['editor_im_image_class'];
                                $tip = _EDITOR_IM_IMAGE_CLASS_TIP;
                                echo mosToolTip( $tip );
                            }?></td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_CLASS_PATH ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="30" name="editor_im_class_path" value="<?php echo $row->editor_im_class_path; ?>">
                        <?php $tip = _EDITOR_IM_CLASS_PATH_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_MODE ?>:
                        </td>
                        <td><?php echo $lists['editor_im_mode'];?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_THUMBS ?>:
                        </td>
                        <td><?php echo $lists['editor_im_thumbs'];?></td>
                </tr>

                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_THUMB_SIZE ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="5" name="editor_im_thumb_size" value="<?php echo $row->editor_im_thumb_size; ?>">&nbsp;px
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_THUMB_PREFIX ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="30" name="editor_im_thumb_prefix" value="<?php echo $row->editor_im_thumb_prefix; ?>">
                        <?php $tip = _EDITOR_IM_THUMB_PREFIX_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_THUMB_DIR?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="30" name="editor_im_thumb_dir" value="<?php echo $row->editor_im_thumb_dir; ?>">
                        <?php $tip = _EDITOR_IM_THUMB_DIR_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_MAX_VALUE ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="5" name="editor_im_max_value" value="<?php echo $row->editor_im_max_value; ?>">&nbsp;px
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_DEF_VSPACE ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="5" name="editor_im_def_vspace" value="<?php echo $row->editor_im_def_vspace; ?>">
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_DEF_HSPACE ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="5" name="editor_im_def_hspace" value="<?php echo $row->editor_im_def_hspace; ?>">
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_DEF_BORDER ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="5" name="editor_im_def_border" value="<?php echo $row->editor_im_def_border; ?>">
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_IM_DEF_ALIGN ?>:
                        </td>
                        <td><?php echo $lists['editor_im_def_align'];?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_UPLOAD ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_im_upload_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_FOLDER ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_im_folder_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_IMAGE ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_im_image_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_IMAGE_EDIT ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_im_image_edit_acl']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_USERDIR ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_im_userdir_acl']; ?>&nbsp;
                        <?php $tip = _EDITOR_USERDIR_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_USERDIR_TYPE ?>:
                        </td>
                        <td><?php echo $lists['editor_im_dirtype']; ?>&nbsp;
                        <?php $tip = _EDITOR_USERDIR_TYPE_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_POPUP_MODE ?>:
                        </td>
                        <td><?php echo $lists['editor_im_popup_mode']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <strong><?php echo _EDITOR_IM_POPUP_OPTIONS ?></strong>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_POPUP_TITLE ?>:
                        </td>
                        <td><?php echo $lists['editor_im_popup_title']; ?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_IM_POPUP_PRINT ?>:
                        </td>
                        <td><?php echo $lists['editor_im_popup_print']; ?>
                        </td>
                </tr>
                <tr>
                <td valign="top">
                        <?php echo _EDITOR_IM_POPUP_BGCOLOR ?>:
                        </td>
                        <td>#
                        <input type="text" class="text_area" size="10" name="editor_im_popup_bgcolor" value="<?php echo $row->editor_im_popup_bgcolor; ?>">&nbsp;
                        <?php $tip = _EDITOR_IM_POPUP_BGCOLOR_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                </table>
                <?php
                $tabs->endTab();
                $tabs->startTab(_EDITOR_FILEMANAGER_OPTIONS,"editor_fm");
                ?>
                <table class="adminform">
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_FM_DOC_ROOT ?>:
                        </td>
                        <td>
                        <?php echo $mosConfig_absolute_path; ?>
                        <input type="text" class="text_area" size="30" name="editor_fm_doc_root" value="<?php echo $row->editor_fm_doc_root; ?>">
                        <?php $tip = _EDITOR_FM_DOC_ROOT_TIP;
                              echo mosToolTip( $tip );?>&nbsp;
                        <?php echo _EDITOR_FM_MKDIR ?>
                        <?php echo $lists['editor_fm_mkdir']; ?></td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_FM_BASE_URL ?>:
                        </td>
                        <td>
                        <?php echo $mosConfig_live_site; ?>
                        <input type="text" class="text_area" size="30" name="editor_fm_base_url" value="<?php echo $row->editor_fm_base_url; ?>">
                        <?php $tip = _EDITOR_FM_BASE_URL_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_FM_MAX_SIZE ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="3" name="editor_fm_max_size" value="<?php echo $row->editor_fm_max_size; ?>">&nbsp;MB
                        <?php $tip = _EDITOR_FM_MAX_SIZE_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_FM_UPLOAD ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_fm_upload_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_FM_FOLDER ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_fm_folder_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_FM_MOVE ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_fm_move_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_FM_RENAME ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_fm_rename_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_FM_DELETE ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_fm_delete_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_USERDIR ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_fm_userdir_acl']; ?>&nbsp;
                        <?php $tip = _EDITOR_USERDIR_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_USERDIR_TYPE ?>:
                        </td>
                        <td><?php echo $lists['editor_fm_dirtype']; ?>&nbsp;
                        <?php $tip = _EDITOR_USERDIR_TYPE_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_FM_ALLOW_EXT ?>:
                        </td>
                        <td><input type="text" class="text_area" size="50" name="editor_fm_allow_ext" value="<?php echo $row->editor_fm_allow_ext; ?>">
                        <?php
				        $tip = _EDITOR_FM_ALLOW_EXT_TIP;
				        echo mosToolTip( $tip );
			            ?></td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_FM_DENY_EXT ?>:
                        </td>
                        <td><input type="text" class="text_area" size="50" name="editor_fm_deny_ext" value="<?php echo $row->editor_fm_deny_ext; ?>">
                        <?php
				        $tip = _EDITOR_FM_DENY_EXT_TIP;
				        echo mosToolTip( $tip );
			            ?></td>
                </tr>
                </table>
                <?php
                $tabs->endTab();
                $tabs->startTab(_EDITOR_FLASHMANAGER_OPTIONS,"editor_swf");
                ?>
                <table class="adminform">
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_SWF_DOC_ROOT ?>:
                        </td>
                        <td>
                        <?php echo $mosConfig_absolute_path; ?>
                        <input type="text" class="text_area" size="30" name="editor_swf_doc_root" value="<?php echo $row->editor_swf_doc_root; ?>">
                        <?php $tip = _EDITOR_SWF_DOC_ROOT_TIP;
                              echo mosToolTip( $tip );?>&nbsp;
                        <?php echo _EDITOR_SWF_MKDIR ?>
                        <?php echo $lists['editor_swf_mkdir']; ?></td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_SWF_BASE_URL ?>:
                        </td>
                        <td>
                        <?php echo $mosConfig_live_site; ?>
                        <input type="text" class="text_area" size="30" name="editor_swf_base_url" value="<?php echo $row->editor_swf_base_url; ?>">
                        <?php $tip = _EDITOR_SWF_BASE_URL_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td valign="top">
                        <?php echo _EDITOR_SWF_MAX_SIZE ?>:
                        </td>
                        <td>
                        <input type="text" class="text_area" size="3" name="editor_swf_max_size" value="<?php echo $row->editor_swf_max_size; ?>">&nbsp;MB
                        <?php $tip = _EDITOR_SWF_MAX_SIZE_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_SWF_UPLOAD ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_swf_upload_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_SWF_FOLDER ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_swf_folder_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_SWF_MOVE ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_swf_move_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_SWF_RENAME ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_swf_rename_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_SWF_DELETE ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_swf_delete_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_USERDIR ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_swf_userdir_acl']; ?>&nbsp;
                        <?php $tip = _EDITOR_USERDIR_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_USERDIR_TYPE ?>:
                        </td>
                        <td><?php echo $lists['editor_swf_dirtype']; ?>&nbsp;
                        <?php $tip = _EDITOR_USERDIR_TYPE_TIP;
                              echo mosToolTip( $tip );?>
                        </td>
                </tr>
                </table>
                <?php
                $tabs->endTab();
                $tabs->startTab(_EDITOR_ADVLINK_OPTIONS,"editor_link");
                ?>
                <table class="adminform">
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_AL_ARTICLE ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_al_article_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_AL_SECTION ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_al_section_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_AL_CATEGORY ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_al_category_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_AL_STATIC ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_al_static_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_AL_CONTACT ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_al_contact_acl']; ?></td>
                </tr>
                <tr>
                        <td width="185">
                        <?php echo _EDITOR_AL_SEARCH ?>:
                        </td>
                        <td>
                        <?php echo _CMN_ACCESS;
                        echo $lists['editor_al_search_acl']; ?></td>
                </tr>
                </table>
                <?php
                $tabs->endTab();
                $tabs->startTab(_EDITOR_ADMIN_INFO,"editor_info1");
                ?>
                <table class="adminform">
                <tr>
                    <td>
                    <?php readfile( "$mosConfig_absolute_path/administrator/components/com_mosce/info/admin_info_$admin_info_lang.txt" ); ?>
                    </td>
                </tr>
                </table>
                <?php
                $tabs->endTab();
                $tabs->startTab(_EDITOR_EDITOR_INFO,"editor_info2");
                ?>
                <table class="adminform">
                <tr>
                    <td>
                    <?php readfile( "$mosConfig_absolute_path/mambots/editors/mosce/jscripts/tiny_mce/info/editor_info_$editor_info_lang.txt" ); ?>
                    </td>
                </tr>
                </table>
                <?php
                $tabs->endTab();
                $tabs->endPane();
                ?>

                <input type="hidden" name="option" value="<?php echo $option; ?>">
                <input type="hidden" name="task" value="">
                </form>
                <script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
                <?php
        }

}
?>