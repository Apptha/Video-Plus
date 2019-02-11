<?php
/**
 * View file to display register page
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

JHtml::_ ( 'behavior.keepalive' );
JHtml::_ ( 'behavior.formvalidation' );
?>
<div class="registration<?php echo $this->pageclass_sfx ?>">
	<?php
	if ($this->params->get ( 'show_page_heading' )) {
		?>
		<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php
	}
	?>

	<form id="member-registration"
		action="<?php
		echo JRoute::_ ( 'index.php?option=com_users&amp;task=registration.register' );
		?>"
		method="post" class="form-validate">
		<?php
		foreach ( $this->form->getFieldsets () as $fieldset ) {
			// Iterate through the form fieldsets and display each one.
			$fields = $this->form->getFieldset ( $fieldset->name );
			
			if (count ( $fields )) {
				?>
				<fieldset>
					<?php
				if (isset ( $fieldset->label )) {
					// If the fieldset has a label set, display it as the legend.					?>
						<h2><?php echo JText::_($fieldset->label); ?></h2>
					<?php
				}
				?>
					<dl>
						<?php
				foreach ( $fields as $field ) {
					// Iterate through the fields in the set and display them.
					?>
							<?php
					if ($field->hidden) {
						// If the field is hidden, just display the input.						?>
								<?php echo $field->input; ?>
							<?php
					} else {
						?>
								<dt>
								<?php echo $field->label; ?>
								<?php
						if (! $field->required && (! $field->type == "spacer")) {
							?>
									<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
								<?php
						}
						?>
								</dt>
				<dd><?php echo $field->input; ?></dd>
							<?php
					}
					?>
						<?php
				}
				?>
					</dl>
		</fieldset>
			<?php
			}
		}
		?>
		<div>
			<button type="submit" class="validate"><?php echo JText::_('JREGISTER'); ?></button>
			<input type="hidden" name="option" value="com_users" /> <input
				type="hidden" name="task" value="registration.register" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
