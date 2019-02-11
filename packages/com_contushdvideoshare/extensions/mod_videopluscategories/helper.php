<?php
/**
 * Video Plus Categories module
 *
 * This file is to fetch details for Categories module 
 *
 * @category   Apptha
 * @package    mod_videopluscategories
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2014 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted access' );

// No direct access.
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * Videoplus categories Module Helper
 *
 * @package Joomla.Contus_HD_Video_Share
 * @subpackage Com_Contushdvideoshare
 * @since 1.5
 */
class ModvideoplusCategoriesHelper {
	/**
	 * Function to get videos categories list
	 *
	 * @return array
	 */
	public static function getVideocategories($categoryName, $intVideoLimit) {
		$db = JFactory::getDbo ();		
		$query = $db->getQuery ( true );
		$userId = (int) getUserID();
		
		if (!empty($userId)) {
  		$query->clear ()->select ( array ( 'a.id', 'a.filepath', 'a.thumburl', 'a.title', 'a.description', 'a.times_viewed', 'a.ratecount',
  	   'a.rate', 'a.amazons3', 'a.duration', 'a.seotitle', 'a.playlistid', 'b.category', 'b.seo_category', 'wl.video_id', 'wh.VideoId' ) )->from ( '#__hdflv_upload AS a' )
		->leftJoin ( '#__hdflv_category AS b ON a.playlistid=b.id' )
		->leftJoin ( WATCHLATERTABLE.' AS wl ON a.id=wl.video_id AND wl.user_id='.$userId )
		->leftJoin ( WATCHHISTORYTABLE.' AS wh ON a.id=wh.VideoId AND wh.userId='.$userId );
		} else {
		  $query->clear ()->select ( array ( 'a.id', 'a.filepath', 'a.thumburl', 'a.title', 'a.description', 'a.times_viewed', 'a.ratecount',
		      'a.rate', 'a.amazons3', 'a.duration', 'a.seotitle', 'a.playlistid', 'b.category', 'b.seo_category' ) )->from ( '#__hdflv_upload AS a' )
		      ->leftJoin ( '#__hdflv_category AS b ON a.playlistid=b.id' );
		}

		$query->where ( $db->quoteName ( 'a.published' ) . ' = ' . $db->quote ( '1' ) )
		->where ( $db->quoteName ( 'b.published' ) . ' = ' . $db->quote ( '1' ) )
		->where ( $db->quoteName ( 'b.id' ) . ' = ' . $categoryName )
		->order ( 'a.id DESC' );
		$db->setQuery ( $query, 0, $intVideoLimit );
		$rows = $db->loadObjectList ();
		
		return $rows;
	}
	
	/**
	 * Function to get itemid of the video share menu
	 *
	 * @return int
	 */
	public static function getmenuitemid_thumb() {
		$db = JFactory::getDBO ();
		$query = $db->getQuery ( true );
		
		// Query is to get itemid of the video share menu
		$query->select ( 'id' )
		->from ( '#__menu' )
		->where ( $db->quoteName ( 'link' ) . ' = ' . $db->quote ( 'index.php?option=com_contushdvideoshare&view=player' ) )
		->where ( $db->quoteName ( 'published' ) . ' = ' . $db->quote ( '1' ) )
		->order ( 'id DESC' );
		$db->setQuery ( $query );
		$Itemid = $db->loadResult ();
		
		return $Itemid;
	}
	
	/**
	 * Function to get videos settings
	 *
	 * @return array
	 */
	public static function getcategorysettings() {
		$db = JFactory::getDBO ();
		$query = $db->getQuery ( true );
		
		// Query is to select the videos row
		$query->clear ()
		->select ( '*' )
		->from ( '#__hdflv_site_settings' );
		$db->setQuery ( $query );
		$rows = $db->LoadObjectList ();
		
		return $rows;
	}
	
	/**
	 * Function to get categories list
	 *
	 * @return array
	 */
	public static function getcategorylist($intCategoryLimit) {
		$db = JFactory::getDBO ();
		$query = $db->getQuery ( true );

		if(empty($intCategoryLimit)){
			$intCategoryLimit = 4;
		}

		$query->clear ()->select ( array (
				'distinct a.id',
				'a.category',
				'a.seo_category' 
		) )
		->from ( '#__hdflv_category AS a' )
		->rightJoin ( '#__hdflv_upload AS b ON b.playlistid=a.id' )
		->where ( $db->quoteName ( 'a.published' ) . ' = ' . $db->quote ( '1' ) )
		->where ( $db->quoteName ( 'b.published' ) . ' = ' . $db->quote ( '1' ) )
		->order ( 'a.ordering ASC' );
		$db->setQuery ( $query, 0, $intCategoryLimit );

		$valrows = $db->loadObjectList ();
		
		return $valrows;
	}
	
	/**
	 * Function to get categories module parameters
	 *
	 * @return array
	 */
	public function getvideocategoryParam() {
		$filePath = dirname(__FILE__) . DS . 'params.ini';
		$content = file_get_contents ( $filePath );
		$paramVal = new JParameter ( $content );
		
		return $paramVal;
	}
}
