<?php
/**
 * View file for Append default comment on the player page
 *
 * This file is to Append default comment on the player page
 *
 * @category   Apptha
 * @package    videoplus
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

/** No direct access */
defined('_JEXEC') or die('Restricted access'); 
?>
<input type="hidden" name="id" id="id" value="<?php echo JRequest::getInt('id'); ?>">
<?php
$user = JFactory::getUser();
$cat_id = '';
$cmdid = JRequest::getInt('cmdid');
$id = JRequest::getInt('id');
$catid = JRequest::getInt('catid');
$requestpage = JRequest::getInt('page');
$seoOption = $this->dispEnable['seo_option'];

if (isset($this->commenttitle)) {
	if ($seoOption == 1) {
		$commentCategoryVal = "category=" . $this->commenttitle[0]->seo_category;
		$commentVideoVal = "video=" . $this->commenttitle[0]->seotitle;
	} else {
		$commentCategoryVal = "catid=" . $this->commenttitle[0]->playlistid;
		$commentVideoVal = "id=" . $this->commenttitle[0]->id;
	}

	$currentURL = 'index.php?option=com_contushdvideoshare&view=player&' . $commentCategoryVal . '&' . $commentVideoVal;

	if (version_compare(JVERSION, '1.6.0', 'ge')) {
		$loginURL = JURI::base() . "index.php?option=com_users&amp;view=login&return=" . base64_encode($currentURL);
	} else {
		$loginURL = JURI::base() . "index.php?option=com_user&amp;view=login&return=" . base64_encode($currentURL);
	}
}

if ($cmdid == 4) { ?>
	<link rel="stylesheet" href="<?php echo JURI::base(); ?>components/com_jcomments/tpl/default/style.css"
		  type="text/css" />
	<script type="text/javascript" src="<?php echo JURI::base(); ?>includes/js/joomla.javascript.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(); ?>components/com_jcomments/js/jcomments-v2.1.js">
	</script>
	<script type="text/javascript" src="<?php echo JURI::base(); ?>components/com_jcomments/libraries/joomlatune/ajax.js">
	</script>
<?php $comments = JPATH_ROOT . '/components/com_jcomments/jcomments.php';
	if (file_exists($comments)) {
		require_once $comments;
		echo JComments::showComments( JRequest::getInt('id'), 'com_contushdvideoshare', $this->commenttitle[0]->title );
	}
}
if ($cmdid == 3) { 
	require_once JPATH_PLUGINS . DS . 'content' . DS . 'jom_comment_bot.php';
	echo jomcomment(JRequest::getInt('id'), "com_contushdvideoshare");	
}
if ($cmdid == 2) {
	if ($id) { ?>
		<div class="comment_textcolumn">
			<script type="text/javascript" src="<?php
			echo JURI::base(); ?>components/com_contushdvideoshare/js/membervalidator.js"></script>
			<!-- FORM STARTS HERE -->
			<div class="commentstop clearfix" >
				<div class="leave floatleft"><span class="comment_txt"><?php
				echo JText::_('HDVS_COMMENTS'); ?></span> 
					(<span id="commentcount"><?php echo $this->commenttitle['totalcomment']; ?></span>)</div>
				<?php if ($user->get('id') != '') { ?>
					<div class="commentpost floatright"><a  onclick="comments();" class="utility-link"><?php echo JText::_('HDVS_POST_COMMENT'); ?></a></div>
				<?php } else {
					if (version_compare(JVERSION, '1.6.0', 'ge')) { ?>
						<div class="commentpost floatright"><a href="<?php echo $loginURL; ?>"
																class="utility-link"><?php
																echo JText::_('HDVS_LOGIN_TO_COMMENT');
																?></a></div>
			<?php  } else { ?>
						<div class="commentpost floatright"><a href="<?php echo $loginURL; ?>"
																class="utility-link"><?php
																echo JText::_('HDVS_LOGIN_TO_COMMENT');
																?></a></div>
			<?php  }
				} ?>
			</div>
		<?php if ($id && $catid) {
				$id = $id;
				$cat_id = $catid;
			} ?>
			<div id="success"></div>
			<div id="commentdisplay">
				<div id="initial"></div>
				<div id="al"></div>
				<!--FORM ends HERE -->
				<!-- Comments display starts here -->
				<?php
				$sum = count($this->commenttitle1);
				if ($sum != 0) { ?>
					<div class="underline"></div>
			<?php } ?>
				<!--FIRST ROW HERE-->
			<?php $page = $_SERVER['REQUEST_URI'];
				$j = 0;
				foreach ($this->commenttitle1 as $row) { ?>
			<?php if ($row->parentid == 0) { ?>
						<div class="clearfix" >
							<div class="subhead changecomment" >
								<span class="video_user_info">
									<strong><?php echo $row->name; ?></strong>
									<span class="user_says"> <?php echo JText::_('HDVS_SAYS'); ?> </span>
								</span>
								<span class="video_user_comment"><?php echo $string = nl2br($row->message); ?></span>
								<span  class="video_user_info">
									<span class="user_says"> <?php echo JText::_('HDVS_POSTED_ON'); ?> <?php
									echo date("m-d-Y", strtotime($row->created)); ?></span></span>
							</div>
					<?php  if ($user->get('id') != '') { ?>
							<div class="reply changecomment1"><a class="cursor_pointer" onclick="textdisplay(<?php echo $row->id; ?>);
								parentvalue(<?php if ($row->parentid != 0) {
										echo $row->parentid;
									} else {
										echo $row->id;
									} ?>)" title="Reply for this comment" value="1" id="hh">
									<?php echo JText::_('HDVS_REPLY'); ?></a></div>
				<?php } ?>
						</div>
			<?php } else { ?>
						<div class="clsreply clearfix" >
							<span  class="video_user_info">
								<strong><?php echo JText::_('HDVS_RE'); ?> <span><?php echo $row->name; ?></span></strong>
								<span class="user_says"> <?php echo JText::_('HDVS_SAYS'); ?> </span>
							</span>
							<span class="video_user_comment"><?php echo $string = nl2br($row->message); ?></span>
							<span  class="video_user_info">
								<span class="user_says"> <?php echo JText::_('HDVS_POSTED_ON'); ?> <?php 
								echo date("m-d-Y", strtotime($row->created)); ?></span></span>
						</div>
					<?php  } ?>
					<div id="<?php if ($row->parentid != 0) {
						echo $row->parentid;
					} else {
						echo $row->id;
					} ?>" class="initial"></div>
					<?php if ($j < $sum - 1) {
						if ($this->commenttitle1[$j + 1]->parentid == 0) { ?>
							<div class="underline"></div>
				<?php  }
					}
					$j++;
				} ?>
				<!-- Comments display ends here -->
				<br/>
				<!--  PAGINATION STARTS HERE-->
				<table cellpadding="0" cellspacing="0" border="0"   id="pagination" class="floatright">
					<tr align="right">
						<td align="right"  class="page_rightspace">
							<table cellpadding="0" cellspacing="0"  border="0" align="right">
								<tr>
									<?php
									$pages = $this->commenttitle['pages'];
									$q = $this->commenttitle['pageno'];
									$q1 = $this->commenttitle['pageno'] - 1;

									if ($this->commenttitle['pageno'] > 1) {
										echo("<td><a onclick='changepage($q1);'>" . JText::_('HDVS_PREVIOUS') . "</a></td>");
									}

									if ($requestpage) {
										if ($requestpage > 3) {
											$page = $requestpage - 1;

											if ($requestpage > 3) {
												if ($requestpage >= 7) {
													$next_page_cal = $requestpage / 2;
													$next_page = ceil($next_page_cal);
													echo("<li><a onclick='changepage(1)'>1</a></li>");
													echo ("<li>...</li>");
													echo("<li><a onclick='changepage(" . $next_page . ")'>$next_page</a></li>");
													echo ("<li>...</li>");
												} else {
													echo("<li><a onclick='changepage(1)'>1</a></li>");
													echo ("<li>...</li>");
												}
											}
										} else {
											$page = 1;
										}
									} else {
										$page = 1;
									}

									if ($pages > 1) {
										for ($i = $page, $j = 1; $i <= $pages; $i++, $j++) {
											if ($q != $i) {
												echo("<td><a onclick='changepage(" . $i . ")'>" . $i . "</a></td>");
											} else {
												echo("<td><a onclick='changepage($i);' class='activepage'>$i</a></td>");
											}

											if ($j > 3) {
												break;
											}
										}

										if ($i < $pages) {
											if ($i + 1 != $pages) {
												echo ("<td>....</td>");
											}
											echo("<td><a onclick='changepage(" . $pages . ")'>" . $pages . "</a></td>");
										}
										$p = $q + 1;
										if ($q < $pages) {
											echo ("<td><a onclick='changepage($p);'>" . JText::_('HDVS_NEXT') . "</a></td>");
										}
									}
									?>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<!--  PAGINATION ENDS HERE-->

				<input type="hidden" value="" id="divnum">
				<?php 
				$page = 'index.php?option=com_contushdvideoshare&view=commentappend&id=' . JRequest::getVar('id', '', 'get', 'int');
				$hidden_page = '';
				$searchtextbox = JRequest::getVar('searchtxtbox', '', 'post', 'string');
				$hiddensearchbox = JRequest::getVar('hidsearchtxtbox', '', 'post', 'string');

				if ($requestpage) {
					$hidden_page = $requestpage;
				} else {
					$hidden_page = '';
				}

				if ($searchtextbox) {
					$hidden_searchbox = $searchtextbox;
				} else {
					$hidden_searchbox = $hiddensearchbox;
				}
				?>
				<form name="pagination_page" id="pagination_page" action="<?php echo $page; ?>" method="post">
					<input type="hidden" id="page" name="page" value="<?php echo $hidden_page ?>" />
					<input type="hidden" id="hidsearchtxtbox" name="hidsearchtxtbox"
						   value="<?php echo $hidden_searchbox; ?>" />
				</form>
				<div id="txt" >
					<form  id="form" name="commentsform" action="javascript:insert(<?php 
					echo JRequest::getVar('id', '', 'get', 'int'); ?>)" method="post"
					onsubmit="return validation(this);
					hidebox();" >
						<div class="comment_input">
							<span class="label"> <?php echo JText::_('HDVS_NAME'); ?>  : </span>
							<input type="text" name="username" id="username" class="newinputbox commenttxtbox"  />
						</div>

						<div class="clear"></div>
						<div class="comment_txtarea">
							<span class="label"><?php echo JText::_('HDVS_COMMENT'); ?>   : </span>
							<textarea class="messagebox commenttxtarea" name="comment_message" id="comment_message"
									  onKeyDown="CountLeft(this.form.comment_message, this.form.left, 500);"
									  onKeyUp="CountLeft(this.form.comment_message, this.form.left, 500);" ></textarea>
							<div   class="remaining_character"><div class="floatleft" style="margin-top: 4px;">
									<?php echo JText::_('HDVS_REMAINING_CHARECHTER'); ?>&nbsp;:&nbsp;</div>
								<div class="commenttxt"><input readonly type="text" name="left" size=1 maxlength=8
								value="500" style="border:none;background:none;width:70px;" /></div></div>

						</div>
						<div class="comment_bottom">
							<input type="hidden" name="videoid" value="<?php echo JRequest::getVar('id', '', 'get', 'int'); ?>" id="videoid"/>
							<input type="hidden" name="category" value="<?php echo $cat_id; ?>" id="category"/>
							<input type="hidden" name="parentid" value="0" id="parent"/>
							<input type="submit" value="<?php echo JText::_('HDVS_SUBMIT'); ?>" class="button clsinputnew"  />
							<input type="hidden" name="postcomment" id="postcomment" value="true">
							<input type="hidden"  value="" id="parentvalue" name="parentvalue" />
						</div><div align="center" id="prcimg"  style="display:none;">
							<img src="<?php echo JURI::base(); ?>components/com_contushdvideoshare/images/commentloading.gif"
								 width="100px"></div>
					</form><br/>
					<div id="insert_response" class="msgsuccess"></div>
					<script> document.getElementById('prcimg').style.display = "none";</script>
				</div>
				<div class="clear"></div></div></div>
		<?php
	}
}
