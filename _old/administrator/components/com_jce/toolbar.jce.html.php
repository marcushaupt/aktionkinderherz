<?php
/**
* @version $Id: toolbar.mosce.html.php,v 1.0 2005/02/27 22:15:00 Ryan Demmer$
* @package mosCE Admin
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo_4.5.1
*/
class TOOLBAR_JCE {
        /**
    	* Writes a common 'publish' button
    	* @param string An override for the task
    	* @param string An override for the alt text
    	*/
    	function accessButton( $task='applyaccess', $alt='Zugriff' ) {
    		$image2 = mosAdminMenus::ImageCheckAdmin( 'security_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 1 );
    		?>
    	 	<td>
    			<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Bitte machen Sie eine Auswahl aus der Liste auf die das Zugangslevel gelegt werden soll'); } else {submitbutton('<?php echo $task;?>', '');}">
    				<?php echo $image2; ?>
    				<br /><?php echo $alt; ?></a>
    		</td>
    	 	<?php
	   }

        function _CONFIG() {
                mosMenuBar::startTable();
                mosMenuBar::save();
                mosMenuBar::custom('main', 'back.png', 'back_f2.png', 'Hauptmen&uuml;', false);
                mosMenuBar::spacer();
                mosMenuBar::cancel();
                mosMenuBar::endTable();
        }
        function _PLUGINS() {
    		mosMenuBar::startTable();
    		mosMenuBar::publishList();
    		mosMenuBar::spacer();
    		mosMenuBar::unpublishList();
    		mosMenuBar::spacer();
    		mosMenuBar::custom('newplugin', 'new.png', 'new_f2.png', 'Neu', false);
    		mosMenuBar::spacer();
    		mosMenuBar::custom('installplugin', 'upload.png', 'upload_f2.png', 'Installieren',false);
    		mosMenuBar::spacer();
    		mosMenuBar::custom('editlayout', 'css.png', 'css_f2.png', 'Layout',false);
    		mosMenuBar::spacer();
    		TOOLBAR_JCE::accessButton();
    		mosMenuBar::spacer();
    		mosMenuBar::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Abbrechen', false);
    		mosMenuBar::endTable();
        }
        function _EDIT_PLUGINS() {
    		global $id;

    		mosMenuBar::startTable();
    		mosMenuBar::custom('saveplugin', 'save.png', 'save_f2.png', 'Speichern', false);
    		mosMenuBar::spacer();
    		if ( $id ) {
    			// for existing content items the button is renamed `close`
    			mosMenuBar::custom('canceledit', 'cancel.png', 'cancel_f2.png', 'Schliessen', false);
    		} else {
                mosMenuBar::custom('canceledit', 'cancel.png', 'cancel_f2.png', 'Abbrechen', false);
    		}
    		mosMenuBar::spacer();
    		mosMenuBar::help( 'screen.mambots.edit' );
    		mosMenuBar::endTable();
    	}
    	function _INSTALL( $element ) {
            if( $element == 'plugins' ){
                mosMenuBar::startTable();
                mosMenuBar::custom('showplugins', 'new.png', 'new_f2.png', 'Plugins', false);
                mosMenuBar::spacer();
                mosMenuBar::custom('removeplugin', 'delete.png', 'delete_f2.png', 'Deinstallieren', false);
                mosMenuBar::spacer();
                mosMenuBar::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Abbrechen', false);
    		    mosMenuBar::endTable();
            }
        }
        function _LAYOUT() {
    		mosMenuBar::startTable();
    		mosMenuBar::custom('savelayout', 'save.png', 'save_f2.png', 'Speichern', false);
    		mosMenuBar::spacer();
    		mosMenuBar::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Abbrechen', false);
    		mosMenuBar::endTable();
        }
        function _LANGS() {
    		mosMenuBar::startTable();
            mosMenuBar::publishList('publishlang');
    		mosMenuBar::spacer();
    		mosMenuBar::custom('removelang', 'delete.png', 'delete_f2.png', 'L&ouml;schen', false);
    		mosMenuBar::spacer();
    		mosMenuBar::custom('newlang', 'upload.png', 'upload_f2.png', 'Installieren',false);
    		mosMenuBar::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Abbrechen', false);
    		mosMenuBar::endTable();
        }
}
?>
