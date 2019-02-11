<?php
/**
 * Video Plus header module
 *
 * This file is to fetch details for header module 
 *
 * @category   Apptha
 * @package    mod_videoplusheader
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2014 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * Videoplus header Module Helper
 *
 * @package Joomla.Contus_HD_Video_Share
 * @subpackage Com_Contushdvideoshare
 * @since 1.5
 */
class ModvideoplusHeaderHelper {
	/**
	 * Function to get header parameters
	 *
	 * @return array
	 */
	public function getvideoheaderParam() {
		$app = JFactory::getApplication ();
		$template = $app->getTemplate ();
		$filePath = JPATH_SITE . DS . 'templates' . DS . $template . DS . 'params.ini';
		$content = file_get_contents ( $filePath );
		$paramVal = new JParameter ( $content );
		
		return $paramVal;
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
		$query->select ( 'id' )->from ( '#__menu' )->where ( $db->quoteName ( 'link' ) . ' = ' . $db->quote ( 'index.php?option=com_contushdvideoshare&view=player' ) )->where ( $db->quoteName ( 'published' ) . ' = ' . $db->quote ( '1' ) )->order ( 'id DESC' );
		$db->setQuery ( $query );
		$Itemid = $db->loadResult ();
		
		return $Itemid;
	}
	
	/**
	 * Function to get videos settings
	 *
	 * @return array
	 */
	public static function getvideossettings() {
		$db = JFactory::getDBO ();
		$query = $db->getQuery ( true );
		
		// Query is to select the videos row
		$query->select ( 'dispenable' )->from ( '#__hdflv_site_settings' );
		$db->setQuery ( $query );
		$rows = $db->loadObjectList ();
		
		return $rows;
	}
	
	/**
	 * Function to get channel users key
	 * 
	 * @return Ambigous <mixed, NULL>
	 */
	public static function getChannelKey () {
	  $db = JFactory::getDBO ();
	  $query = $db->getQuery ( true );
	  $userid =  (int) getUserID() ;
	  $query->clear()->select($db->quoteName('user_key'))->from($db->quoteName( CHANNELTABLE ));
	  $query->where($db->quoteName('user_id'). ' = '. $db->quote($userid));
	  $db->setQuery($query);
	  return $db->loadResult();
	}
}
