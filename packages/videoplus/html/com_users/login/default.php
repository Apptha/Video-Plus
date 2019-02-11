<?php
/**
 * View file to display user component view
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

if ($this->user->get ( 'guest' )) {
	// The user is not logged in.
	echo $this->loadTemplate ( 'login' );
} else {
	// The user is already logged in.
	echo $this->loadTemplate ( 'logout' );
}
