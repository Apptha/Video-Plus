<?php
/**
 * Video Plus Categories module
 *
 * This file is to install Categories module 
 *
 * @category   Apptha
 * @package    mod_videopluscategories
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2014 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Import Joomla filesystem library
jimport('joomla.filesystem.folder');

// Import Joomla installer library
jimport('joomla.installer.installer');

// Import Joomla environment library
jimport('joomla.environment.uri');

/**
 * Videoplus categories Module installer file
 *
 * @package     Joomla.Contus_HD_Video_Share
 * @subpackage  Com_Contushdvideoshare
 * @since       1.5
 */
class mod_videopluscategoriesInstallerScript
{
	/**
	 * Joomla before installation hook for plugin
	 * 
	 * @param   string  $type    type
	 * @param   string  $parent  parent value
	 * 
	 * @return  preflight
	 */
	public function preflight($type, $parent)
	{
	}

	/**
	 * Joomla installation hook for plugin
	 * 
	 * @param   string  $parent  parent value
	 * 
	 * @return  install
	 */
	public function install($parent)
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$root = JPATH_SITE;

		$query->update($db->quoteName('#__modules'))
				->set($db->quoteName('published') . ' = ' . $db->quote('1'))
				->set($db->quoteName('position') . ' = ' . $db->quote('videoplus-category'))
				->where($db->quoteName('module') . ' = ' . $db->quote('mod_videopluscategories'));
		$db->setQuery($query);
		$db->query();

		$query->clear()
				->select('id')
				->from('#__modules')
				->where($db->quoteName('module') . ' = ' . $db->quote('mod_videopluscategories'));
		$db->setQuery($query);
		$db->query();
		$mid4 = $db->loadResult();

		$query->clear()
				->insert($db->quoteName('#__modules_menu'))
				->columns($db->quoteName('moduleid'))
				->values($db->quote($mid4));
		$db->setQuery($query);
		$db->query();

		if (JFile::exists($root . '/modules/mod_videopluscategories/mod_videopluscategories.xml'))
		{
			JFile::delete($root . '/modules/mod_videopluscategories/mod_videopluscategories.xml');
		}

		JFile::move(
				$root . '/modules/mod_videopluscategories/mod_videopluscategories.j3.xml',
				$root . '/modules/mod_videopluscategories/mod_videopluscategories.xml'
				);
	}

	/**
	 * Joomla after installation hook for plugin
	 * 
	 * @param   string  $type    type
	 * @param   string  $parent  parent value
	 * 
	 * @return  postflight
	 */
	public function postflight($type, $parent)
	{
	}

	/**
	 * Joomla uninstallation hook for plugin
	 * 
	 * @return  uninstall
	 */
	public function uninstall()
	{
	}
}