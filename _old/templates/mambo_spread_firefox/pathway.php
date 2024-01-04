<?php
// $Id: pathway.php,v 1.30 2004/03/16 00:35:52 eddieajau Exp $
/**
* Pathway code
* @package Mambo Open Source
* @Copyright (C) 2000 - 2003 Miro International Pty Ltd
* @ All rights reserved
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.30 $
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function pathwayMakeLink( $id, $name, $link, $parent ) {
	$mitem = new stdClass();
	$mitem->id = $id;
	$mitem->name = $name;
	$mitem->link = $link;
	$mitem->parent = $parent;
	$mitem->type = '';
	return $mitem;
}

/**
* Outputs the pathway breadcrumbs
* @param database A database connector object
* @param int The db id field value of the current menu item
*/
function showPathway( $Itemid ) {
	global $database, $option, $task;
	global $SERVER_SOFTWARE, $QUERY_STRING, $REQUEST_URI;

	// get the home page
	$database->setQuery( "SELECT id, link"
	. "\nFROM #__menu"
	. "\nWHERE menutype='mainmenu' AND published='1'"
	. "\nORDER BY parent, ordering LIMIT 1"
	);
	$home_menu = new mosMenu( $database );
	$database->loadObject( $home_menu );
	echo $database->getErrorMsg();

	// the the whole menu array and index the array by the id
	$database->setQuery( "SELECT id, name, link, parent, type"
	. "\nFROM #__menu"
	. "\nWHERE published='1'"
	. "\nORDER BY parent, ordering"
	);
	$mitems = $database->loadObjectList( 'id' );
	echo $database->getErrorMsg();

	$isWin = (substr(PHP_OS, 0, 3) == 'WIN' && stristr ( $SERVER_SOFTWARE, "microsoft"));
	$optionstring = $isWin ? $QUERY_STRING : $REQUEST_URI;

	// are we at the home page or not
	$homekeys = array_keys( $mitems );
	$home = @$mitems[$home_menu->id]->name;
	$path = "";

	// this is a patch job for the frontpage items! aje
	if ($Itemid == $home_menu->id) {
		switch ($option) {
			case 'content':
			$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );
			if ($task=='blogsection'){

				$database->setQuery( "SELECT title FROM #__sections WHERE id=$id" );
			} else if ($task=='blogcategory') {
				$database->setQuery( "SELECT title FROM #__categories WHERE id=$id" );
			} else {
				$database->setQuery( "SELECT title, catid FROM #__content WHERE id=$id" );
			}

			$row = null;
			$database->loadObject( $row );
			echo $database->getErrorMsg();

			$id = max( array_keys( $mitems ) ) + 1;

			// add the content item
			$mitem2 = pathwayMakeLink(
			$Itemid,
			$row->title,
			"",
			1
			);
			$mitems[$id] = $mitem2;
			$Itemid = $id;

			$home = "<a href=\"".sefRelToAbs("index.php")."\" class=\"pathway\">$home</a>";
			break;

		}
	}

	switch( @$mitems[$Itemid]->type ) {
		case 'content_section':
		$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );

		switch ($task) {
			case 'category':
			if ($id) {
				$database->setQuery( "SELECT title FROM #__categories WHERE id=$id" );
				$title = $database->loadResult();
				echo $database->getErrorMsg();

				$id = max( array_keys( $mitems ) ) + 1;
				$mitem = pathwayMakeLink(
				$id,
				$title,
				"index.php?option=$option&amp;task=$task&amp;id=$id&amp;Itemid=$Itemid",
				$Itemid
				);
				$mitems[$id] = $mitem;
				$Itemid = $id;
			}
			break;

			case 'view':
			if ($id) {
				// load the content item name and category
				$database->setQuery( "SELECT title, catid FROM #__content WHERE id=$id" );
				$row = null;
				$database->loadObject( $row );
				echo $database->getErrorMsg();

				// load and add the category
				$database->setQuery( "SELECT c.title AS title, s.id AS sectionid "
				."FROM #__categories AS c "
				."LEFT JOIN #__sections AS s "
				."ON c.section=s.id "
				."WHERE c.id=$row->catid" );
				$result = $database->loadObjectList();
				echo $database->getErrorMsg();
				$title = $result[0]->title;
				$sectionid = $result[0]->sectionid;

				$id = max( array_keys( $mitems ) ) + 1;
				$mitem1 = pathwayMakeLink(
				$Itemid,
				$title,
				"index.php?option=$option&amp;task=category&amp;sectionid=$sectionid&amp;id=$row->catid",
				$Itemid
				);
				$mitems[$id] = $mitem1;

				// add the final content item
				$id++;
				$mitem2 = pathwayMakeLink(
				$Itemid,
				$row->title,
				"",
				$id-1
				);
				$mitems[$id] = $mitem2;
				$Itemid = $id;

			}
			break;
		}
		break;

		case 'content_category':
		$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );

		switch ($task) {

			case 'view':
			if ($id) {
				// load the content item name and category
				$database->setQuery( "SELECT title, catid FROM #__content WHERE id=$id" );
				$row = null;
				$database->loadObject( $row );
				echo $database->getErrorMsg();

				$id = max( array_keys( $mitems ) ) + 1;
				// add the final content item
				$mitem2 = pathwayMakeLink(
				$Itemid,
				$row->title,
				"",
				$Itemid
				);
				$mitems[$id] = $mitem2;
				$Itemid = $id;

			}
			break;
		}
		break;

		case 'content_blog_category':
		case 'content_blog_section':
		switch ($task) {
			case 'view':
			$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );

			if ($id) {
				// load the content item name and category
				$database->setQuery( "SELECT title, catid FROM #__content WHERE id=$id" );
				$row = null;
				$database->loadObject( $row );
				echo $database->getErrorMsg();

				$id = max( array_keys( $mitems ) ) + 1;
				$mitem2 = pathwayMakeLink(
				$Itemid,
				$row->title,
				"",
				$Itemid
				);
				$mitems[$id] = $mitem2;
				$Itemid = $id;

			}
			break;
		}
		break;
	}

	$i = count( $mitems );
	$mid = $Itemid;

	while ($i--) {
		if (!$mid || empty( $mitems[$mid] ) || $mid == 1 || !eregi("option", $optionstring)) {
			break;
		}
		$item =& $mitems[$mid];

		// if it is the current page, then display a non hyperlink
		if ($item->id == $Itemid || empty( $mid ) || empty($item->link)) {
			$newlink = "  $item->name";
		} else if (isset($item->type) && $item->type == 'url') {
			$correctLink = eregi("http://", $item->link);
			if ($correctLink==1) {
				$newlink = "<a href=\"$item->link\" target=\"_window\" class=\"pathway\">$item->name</a>";
			} else {
				$newlink = "http://$link";
			}
		} else {
			$newlink = "  <a href=\"".sefRelToAbs($item->link."&amp;Itemid=".$item->id)."\" class=\"pathway\">$item->name</a>";
		}

		if (trim($newlink)!="") {
			$path = " &raquo; $newlink $path";
		} else {
			$path = "";
		}

		$mid = $item->parent;
	}

	if (eregi( "option", $optionstring ) && trim( $path )) {
		$home = "<a href=\"".sefRelToAbs("index.php")."\" class=\"pathway\">$home</a>";
	}

	echo ("<span class=\"pathway\">$home $path</span>");
}

// code placed in a function to prevent messing up global variables
showPathway( $Itemid );
?>
