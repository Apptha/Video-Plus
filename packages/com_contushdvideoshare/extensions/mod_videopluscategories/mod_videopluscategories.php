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

// Define DS
if (! defined ( 'DS' )) {
	define ( 'DS', DIRECTORY_SEPARATOR );
}

require_once dirname ( __FILE__ ) . DS . 'helper.php';

if (version_compare ( JVERSION, '1.7.0', 'ge' )) {
	$version = '1.7';
} elseif (version_compare ( JVERSION, '1.6.0', 'ge' )) {
	$version = '1.6';
} else {
	$version = '1.5';
}


if ($version != '1.5')
{
}
else
{
	$params = ModvideoplusCategoriesHelper::getvideocategoryParam();
}

$class 			= $params->get('moduleclass_sfx');
$intCategoryLimit = $params->get ( 'catLimit' );
$intVideoLimit = $params->get ( 'videoLimit' );
$result1 = ModvideoplusCategoriesHelper::getcategorysettings ();
$catName = ModvideoplusCategoriesHelper::getcategorylist ($intCategoryLimit);
$Itemid = ModvideoplusCategoriesHelper::getmenuitemid_thumb ();

require JModuleHelper::getLayoutPath ( 'mod_videopluscategories' );
