<?php
/**
 * Video Plus banner module
 *
 * This file is to fetch details for Banner module 
 *
 * @category   Apptha
 * @package    mod_videoplusbanner
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2014 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * Videoplus banner Module Helper
 *
 * @package Joomla.Contus_HD_Video_Share
 * @subpackage Com_Contushdvideoshare
 * @since 1.5
 */
class Modvideoplusbanner {
	/**
	 * Function to get featured videos for banner
	 *
	 * @return array
	 */
	public static function getVideoListDetails() {
		$db = JFactory::getDBO ();
		$query = $db->getQuery ( true );
		$query->select ( '*' )->from ( '#__hdflv_upload' )->where ( $db->quoteName ( 'published' ) . ' = ' . $db->quote ( '1' ) )->where ( $db->quoteName ( 'featured' ) . ' = ' . $db->quote ( '1' ) )->order ( 'id desc' );
		$db->setQuery ( $query, 0, 4 );
		$video = $db->loadobjectList ();
		
		return $video;
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
		$query->select ( '*' )->from ( '#__hdflv_site_settings' );
		$db->setQuery ( $query );
		$rows = $db->loadObjectList ();
		
		return $rows;
	}
	
	/**
	 * Function to get banner module parameters
	 *
	 * @return array
	 */
	public function getvideobannerParam() {
		$filePath = dirname ( __FILE__ ) . DS . 'params.ini';
		$content = file_get_contents ( $filePath );
		$paramVal = new JParameter ( $content );
		
		return $paramVal;
	}
}
