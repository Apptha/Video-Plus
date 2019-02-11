<?php
/**
 * Display login module
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

if (version_compare ( JVERSION, '1.7.0', 'ge' )) {
	$version = '1.7';
} elseif (version_compare ( JVERSION, '1.6.0', 'ge' )) {
	$version = '1.6';
} else {
	$version = '1.5';
}

if ($version != '1.5') {
	if ($type == 'logout') {
		?>
<form
	action="<?php
		echo JRoute::_ ( 'index.php', true, $params->get ( 'usesecure' ) );
		?>"
	method="post" id="login-form">
				<?php
		if ($params->get ( 'greeting' )) {
			?>
				<div class="login-greeting">
					<?php
			if ($params->get ( 'name' ) == 0) {
				echo JText::sprintf ( 'MOD_LOGIN_HINAME', $user->get ( 'name' ) );
			} else {
				echo JText::sprintf ( 'MOD_LOGIN_HINAME', $user->get ( 'username' ) );
			}
			?>
				</div>
				<?php
		}
		?>
			<div class="logout-button">
		<input type="submit" name="Submit" class="button"
			value="<?php echo JText::_('JLOGOUT'); ?>" /> <input type="hidden"
			name="option" value="com_users" /> <input type="hidden" name="task"
			value="user.logout" /> <input type="hidden" name="return"
			value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
			</div>
</form>
<?php
	} else {
		?>
<form
	action="<?php
		echo JRoute::_ ( 'index.php', true, $params->get ( 'usesecure' ) );
		?>"
	method="post" id="login-form">
			<?php
		if ($params->get ( 'pretext' )) {
			?>
				<div class="pretext">
		<p><?php echo $params->get('pretext'); ?></p>
	</div>
			<?php
		}
		?>
			<fieldset class="userdata">
		<p id="form-login-username" class="clearfix">
			<label for="modlgn-username" class="form-login-label"><?php
		echo JText::_ ( 'MOD_LOGIN_VALUE_USERNAME' );
		?></label> <input id="modlgn-username" type="text" name="username"
				class="inputbox form-login-input" size="18" />
		</p>
		<p id="form-login-password" class="clearfix">
			<label for="modlgn-passwd" class="form-login-label"><?php
		echo JText::_ ( 'JGLOBAL_PASSWORD' );
		?></label> <input id="modlgn-passwd" type="password" name="password"
				class="inputbox form-login-input" size="18" />
		</p>
		<?php
		if (JPluginHelper::isEnabled ( 'system', 'remember' )) {
			?>
					<p id="form-login-remember">
			<input id="modlgn-remember" type="checkbox" name="remember" class=""
				value="yes" /> <label for="modlgn-remember"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>

		</p>
		<?php
		}
		?><div class="clear"></div>

		<div class="login clearfix">
			<input type="submit" name="Submit" class="button"
				value="<?php echo JText::_('JLOGIN') ?>" /> <span class="createbtn"> <?php
		$usersConfig = JComponentHelper::getParams ( 'com_users' );
		
		if ($usersConfig->get ( 'allowUserRegistration' )) {
			?>

							<a
				href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
			<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>

				<?php
		}
		?></span>
		</div>
		<input type="hidden" name="option" value="com_users" /> <input
			type="hidden" name="task" value="user.login" /> <input type="hidden"
			name="return" value="<?php echo $return; ?>" />
							<?php echo JHtml::_('form.token'); ?>
				<ul class="clearfix">
			<li><a
				href="<?php echo JRoute::_('index.php?option=com_users&amp;view=reset'); ?>">
							<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a></li>
			<li><a
				href="<?php echo JRoute::_('index.php?option=com_users&amp;view=remind'); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a></li>

		</ul>
	</fieldset>
			<?php
		if ($params->get ( 'posttext' )) {
			?>
				<div class="posttext">
		<p><?php echo $params->get('posttext'); ?></p>
	</div>
		<?php
		}
		?>
		</form>
<?php
	}
} else {
	?>
			<?php
	if ($type == 'logout') {
		?>
<form action="index.php" method="post" name="login" id="form-login">
				<?php
		if ($params->get ( 'greeting' )) {
			?>
				<div>
					<?php
			if ($params->get ( 'name' )) {
				echo JText::sprintf ( 'HINAME', $user->get ( 'name' ) );
			} else {
				echo JText::sprintf ( 'HINAME', $user->get ( 'username' ) );
			}
			?>
				</div>
		<?php
		}
		?>
			<div align="center">
		<input type="submit" name="Submit" class="button"
			value="<?php echo JText::_('BUTTON_LOGOUT'); ?>" />
	</div>

	<input type="hidden" name="option" value="com_user" /> <input
		type="hidden" name="task" value="logout" /> <input type="hidden"
		name="return" value="<?php echo $return; ?>" />
</form>
<?php
	} else {
		?>
		<?php
		if (JPluginHelper::isEnabled ( 'authentication', 'openid' )) {
			$lang->load ( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
			$langScript = 'var JLanguage = {};' . ' JLanguage.WHAT_IS_OPENID = \'' . JText::_ ( 'WHAT_IS_OPENID' ) . '\';' . ' JLanguage.LOGIN_WITH_OPENID = \'' . JText::_ ( 'LOGIN_WITH_OPENID' ) . '\';' . ' JLanguage.NORMAL_LOGIN = \'' . JText::_ ( 'NORMAL_LOGIN' ) . '\';' . ' var modlogin = 1;';
			$document = JFactory::getDocument ();
			$document->addScriptDeclaration ( $langScript );
			JHTML::_ ( 'script', 'openid.js' );
		}
		?>
<form
	action="<?php
		echo JRoute::_ ( 'index.php', true, $params->get ( 'usesecure' ) );
		?>"
	method="post" name="login" id="form-login">
		<?php echo $params->get('pretext'); ?>
			<fieldset class="input">
		<p id="form-login-username">
			<label for="modlgn_username"><?php echo JText::_('Username') ?></label><br />
			<input id="modlgn_username" type="text" name="username"
				class="inputbox" alt="username" size="18" />
		</p>
		<p id="form-login-password">
			<label for="modlgn_passwd"><?php echo JText::_('Password') ?></label><br />
			<input id="modlgn_passwd" type="password" name="passwd"
				class="inputbox" size="18" alt="password" />
		</p>
		<?php
		if (JPluginHelper::isEnabled ( 'system', 'remember' )) {
			?>
					<p id="form-login-remember">
			<label for="modlgn_remember"><?php echo JText::_('Remember me') ?></label>
			<input id="modlgn_remember" type="checkbox" name="remember"
				class="inputbox" value="yes" alt="Remember Me" />
		</p>
		<?php
		}
		?>
				<input type="submit" name="Submit" class="button"
			value="<?php echo JText::_('LOGIN') ?>" />
	</fieldset>
	<ul>
		<li><a
			href="<?php echo JRoute::_('index.php?option=com_user&view=reset'); ?>">
				<?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a></li>
		<li><a
			href="<?php echo JRoute::_('index.php?option=com_user&view=remind'); ?>">
				<?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a></li>
			<?php
		$usersConfig = &JComponentHelper::getParams ( 'com_users' );
		
		if ($usersConfig->get ( 'allowUserRegistration' )) {
			?>
					<li><a
			href="<?php echo JRoute::_('index.php?option=com_user&view=register'); ?>">
				<?php echo JText::_('REGISTER'); ?></a></li>
		<?php
		}
		?>
			</ul>
		<?php echo $params->get('posttext'); ?>

			<input type="hidden" name="option" value="com_user" /> <input
		type="hidden" name="task" value="login" /> <input type="hidden"
		name="return" value="<?php echo $return; ?>" />
		<?php echo JHTML::_('form.token'); ?>
		</form>
<?php
	}
}
