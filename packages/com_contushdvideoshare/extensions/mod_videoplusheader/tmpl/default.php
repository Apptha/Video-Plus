<?php
/**
 * Video Plus header module
 *
 * This file is to display for header module 
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

JHtml::_ ( 'behavior.keepalive' );
$folderPath = JPATH_SITE . DS . 'components' . DS . 'com_contushdvideoshare';
$hdvideoshare = JFolder::exists ( $folderPath );
$isEnable = ($hdvideoshare) ? true : false;

if (! defined ( 'USER_LOGIN' )) {
	$dispenable = unserialize ( $rows [0]->dispenable );
	define ( 'USER_LOGIN', $dispenable ['user_login'] );
}

/** Check user key is exists
 * Based on that generate channel page URL*/
if(!empty($userKey)) {
  $channelURL = JRoute::_('index.php?option=com_contushdvideoshare&task=channel&ukey='.$userKey);
} else {
  $channelURL = JRoute::_('index.php?option=com_contushdvideoshare&task=addnewchannel');
}

$app = JFactory::getApplication();
?>
<div class="logo">
	<h1>
		<a href="<?php echo $baseURL; ?>"> <img
			src="<?php echo JURI::root () . $siteLogo; ?>"
			alt="<?php echo $app->getCfg( 'sitename' ); ?>"
			title="<?php echo $app->getCfg( 'sitename' ); ?>" />
		</a>
	</h1>
</div>
<!-- Top Right content Starts Here -->
<div class="topright_content">
	<div class="topcontent">
		<!-- Login/Logout options start -->
		<div class="social_network ">
			<ul>
				<li><a href="<?php
				echo $googleplusURL;
				?>"
					target="_blank"><img
						src="<?php
						echo $baseURL;
						?>/templates/<?php
						echo $template;
						?>/images/googleplus.png"
						title="googleplus" alt="googleplus" width="24" height="24" /></a></li>
				<li><a href="<?php
				echo $twitterURL;
				?>" target="_blank"><img
						src="<?php
						echo $baseURL;
						?>/templates/<?php
						echo $template;
						?>/images/twitter.png"
						title="twitter" alt="twitter" width="24" height="24" /></a></li>
				<li><a href="<?php
				echo $facebookURL;
				?>" target="_blank"><img
						src="<?php
						echo $baseURL;
						?>/templates/<?php
						echo $template;
						?>/images/facebook.png"
						title="facebook" alt="facebook" width="24" height="24" /></a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<?php 
		if (USER_LOGIN == '1') {
			if ($user->guest) {
				if ($isEnable) {
					$return = base64_encode ( JRoute::_ ( 'index.php?Itemid=' . $Itemid . '&amp;option=com_contushdvideoshare&amp;view=myvideos', false ) );
				}
				
				$return = isset ( $return ) ? $return : '';
				?>
				<input class="music_loginbtn" type="button"
			value="<?php echo JText::_('HDVS_LOGIN'); ?>" name="loginbtn"
			style="background: none;"
			onClick="javascript:location.href = '<?php
				echo JRoute::_ ( 'index.php?option=com_users&amp;view=login&amp;return=' . $return, false );
				?>';" /> <input class="music_signupbtn" type="button"
			value="<?php echo JText::_('HDVS_REGISTER'); ?>" name="signupbtn"
			onClick="javascript:location.href = '<?php
				echo JRoute::_ ( 'index.php?option=com_users&amp;view=registration', false );
				?>';" />
			<?php
			} else {
				$return = base64_encode ( JRoute::_ ( 'index.php?option=com_users&amp;view=login' ) );
				?>
				<form action="<?php echo JRoute::_('index.php', false); ?>"
			method="post" id="music_logout">
			<input type="hidden" name="option" value="com_users" /> <input
				type="hidden" name="task" value="user.logout" /> <input
				type="submit" class="music_loginbtn" name="Submit"
				value="<?php echo JText::_('HDVS_LOGOUT'); ?>"
				style="background: none;" /> <input type="hidden" name="return"
				value="<?php echo $return; ?>" />
					<?php echo JHtml::_('form.token'); ?>
				</form>
				<?php
				if ($isEnable) {
					?>					
					<input class="music_loginbtn" type="button"
			value="<?php echo JText::_('HDVS_MY_VIDEOS'); ?>" name="myvideos"
			onClick="javascript:location.href = '<?php
					echo JRoute::_ ( 'index.php?Itemid=' . $Itemid . '&amp;option=com_contushdvideoshare&amp;view=myvideos' );
					?>';" />
					<input class="music_loginbtn" type="button"
			value="<?php echo JText::_('HDVS_MY_PLAYLISTS'); ?>" name="myplaylist"
			onClick="javascript:location.href = '<?php
					echo JRoute::_ ( 'index.php?Itemid=' . $Itemid . '&amp;option=com_contushdvideoshare&amp;view=myplaylists' );
					?>';" />
					<input class="music_loginbtn" type="button"
			value="<?php echo JText::_('HDVS_MY_CHANNEL'); ?>" name="mychannel"
			onClick="javascript:location.href = '<?php
					echo $channelURL;
					?>';" />					
				<?php
				}
			}
		}
		?>
		<!-- Login/Logout options end -->

	</div>
<?php
if ($isEnable) {
	?>
		<div class="videos_search">
		<form name="hsearch" id="hsearch" method="post"
			action="<?php
	echo JRoute::_ ( 'index.php?Itemid=' . $Itemid . '&amp;option=com_contushdvideoshare&amp;view=hdvideosharesearch' );
	?>"
			enctype="multipart/form-data">
			<input type="text" name="searchtxtbox" id="searchtxtbox"
				class="clstextfield"
				value="<?php echo JText::_('HDVS_SEARCH'); ?>..."
				onfocus="if (this.value == '<?php echo JText::_('HDVS_SEARCH'); ?>...') {
						this.value = '';
						this.style.color = 'black';
					}"
				onblur="if (this.value == '') {
						this.style.color = 'black';
						this.value = '<?php echo JText::_('HDVS_SEARCH'); ?>...';
					}" /> <input type="submit"
				title="<?php
	echo JText::_ ( 'HDVS_SEARCH' );
	?> <?php
	echo JText::_ ( 'HDVS_VIDEO' );
	?>"
				name="search_btn" id="search_btn" class="button"
				value="<?php
	echo JText::_ ( 'HDVS_SEARCH' );
	?>" />
		</form>
	</div>
<?php
}
?>
	<div class="clear"></div>
	<!-- Top Right Content Ends Here -->
</div>
