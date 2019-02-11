<?php
/**
 * Video Plus media element
 *
 * This file is to get logo for videoplus theme
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
defined ( 'JPATH_BASE' ) or die ();

// Import Joomla formfield library
jimport ( 'joomla.form.formfield' );

/**
 * Form Field class for the Media.
 *
 * @package Joomla.Videoplus
 * @subpackage Videoplus
 * @since 1.5
 */
class JElementMedia extends JElement {
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
		// Load the modal behavior script.
		$document = JFactory::getDocument ();
		$path = JURI::root () . 'templates/videoplus/options/';
		$document->addStylesheet ( $path . 'style.css' );
		$document->addScript ( $path . 'script.js' );
		
		// Create new directory for banner and logo images
		if ($name == 'logo') {
			$dirPath = JPATH_SITE . '/images/stories/logoimage';
			$folder = "logoimage";
		} elseif ($name == 'banner') {
			$dirPath = JPATH_SITE . '/images/stories/bannerimage';
			$folder = "bannerimage";
		}
		
		if (! file_exists ( $dirPath )) {
			mkdir ( $dirPath );
		}
		
		JHtml::_ ( 'behavior.modal' );
		
		// Build the script.
		$script = array ();
		$script [] = '  function jInsertEditorText(value,id) {  ';
		$script [] = '  src =value.match(/src="([^\"]*)"/)[1]; ';
		$script [] = '  var old_id = document.getElementById(id).value;';
		$script [] = '  if (old_id != id) {';
		$script [] = '  document.getElementById(id).value = src;';
		$script [] = '	}}';
		
		// Add the script to the document head.
		JFactory::getDocument ()->addScriptDeclaration ( implode ( "\n", $script ) );
		
		// Initialize variables.
		$html = array ();
		
		// The text field.
		$html [] = '<div class="fltlft button2-left">';
		$html [] = '<input type="text" size="30" style="height:18px;" name="params[' . $name . ']" id="' . $name . '" value="' . $value . '" readonly="readonly"/>';
		$html [] = '</div>';
		
		// The button.
		$html [] = '<div class="button2-left">';
		$html [] = '<div class="blank">';
		$html [] = '<a class="modal" title="' . JText::_ ( 'Select' ) . '"' . ' href="index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=' . $name . '&amp;folder=' . $folder . '"' . ' rel="{handler: \'iframe\', size: {x: 800, y: 500}}">';
		$html [] = '' . JText::_ ( 'Select' ) . '</a>';
		$html [] = '</div>';
		$html [] = '</div>';
		$html [] = '<div class="button2-left">';
		$html [] = '<div class="blank" >';
		$html [] = '<a  title="' . JText::_ ( 'Clear' ) . '" onclick="document.getElementById(\'' . $name . '\').value=\'\'">' . JText::_ ( 'Clear' ) . '</a>';
		$html [] = '</div>';
		$html [] = '</div>';
		
		return implode ( "\n", $html );
	}
}
