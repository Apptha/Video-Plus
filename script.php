<?php
/**
 * @name       Videoplus package
 * @SVN        2.1
 * @package    Pkg_VideoplusPackage
 * @author     Apptha <assist@apptha.com>
 * @copyright  Copyright (C) 2016 Powered by Apptha
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @since      Joomla 1.5
 * @Creation Date   March 2010
 */

/** No direct access to this file */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/** Import Joomla utilities library */
jimport ( 'joomla.utilities.error' );

/** Import Joomla filesystem library */
jimport ( 'joomla.filesystem.file' );

/**
 * Videoplus package installer file
 *
 * @package Joomla.Pkg_VideoplusPackage
 * @subpackage Pkg_VideoplusPackage
 * @since 1.5
 */
class Pkg_VideoplusPackageInstallerScript {
  /**
   * Joomla installation hook for component
   *
   * @param string $parent
   *          parent value
   *          
   * @return install
   */
  public function install($parent) {
  }
  
  /**
   * Joomla uninstallation hook for component
   *
   * @param string $parent
   *          parent value
   *          
   * @return uninstall
   */
  public function uninstall($parent) {
  }
  
  /**
   * Joomla before installation hook for component
   *
   * @param string $type
   *          type
   * @param string $parent
   *          parent value
   *          
   * @return preflight
   */
  public function preflight($type, $parent) {
  }
  
  /**
   * Joomla after installation hook for component
   *
   * @param string $type
   *          type
   * @param string $parent
   *          parent value
   *          
   * @return postflight
   */
  function postflight($type, $parent) {
    $root = JPATH_SITE;
    
    if (! defined ( 'DS' )) {
      define ( 'DS', DIRECTORY_SEPARATOR );
    }
    
    if (JFile::exists ( $root . DS . 'templates' . DS . 'videoplus' . DS . 'templateDetails.xml' )) {
      JFile::delete ( $root . DS . 'templates' . DS . 'videoplus' . DS . 'templateDetails.xml' );
    }
    
    JFile::move ( $root . DS . 'templates' . DS . 'videoplus' . DS . 'templateDetails.j3.xml', $root . DS . 'templates' . DS . 'videoplus' . DS . 'templateDetails.xml' );
    
    echo "<br />";
    echo '<p style="font-style:normal;font-size:13px;font-weight:normal; margin-top:10px;margin-left:10px;">Videoplus</p>
        <p> HD Video Share Installed Successfully</p>
        <p> Module Videoplus Header Installed Successfully </p>
        <p> Module Videoplus Banner Installed Successfully</p>
        <p> Module Videoplus Categories Installed Successfully </p>
        <p> Template Videoplus Installed Successfully</p> <br/>';
  }
}