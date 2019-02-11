<?php
/**
 * Video Plus Categories module
 *
 * This file is to display Categories module 
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

/** Include component helper */
include_once (JPATH_SITE . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_contushdvideoshare' . DIRECTORY_SEPARATOR . 'helper.php');
$document = JFactory::getDocument ();
/** Get language to check direction */
$rtlLang = getLanguageDirection ();
$ratearray = array ( "nopos1", "onepos1", "twopos1", "threepos1", "fourpos1", "fivepos1" );
if (JRequest::getVar ( 'option' ) != 'com_contushdvideoshare') {
  if ($rtlLang == 1) {
	$document->addStyleSheet ( JURI::base () . 'components/com_contushdvideoshare/css/mod_stylesheet_rtl.min.css' );
  } else {
    $document->addStyleSheet ( JURI::base () . 'components/com_contushdvideoshare/css/mod_stylesheet.min.css' );
  }
    if (!version_compare(JVERSION, '3.0.0', 'ge')) {
      $document->addScript(JURI::base() . 'components/com_contushdvideoshare/js/jquery.js');
    } else {
      JHtml::_('jquery.framework');
    }
	$document->addScript ( JURI::base () . "components/com_contushdvideoshare/js/htmltooltip.js" );
}
$dispenable = unserialize ( $result1 [0]->dispenable );
$userId = (int) getUserID ();

$count = getPlaylistCount ();
if ( $count > 5 ) {
  $scrolClass = ' popup_scroll';
}
 
  /** Include css file based on the ltr and rtl direction */
  if ($rtlLang == 1) {
    $document->addStyleSheet ( JURI::base () . 'components/com_contushdvideoshare/css/stylesheet_rtl.min.css' );
  } else {
    $document->addStyleSheet ( JURI::base () . 'components/com_contushdvideoshare/css/stylesheet.min.css' );
  }

if ($catName > 0) {
	?>
<div id="categorymodule">
	<div id="module_videos" class="clearfix">
	<?php
	// For SEO settings
	$seoOption = $dispenable ['seo_option'];
	$strCategoryInc = 1;
	
	foreach ( $catName as $cat ) {
		$categoryName = $cat->id;
		$strVideoInc = 1;
		
		if ($strCategoryInc == 1 || $strCategoryInc % 4 == 1) {
			echo '<div class="clearfix" style="margin-bottom:10px;">';
		}
		?>
				<ul class="categories_video">
			<li>
		<?php
		$list = ModvideoplusCategoriesHelper::getVideocategories ($categoryName, $intVideoLimit);

		if (count ( $list ) > 0) {
			?>
							<h3><?php echo $cat->category; ?></h3>
				<ul>
							<?php
			foreach ( $list as $videoList ) {
				if ($videoList->playlistid == $categoryName) {
					if ($videoList->filepath == "File" || $videoList->filepath == "FFmpeg" || $videoList->filepath == "Embed") {
						$src_path = JURI::base () . "components/com_contushdvideoshare/videos/" . $videoList->thumburl;
					}
					
					if ($videoList->filepath == "Url" || $videoList->filepath == "Youtube") {
						$src_path = $videoList->thumburl;
					}
					
					$video_catid = (isset ( $videoList->playlistid )) ? $videoList->playlistid : '';
					
					if ($seoOption == 1) {
						$featureCategoryVal = "category=" . $videoList->seo_category;
						$featureVideoVal = "video=" . $videoList->seotitle;
					} else {
						$featureCategoryVal = "catid=" . $video_catid;
						$featureVideoVal = "id=" . $videoList->id;
					}
					?>
										<li>
						<div class="leftvideo video_thumb_wrap">

										<?php
					if (isset ( $videoList->ratecount ) && $videoList->ratecount != 0) {
						$ratestar = round ( $videoList->rate / $videoList->ratecount );
					} else {
						$ratestar = 0;
					}
					?>
													<a class="info_hover" rel="htmltooltip"
								href="<?php
					echo JRoute::_ ( 'index.php?Itemid=' . $Itemid . '&amp;option=com_contushdvideoshare&view=player&' . $featureCategoryVal . '&' . $featureVideoVal, true );
					?>"> <img class="yt-uix-hovercard-target"
								src="<?php
					echo $src_path;
					?>" width="93"
								height="52" alt="" />
								<?php 
					if(!empty($userId) && !empty($videoList->VideoId)){
						?><div class="watched_overlay"></div><?php
					}
					?></a>
					<?php
					if(!empty($userId)) {
						if(empty($videoList->video_id)) {
							?>
							<a class="watch_later_wrap" href="javascript:void(0)" onclick="addWatchLater(<?php echo $videoList->id; ?>, '<?php echo JURI::base(); ?>', this);">
								<span class="watch_later default-watch-later" title="<?php echo JText::_ ( 'HDVS_ADD_TO_LATER_VIDEOS' );?>"></span>
							</a>
				        	<?php
						}
						else {
							?>
							<a class="watch_later_wrap" href="javascript:void(0)" >
								<span class="watch_later success-watch-later" title="<?php echo JText::_ ( 'HDVS_ADDED_TO_LATER_VIDEOS' );?>"></span>
							</a>
							<?php
						}
					}
					?>
					<a href="javascript:void(0)" onclick="return openplaylistpopup('videopluscategories',<?php echo $videoList->id; ?>)" class="add_to_playlist_wrap">
			        	<span class="add_to_playlist" title="<?php echo JText::_ ( 'HDVS_ADD_TO_PLAYLIST' );?>"></span>
			        </a> 
			        <div class="addtocontentbox" id="videopluscategories_playlistcontainer<?php echo $videoList->id; ?>" style="display:none">
                  	     <div id="videopluscategoriesplayliststatus<?php echo $videoList->id; ?>" style="display:none" class="playliststatus"></div>
			         <p><?php echo JText::_('HDVS_PLAYLIST_ADD_NE'); ?></p>
                  			<ul id="videopluscategories_playlists<?php echo $videoList->id; ?>" class="playlists_ul<?php echo $scrolClass; ?>">
                  			</ul>
			      <?php if( $userId ) {?>
					<div id="videopluscategories_no-playlists<?php echo $videoList->id; ?>" class="no-playlists"></div>
					<div class="create_playlist border-top:2px solid gray;">
					<button id="videopluscategories_playlistadd<?php echo $videoList->id; ?>" onclick="opencrearesection('videopluscategories',<?php echo $videoList->id; ?>);" class="button playlistadd" ><?php echo JText::_('HDVS_ADDPLAYLIST_LABEL'); ?></button>
                       <div class="addplaylist" id="videopluscategories_addplaylistform<?php echo $videoList->id; ?>" style="display:none">
				       <input type="text" value="" placeholder="<?php echo JText::_('HDVS_PLAYLIST_NAME_ERROR')?>" id="videopluscategories_playlistname_input<?php echo $videoList->id; ?>" class="play_textarea" name="playlistname" autocomplete="off" autofocus="off" onkeyup="if (event.keyCode != 13) return addplaylist('<?php echo $videoList->id; ?>','videopluscategories');" onkeydown="if (event.keyCode == 13) document.getElementById('videopluscategories_button-save-home<?php echo $videoList->id; ?>').click()" />
				       <span id="videopluscategories-playlistresponse-<?php echo $videoList->id; ?>" style="float:left; width:100%;">
				       </span>
				       <input type="button" id="videopluscategories_button-save-home<?php echo  $videoList->id; ?>" class="playlistaddform-hide-btn" onclick="return ajaxaddplaylist('<?php echo $videoList->id; ?>','videopluscategories');" value="<?php echo JText::_('HDVS_MY_ADDTO_SAVE_LABEL');?>">
				       <div class="videopluscategories_playlistname_loading-play" id="videopluscategories_playlistname_loading-play<?php echo $videoList->id; ?>"></div>
				       </div>
				       </div> 
                       <?php restriction_info($Itemid,'videopluscategories',$videoList->id); } else { displayLoginRegister(); } ?>
			         </div>
															<?php
					if ($videoList->duration != null) {
						?>
													<div class="video_duration">
								<span><?php
						echo $videoList->duration;
						?></span>
							</div>
															<?php
					}
					?>

											</div>
						<div class="rightcontent">
							<h4>
								<a
									href="<?php
					echo JRoute::_ ( "index.php?Itemid=" . $Itemid . "&amp;option=com_contushdvideoshare&amp;view=player&amp;id=" . $videoList->id . "&amp;catid=" . $video_catid );
					?>"><?php
					if (strlen ( $videoList->title ) > 18) {
						echo (substr ( $videoList->title, 0, 33 )) . "...";
					} else {
						echo $videoList->title;
					}
					?></a>
							</h4>
												<?php
					if ($dispenable ['ratingscontrol'] == 1) {
						?>
													<div class=" clearfix">
														<?php
						if (isset ( $videoList->ratecount ) && $videoList->ratecount != 0) {
							$ratestar = round ( $videoList->rate / $videoList->ratecount );
						} else {
							$ratestar = 0;
						}
						?>
														<div class="floatleft innerrating">
									<div id="<?php
						echo $ratearray [$ratestar];
						?>"></div>
								</div>
							</div>
														<?php
					}
					?>

												<div class="clearfix"><?php
					if ($dispenable ['viewedconrtol'] == 1) {
						?>
														<div class="clsview"> <?php echo JText::_('HDVS_VIEWS') . ': '; ?></div>
								<span class="clsviewrate hit_rate"><?php
						echo $videoList->times_viewed;
						?>
														</span>
												<?php
					}
					?></div>
						</div>
						<div class="clear"></div>
					</li>

					<!--Tooltip Starts Here-->
					<div class="htmltooltip">
												<?php
					if ($videoList->description) {
						?>
													<p class="tooltip_discrip">
														<?php echo JHTML::_('string.truncate', (strip_tags($videoList->description)), 120); ?></p>
														<?php
					}
					?>
												<div class="tooltip_category_left">
							<span class="title_category"><?php echo JText::_('HDVS_CATEGORY'); ?>: </span>
							<span class="show_category"><?php echo $cat->category; ?></span>
						</div>
												<?php
					if ($dispenable ['viewedconrtol'] == 1) {
						?>
													<div class="tooltip_views_right">
							<span class="view_txt"><?php echo JText::_('HDVS_VIEWS'); ?>: </span>
							<span class="view_count"><?php echo $videoList->times_viewed; ?> </span>
						</div>
						<div id="htmltooltipwrapper37">
							<div class="chat-bubble-arrow-border"></div>
							<div class="chat-bubble-arrow"></div>
						</div>
												<?php
					}
					?>
											</div>

					<!--Tooltip end Here-->
					<?php
					if ($strVideoInc == $intVideoLimit) {
						break;
					}
					
					$strVideoInc ++;
				}
			}
			?>
							</ul>
		<?php
		}
		?>
						<div class="clsmorebtn clearfix">
					<a
						href="<?php
		echo JRoute::_ ( "index.php?Itemid=" . $Itemid . "&amp;option=com_contushdvideoshare&amp;view=category&amp;catid=" . $cat->id );
		?>"
						title="<?php
		echo JText::_ ( 'HDVS_MORE_VIDEOS' );
		?>"><?php
		echo JText::_ ( 'HDVS_MORE_VIDEOS' );
		?></a>
				</div>
			</li>
		</ul>
				<?php
		if ($strCategoryInc % 4 == 0 || $strCategoryInc == count ( $catName )) {
			echo '</div>';
		}
		?>
				<?php
		if ($strCategoryInc == $intCategoryLimit) {
			break;
		}
		
		$strCategoryInc ++;
	}
	?>
		</div>
</div>
<script type="text/javascript">
	jQuery.noConflict();
	jQuery(document).ready(function($) {
		jQuery(".ulvideo_thumb").mouseover(function() {
			htmltooltipCallback();
		});
	});
</script>
<?php
	$lang = JFactory::getLanguage ();
	$langDirection = ( bool ) $lang->isRTL ();
	
	if ($langDirection == 1) {
		$rtlLang = 1;
	} else {
		$rtlLang = 0;
	}
	?>
<!--Tooltip for video thumbs-->
<script type="text/javascript">
			jQuery.noConflict();
			window.onload = function()
			{
			htmltooltipCallback("htmltooltip", "",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip1", "1",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip2", "2",<?php echo $rtlLang; ?>);
			}

			jQuery(".ulvideo_thumb").mouseover(function() {
			htmltooltipCallback("htmltooltip", "",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip1", "1",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip2", "2",<?php echo $rtlLang; ?>);
			});
			jQuery(document).click(function() {
			htmltooltipCallback("htmltooltip", "",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip1", "1",<?php echo $rtlLang; ?>);
			htmltooltipCallback("htmltooltip2", "2",<?php echo $rtlLang; ?>);
			});


			</script>
<?php
}
