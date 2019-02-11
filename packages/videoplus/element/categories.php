<?php
/**
 * Video Plus categories element
 *
 * This file is to display for category details for XML fields
 *
 * @category   Apptha
 * @package    videoplus
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2014 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * Element Categories class
 *
 * @package Joomla.Videoplus
 * @subpackage Videoplus
 * @since 1.5
 */
class JElementCategories extends JElement {
	/**
	 * Function to get fetch catgory elements
	 *
	 * @param var $name
	 *        	input box name
	 * @param var $value
	 *        	input box value
	 * @param
	 *        	var &$node node value
	 * @param var $control_name
	 *        	control name
	 *        	
	 * @return void
	 */
	public function fetchElement($name, $value, &$node, $control_name) {
		$db = JFactory::getDBO ();
		$query = $db->getQuery ( true );
		$section = $node->attributes ( 'section' );
		$class = $node->attributes ( 'class' );
		
		if (! $class) {
			$class = "inputbox";
		}
		
		if (! isset ( $section )) {
			// Alias for section
			$section = $node->attributes ( 'scope' );
			
			if (! isset ( $section )) {
				$section = 'content';
			}
		}
		
		if ($section == 'content') {
			$fields = array (
					$db->quoteName ( 'c.id' ) . ' AS value',
					'CONCAT_WS( "/",' . $db->quoteName ( 's.title' ) . ', ' . $db->quoteName ( 'c.title' ) . ' AS text' 
			);
			$query->clear ()->select ( $fields )->from ( $db->quoteName ( '#__categories' ) . ' AS c' )->leftJoin ( '#__sections AS s ON s.id=c.section' )->where ( $db->quoteName ( 'c.published' ) . ' = ' . $db->quote ( '1' ) )->where ( $db->quoteName ( 's.scope' ) . ' = ' . $db->quote ( $section ) )->order ( $db->quoteName ( 's.title' ) . ', ' . $db->quoteName ( 'c.title' ) );
		} else {
			$fields = array (
					$db->quoteName ( 'c.id' ) . ' AS value',
					$db->quoteName ( 'c.title' ) . ' AS text' 
			);
			$query->clear ()->select ( $fields )->from ( $db->quoteName ( '#__categories' ) . ' AS c' )->where ( $db->quoteName ( 'c.published' ) . ' = ' . $db->quote ( '1' ) )->where ( $db->quoteName ( 'c.section' ) . ' = ' . $db->quote ( $section ) )->order ( $db->quoteName ( 'c.title' ) );
		}
		
		$db->setQuery ( $query );
		$options = $db->loadObjectList ();
		
		return JHTML::_ ( 'select.genericlist', $options, '' . $control_name . '[' . $name . '][]', 'class="inputbox" 
 size="5"
 multiple="multiple"', 'value', 'text', $value, $control_name . $name );
	}
}
