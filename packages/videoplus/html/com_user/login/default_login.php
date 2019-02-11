<?php
/**
 * View file to display login page
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

if (JPluginHelper::isEnabled ( 'authentication', 'openid' )) {
	$lang = JFactory::getLanguage ();
	$lang->load ( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
	$langScript = 'var JLanguage = {};' . ' JLanguage.WHAT_IS_OPENID = \'' . JText::_ ( 'WHAT_IS_OPENID' ) . '\';' . ' JLanguage.LOGIN_WITH_OPENID = \'' . JText::_ ( 'LOGIN_WITH_OPENID' ) . '\';' . ' JLanguage.NORMAL_LOGIN = \'' . JText::_ ( 'NORMAL_LOGIN' ) . '\';' . ' var comlogin = 1;';
	$document = JFactory::getDocument ();
	$document->addScriptDeclaration ( $langScript );
	JHTML::_ ( 'script', 'openid.js' );
}
?>
<form
	action="<?php echo JRoute::_('index.php', true, $this->params->get('usesecure')); ?>"
	method="post" name="com-login" id="com-form-login">
	<table width="100%" border="0" align="center" cellpadding="4"
		cellspacing="0"
		class="contentpane<?php
		echo $this->escape ( $this->params->get ( 'pageclass_sfx' ) );
		?>">
		<tr>
			<td colspan="2">
				<?php
				if ($this->params->get ( 'show_login_title' )) {
					?>
					<div
					class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
						<?php echo $this->params->get('header_login'); ?>
					</div>
				<?php
				}
				?>
			</td>
		</tr>

	</table>
	<fieldset class="input">
		<div class="floatleft">
			<p id="com-form-login-username">
				<label for="username"><?php echo JText::_('Username') ?></label><br />
				<input name="username" id="username" type="text" class="inputbox"
					alt="username" size="18" />
			</p>
			<p id="com-form-login-password">
				<label for="passwd"><?php echo JText::_('Password') ?></label><br />
				<input type="password" id="passwd" name="passwd" class="inputbox"
					size="18" alt="password" />
			</p>
		</div>
		<div class="floatleft">
			<?php echo $this->image; ?>
		</div>
		<div class="clear"></div>
		<?php
		if (JPluginHelper::isEnabled ( 'system', 'remember' )) {
			?>
			<p id="com-form-login-remember">
			<input type="checkbox" id="remember" name="remember" class="inputbox"
				value="yes" alt="Remember Me" /> <label for="remember"><?php echo JText::_('Remember me') ?></label>
			<br />
		</p>
		<?php
		}
		?>
		<input type="submit" name="Submit" class="button"
			value="<?php echo JText::_('LOGIN') ?>" class="floatleft" />
		<?php
		$usersConfig = JComponentHelper::getParams ( 'com_users' );
		
		if ($usersConfig->get ( 'allowUserRegistration' )) {
			?>

			<a
			href="<?php echo JRoute::_('index.php?option=com_user&view=register'); ?>">
			<input type="button" name="register" id="register" value="Register" />
		</a>

<?php
		}
		?>
	</fieldset>
	<ul>
		<li><a
			href="<?php echo JRoute::_('index.php?option=com_user&view=reset'); ?>">
<?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a></li>
		<li><a
			href="<?php echo JRoute::_('index.php?option=com_user&view=remind'); ?>">
<?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a></li>

	</ul>

	<input type="hidden" name="option" value="com_user" /> <input
		type="hidden" name="task" value="login" /> <input type="hidden"
		name="return" value="<?php echo $this->return; ?>" />
<?php echo JHTML::_('form.token'); ?>
</form>
