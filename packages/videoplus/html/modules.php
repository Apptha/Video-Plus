<?php
/**
 * Video Plus theme module file
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

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */

/**
 * Module chrome for rendering the module in a slider
 * 
 * @param   var  $module    module name
 * @param   var  &$params   module parameters
 * @param   var  &$attribs  module attributes
 * 
 * @return  void
 */
function ModChrome_slider($module, &$params, &$attribs)
{
	jimport('joomla.html.pane');

	// Initialize variables
	$sliders = JPane::getInstance('sliders');
	$sliders->startPanel(JText::_($module->title), 'module' . $module->id);
	echo $module->content;
	$sliders->endPanel();
}

/**
 * Module chrome that allows for rounded corners by wrapping in nested div tags
 * 
 * @param   var  $module    module name
 * @param   var  &$params   module parameters
 * @param   var  &$attribs  module attributes
 * 
 * @return  void
 */
function ModChrome_custom($module, &$params, &$attribs)
{
	?>
<div
	class="music_module <?php
	echo $params->get('moduleclass_sfx');
	?>"
	id="Mod<?php
	echo $module->id;
	?>">
	<div>
		<div>
			<div>
					<?php
					if ($module->showtitle != 0)
					{
						if (isset($_COOKIE['Mod' . $module->id]))
						{
							$modhide = $_COOKIE['Mod' . $module->id];
						}
						else
						{
							$modhide = 'show';
						}
						?>
						<h3 class="<?php
						echo $modhide;
						?>">
					<span><?php
						echo $module->title;
						?></span>
				</h3>
					<?php
					}
					?>
					<div class="music_content"><?php echo $module->content; ?></div>
			</div>
		</div>
	</div>
</div>
<?php
}

/**
 * Module chrome that allows for rounded corners by wrapping in nested div tags
 * 
 * @param   var  $module    module name
 * @param   var  &$params   module parameters
 * @param   var  &$attribs  module attributes
 * 
 * @return  void
 */
function ModChrome_right($module, &$params, &$attribs)
{
	if ($module->module == 'mod_contusvideoshare')
	{
		$modId = 'right1';
	}
	elseif ($module->module == 'mod_sidebanner')
	{
		$modId = 'right2';
	}
	else
	{
		$modId = 'rightmodule';
	}

	if ($modId == 'right1' || $modId == 'right2')
	{
	?>
<div id="<?php echo $modId; ?>">
			<?php echo $module->content; ?>
		</div>
<?php
	}
	else
	{
		if($module->module == 'mod_HDVideoShareRelated'){
			$vid = JRequest::getvar('id');
			$video = JRequest::getvar('video');
			if(empty($vid) && empty($video)){
				?>
		<div id="<?php echo $modId;?>">
		<div class="music_module <?php echo $params->get('moduleclass_sfx'); ?>" id="Mod<?php echo $module->id; ?>">
		        <div>
		            <div>
		                <div>
		                    <?php if ($module->showtitle != 0) : ?>
		                    <?php
		                            if (isset($_COOKIE['Mod' . $module->id]))
		                                $modhide = $_COOKIE['Mod' . $module->id];
		                            else
		                                $modhide = 'show';
		                    ?>
		                <h3 class="<?php echo $modhide; ?>"><span><?php echo $module->title; ?></span></h3>
		                <?php endif; ?>
		                <div class="music_content"><?php echo $module->content; ?></div>
		            </div>
		        </div>
		    </div>
		</div>
		</div>
		<?php
		}
		} else {
			?>
<div id="<?php echo $modId; ?>">
	<div
		class="music_module <?php
			echo $params->get('moduleclass_sfx');
			?>"
		id="Mod<?php
			echo $module->id;
			?>">
		<div>
			<div>
				<div>
							<?php
							if ($module->showtitle != 0)
							{
								if (isset($_COOKIE['Mod' . $module->id]))
								{
									$modhide = $_COOKIE['Mod' . $module->id];
								}
								else
								{
									$modhide = 'show';
								}
								?>
								<h3 class="<?php
								echo $modhide;
								?>">
						<span><?php
								echo $module->title;
								?></span>
					</h3>
							<?php
							}
							?>
							<div class="music_content"><?php echo $module->content; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	}
	}
	?>
<?php
}
