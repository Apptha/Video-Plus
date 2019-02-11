<?php
/**
 * Video Plus banner module
 *
 * This file is to display Banner module 
 *
 * @category   Apptha
 * @package    mod_videoplusbanner
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2014 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

/** Include common helper file */
include_once (JPATH_SITE . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_contushdvideoshare' . DIRECTORY_SEPARATOR . 'helper.php');

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$ratearray = array("nopos1", "onepos1", "twopos1", "threepos1", "fourpos1", "fivepos1");
$document = JFactory::getDocument();
/** Get language to check direction */
$rtlLang = getLanguageDirection ();

/** Include css file based on the ltr and rtl direction */
if ($rtlLang == 1) {
  $document->addStyleSheet(JURI::base() . 'components/com_contushdvideoshare/css/stylesheet_rtl.min.css');
} else {
  $document->addStyleSheet(JURI::base() . 'components/com_contushdvideoshare/css/stylesheet.min.css');
}
$document->addStyleSheet(JURI::base() . 'templates/videoplus/css/black&white.min.css');
$dispenable = unserialize($result1[0]->dispenable);
?>
<script type="text/javascript">
	var lt = false;
	var videoid = <?php echo $videoList[0]->id; ?>;
</script>
<!--[if lt IE 7]>
<script type="text/javascript">
var lt=true;
</script>
<![endif]-->
<!--[if lt IE 8]>
<script type="text/javascript">
var lt=true;
</script>
<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript">
var lt=true;
</script>
<![endif]-->
<script type="text/javascript" src="<?php echo JURI::base() ?>modules/mod_videoplusbanner/script.min.js"></script>
<div class="clear"></div>
<div id="featured" style="display:none;">
	<!--Left side Thumb design starts here-->
	<div class="left_side" id="slider_banner" >
		<ul class="ui-tabs-nav">
<?php
if (count($videoList) > 0)
{
	$totalrecords = count($videoList);

	for ($i = 0; $i < $totalrecords; $i++)
	{
		if ($videoList[$i]->filepath == "File" || $videoList[$i]->filepath == "FFmpeg" || $videoList[$i]->filepath == 'Embed')
		{
			$src_path = JURI::base() . "components/com_contushdvideoshare/videos/" . $videoList[$i]->thumburl;
		}

		if ($videoList[$i]->filepath == "Url" || $videoList[$i]->filepath == "Youtube")
		{
			$src_path = $videoList[$i]->thumburl;
		}

		$displaytitle = $videoList[$i]->title;

		if (strlen($displaytitle) > 25)
		{
			$displaytitle = JHTML::_('string.truncate', ($displaytitle), 25);
		}
		else
		{
			$displaytitle = $displaytitle;
		}
		?>
					<li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-<?php echo $videoList[$i]->id; ?>">
						<div class="nav_container">
							<a href="javascript:void(0)" onclick="switchVideo('fragment-<?php
							echo $videoList[$i]->id;
							?>');" ><img src="<?php
							echo $src_path;
							?>" style="width:70px;height:46px;" alt="<?php
							echo $displaytitle;
							?>" />
								<div class="slide_video_info" style=" color: white; ">
									<h3><?php echo $displaytitle; ?></h3>
									<div id="module_videos">
		<?php
		if ($dispenable['ratingscontrol'] == 1)
		{
			?>

											<?php
											if (isset($videoList[$i]->ratecount) && $videoList[$i]->ratecount != 0)
											{
												$ratestar = round($videoList[$i]->rate / $videoList[$i]->ratecount);
											}
											else
											{
												$ratestar = 0;
											}
											?>
											<div id="<?php echo $ratearray[$ratestar]; ?>"></div>
										<?php
		}
										?>
									</div>
									<?php
									if ($dispenable['viewedconrtol'] == 1)
									{
											echo JText::_('HDVS_VIEWS');
											?> : <?php
										echo $videoList[$i]->times_viewed;
									}
									?>
								</div>
							</a>
						</div>
					</li>
				<?php
	}
}
			?>
		</ul>
	</div>
<!--Left side Thumb design ends and player starts here-->
	<div class="right_side">
		<div id="videoPlay" class="ui-tabs-panel videoplayer" style="height:100%">   
		</div>
		<input type="hidden" id="activeCSS" value="fragment-<?php echo $videoList[0]->id; ?>" />
		<?php
		if (count($videoList) > 0)
		{
			$totalrecords = count($videoList);

			for ($i = 0; $i < $totalrecords; $i++)
			{
				if ($videoList[$i]->filepath == "File" || $videoList[$i]->filepath == "FFmpeg")
				{
					$src_path = JURI::base() . "components/com_contushdvideoshare/videos/" . $videoList[$i]->thumburl;
				}

				$current_path = "components/com_contushdvideoshare/videos/";

				if ($videoList[$i]->filepath == "Url" || $videoList[$i]->filepath == "Youtube" || $videoList[$i]->filepath == "Embed")
				{
					$src_path = $videoList[$i]->thumburl;

					if ($videoList[$i]->filepath == "Url")
					{
						$video = $videoList[$i]->videourl;
					}
					else
					{
						$video = JURI::base() . $current_path . $videoList[$i]->videourl;
					}
				}

				$fullscreen = isset($fullscreen) ? $fullscreen : '';
				$language = JRequest::getVar('lang');
				$langs = '';

				if (!empty($language))
				{
					$langs = '&lang=' . $language;
				}
				else
				{
					$langs = '&lang=en';
				}

				$playerpath = JURI::base() . "components/com_contushdvideoshare/hdflvplayer/hdplayer.swf";
				$baseURL = JURI::base();
				$videoId = $videoList[$i]->id;
				$catID = $videoList[$i]->playlistid;
				$moduleName = "playerModule";

				if ($language != '')
				{
					$languages = '&slang=' . JRequest::getVar('lang');
				}
				else
				{
					$languages = '&slang=en';
				}
				?>
				<div id="fragment-<?php echo $videoList[$i]->id; ?>" class="ui-tabs-panel device_grid">
					<?php
					if ($videoList[$i]->filepath == 'Embed')
					{
						$iframcontus = str_replace('iframe', 'iframcontus', $videoList[$i]->embedcode);
						$embed_code = str_replace('embed', 'embecontus', $iframcontus);
						$video_code = str_replace('video', 'videcontus', $embed_code);
						$embed_code = str_replace('object', 'objeccontus', $video_code);
						$playeriframewidth = str_replace('width="', 'width="701"', $embed_code);
						echo $playeriframeheight = str_replace('height="', 'height="303"', $playeriframewidth);
					}
					else
					{
						$mobile = videoshare_Detect_mobile ();

						if ($mobile === true)
						{
							if ($videoList[$i]->filepath == "Youtube" || strpos($videoList[$i]->videourl, 'youtube.com') > 0)
							{
								if (strpos($videoList[$i]->videourl, 'youtube.com') > 0)
								{
									$url = $videoList[$i]->videourl;
									$query_string = array();
									parse_str(parse_url($url, PHP_URL_QUERY), $query_string);
									$id = $query_string["v"];
									$videoid = trim($id);
								}
								?>
							<iframcontus  type="text/html" width="701" height="303"
							src="http://www.youtube.com/embed/<?php
							echo $videoid;
							?>" frameborder="0" class="device_frame">
															</iframcontus>
							<?php
							} else if ($videoList[$i]->filepath == "File" || $videoList[$i]->filepath == "FFmpeg" || $videoList[$i]->filepath == "Url")
							{
								?>
								<videcontus id="video" src="<?php
								echo $video;
								?>"  autobuffer controls onerror="failed(event)" width="701" height="303">
								</videcontus>
								<?php
							}
						}
						else
						{
							$videovimeoURL = $videoList[$i]->videourl;
							?>
							<?php
							if ((preg_match('/vimeo/', $videovimeoURL)) && ($videovimeoURL != ''))
							{
								$split = explode("/", $videovimeoURL);
								?>
								<iframcontus
									src="<?php
									echo 'http://player.vimeo.com/video/' . $split[3] . '?title=0&amp;byline=0&amp;portrait=0';
									?>"
									width="701"
									height="303" frameborder="0"></iframcontus>
								<?php
							}
							else
							{
							?>
								<embecontus wmode="opaque" src="<?php
								echo $playerpath;
								?>" type="application/x-shockwave-flash"
								allowscriptaccess="always" allowfullscreen="<?php
								echo $fullscreen;
								?>"
								flashvars="baserefJHDV=<?php
								echo $baseURL
								. '/index.php/&id=' . $videoId . '&pagerefresh=false&mtype=playerModule&catid=' . $catID . '&mid='
								. $moduleName . $languages . $playsettings;
								?>"  width="701" height="303"></embecontus>
										<?php
							}
						}
					}
								?>
				</div>

	<?php
			}
		}
?>
	</div>
<!--Right side player ends here-->
</div>
<div class="clear"></div>
<script type="text/javascript">
jqbanner(function() {
   jqbanner(window).load(function() {
      jqbanner("#featured").css("display", "block");
	});
});
</script>
