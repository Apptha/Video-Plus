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

if ($version != '1.5') {
} else {
	$params = Modvideoplusbanner::getvideobannerParam ();
}

$class = $params->get ( 'moduleclass_sfx' );
$showPlaylist = ($params->get ( 'showPlaylist' ) == 0) ? 'false' : 'true';
$fullscreen = ($params->get ( 'fullscreen' ) == 0) ? 'false' : 'true';
$share = ($params->get ( 'share' ) == 0) ? 'false' : 'true';
$timer = ($params->get ( 'timer' ) == 0) ? 'false' : 'true';
$zoom = ($params->get ( 'zoom' ) == 0) ? 'false' : 'true';
$volume = ($params->get ( 'volume' ) == 0) ? 'false' : 'true';
$playlistopen = ($params->get ( 'playlistOpen' ) == 0) ? 'false' : 'true';
$skinhide = ($params->get ( 'skinAutohide' ) == 0) ? 'false' : 'true';
$playlist_autoplay = ($params->get ( 'playlist_autoplay' ) == 0) ? 'false' : 'true';
$autoplay = ($params->get ( 'autoplay' ) == 0) ? 'false' : 'true';

// Get the video details
$videoList = Modvideoplusbanner::getVideoListDetails ();
$result1 = Modvideoplusbanner::getvideossettings ();
$playsettings = '&autoplay=' . $autoplay . '&playlist_open=' . $playlistopen . '&playlist_auto=' . $playlist_autoplay . '&skin_autohide=' . $skinhide . '&showPlaylist=' . $showPlaylist . '&timer=' . $timer . '&shareIcon=' . $share . '&fullscreen=' . $fullscreen . '&zoomIcon=' . $zoom . '&volumecontrol=' . $volume;

// To display the html layout path
require JModuleHelper::getLayoutPath ( 'mod_videoplusbanner' );
