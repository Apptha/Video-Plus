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
?>
<div class="logout<?php echo $this->pageclass_sfx ?>">
	<?php
	if ($this->params->get ( 'show_page_heading' )) {
		?>
		<h1>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	<?php
	}
	?>

	<?php
	if ($this->params->get ( 'logoutdescription_show' ) == 1 || $this->params->get ( 'logout_image' ) != '') {
		?>
		<div class="logout-description">
	<?php
	}
	
	if ($this->params->get ( 'logoutdescription_show' ) == 1) {
		echo $this->params->get ( 'logout_description' );
	}
	
	if (($this->params->get ( 'logout_image' ) != '')) {
		?>
			<img
			src="<?php echo $this->escape($this->params->get('logout_image')); ?>"
			class="logout-image"
			alt="<?php
		echo JTEXT::_ ( 'COM_USER_LOGOUT_IMAGE_ALT' );
		?>" />
	<?php
	}
	
	if ($this->params->get ( 'logoutdescription_show' ) == 1 || $this->params->get ( 'logout_image' ) != '') {
		?>
		</div>
	<?php
	}
	?>

	<form
		action="<?php echo JRoute::_('index.php?option=com_users&amp;task=user.logout'); ?>"
		method="post">
		<div>
			<button type="submit" class="button"><?php echo JText::_('JLOGOUT'); ?></button>
			<input type="hidden" name="return"
				value="<?php
				echo base64_encode ( $this->params->get ( 'logout_redirect_url', $this->form->getValue ( 'return' ) ) );
				?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
