<?php
/**
 * Module to display breadcrumb
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
	$moduleclass_sfx = $moduleclass_sfx;
} elseif (version_compare ( JVERSION, '1.6.0', 'ge' )) {
	$moduleclass_sfx = $moduleclass_sfx;
} else {
	$moduleclass_sfx = '';
}
?>

<div class="breadcrumbs<?php echo $moduleclass_sfx; ?>">
	<?php
	for($i = 0; $i < $count; $i ++) {
		// If not the last item in the breadcrumbs add the separator
		if ($i < $count - 1) {
			if (! empty ( $list [$i]->link )) {
				echo '<a href="' . $list [$i]->link . '" class="pathway">' . $list [$i]->name . '</a>';
			} else {
				echo '<span>';
				echo $list [$i]->name;
				echo '</span>';
			}
			
			if ($i < $count - 2) {
				echo ' ' . $separator . ' ';
			}
		} elseif ($params->get ( 'showLast', 1 )) {
			// When $i == $count -1 and 'showLast' is true
			if ($i > 0) {
				echo ' ' . $separator . ' ';
			}
			
			echo '<span>';
			echo $list [$i]->name;
			echo '</span>';
		}
	}
	?>
</div>
