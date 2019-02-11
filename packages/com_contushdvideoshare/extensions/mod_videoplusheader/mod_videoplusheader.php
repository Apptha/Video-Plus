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
require_once dirname ( __FILE__ ) . '/helper.php';

// Get current template name
$app = JFactory::getApplication ();
$template = $app->getTemplate ();
$user = JFactory::getUser ();
$baseURL = JURI::base ();

if (version_compare ( JVERSION, '1.7.0', 'ge' )) {
	$version = '1.7';
} elseif (version_compare ( JVERSION, '1.6.0', 'ge' )) {
	$version = '1.6';
} else {
	$version = '1.5';
}

if ($version != '1.5') {
	// Get the Param values
	$paramVal = JFactory::getApplication ()->getTemplate ( true )->params;
} else {
	$paramVal = ModvideoplusHeaderHelper::getvideoheaderParam ();
}

// Get the Param values
$facebookURL = $paramVal->get ( 'facebook_url' );
$twitterURL = $paramVal->get ( 'twitter_url' );
$linkedinURL = $paramVal->get ( 'linkedin_url' );
$googleplusURL = $paramVal->get ( 'googleplus_url' );
$siteLogo = $paramVal->get ( 'logo' );

if (empty ( $googleplusURL )) {
	$googleplusURL = 'http://www.plus.google.com';
}
elseif (!preg_match("~^(?:f|ht)tps?://~i", $googleplusURL))
{
	$googleplusURL = "http://" . $googleplusURL;
}

if (empty ( $facebookURL )) {
	$facebookURL = 'http://www.facebook.com';
}
elseif (!preg_match("~^(?:f|ht)tps?://~i", $facebookURL))
{
	$facebookURL = "http://" . $facebookURL;
}

if (empty ( $twitterURL )) {
	$twitterURL = 'http://www.twitter.com';
}
elseif (!preg_match("~^(?:f|ht)tps?://~i", $twitterURL))
{
	$twitterURL = "http://" . $twitterURL;
}

if (empty ( $linkedinURL )) {
	$linkedinURL = 'http://www.linkedin.com';
}
elseif (!preg_match("~^(?:f|ht)tps?://~i", $linkedinURL))
{
	$linkedinURL = "http://" . $linkedinURL;
}

if (empty ( $rssURL )) {
	$rssURL = 'http://www.feeds.feedburner.com';
}
elseif (!preg_match("~^(?:f|ht)tps?://~i", $rssURL))
{
	$rssURL = "http://" . $rssURL;
}

if (empty ( $siteLogo ) && $siteLogo == '') {
	$siteLogo = 'templates' . "/" . $template . "/" . 'images' . "/" . 'logo.png';
}

$rows = ModvideoplusHeaderHelper::getvideossettings ();
$Itemid = ModvideoplusHeaderHelper::getmenuitemid_thumb ();
$userKey = ModvideoplusHeaderHelper::getChannelKey();

// To display the html layout path
require JModuleHelper::getLayoutPath ( 'mod_videoplusheader' );
