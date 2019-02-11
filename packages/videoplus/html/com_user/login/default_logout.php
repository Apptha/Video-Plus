<?php
/**
 * View file to display logout page
 *
 * @category   Apptha
 * @package    videoplus
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

/** No direct access */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 *
 * @todo Should this be routed
 */
?>
<form action="<?php echo JRoute::_('index.php'); ?>" method="post"
	name="login" id="login">
	<?php
	if ($this->params->get ( 'show_logout_title' )) {
		?>
		<div
		class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
			<?php echo $this->escape($this->params->get('header_logout')); ?>
		</div>
	<?php
	}
	?>
	<table border="0" align="center" cellpadding="4" cellspacing="0"
		class="contentpane<?php
		echo $this->escape ( $this->params->get ( 'pageclass_sfx' ) );
		?>"
		width="100%">
		<tr>
			<td valign="top">
				<div>
					<?php
					echo $this->image;
					
					if ($this->params->get ( 'description_logout' )) {
						echo $this->escape ( $this->params->get ( 'description_logout_text' ) );
					}
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">
				<div align="center">
					<input type="submit" name="Submit" class="button"
						value="<?php echo JText::_('Logout'); ?>" />
				</div>
			</td>
		</tr>
	</table>

	<br /> <br /> <input type="hidden" name="option" value="com_user" /> <input
		type="hidden" name="task" value="logout" /> <input type="hidden"
		name="return" value="<?php echo $this->return; ?>" />
</form>
