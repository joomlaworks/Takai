<?php
/**
 * @version		1.0.0
 * @package		GetK2Demo
 * @author		Nuevvo - http://nuevvo.com
 * @copyright Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license		http://nuevvo.com/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/*
Important note:
If you wish to use the live search option, it's important that you maintain the same class names for wrapping elements, e.g. the wrapping div and form.
*/

?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2SearchBlock <?php if($params->get('liveSearch')) { echo ' k2LiveSearchBlock';}?>">
	<form action="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&task=search'); ?>" method="get" class="k2SearchBlockForm">

		<input type="text" value="<?php echo $text; ?>" name="searchword" maxlength="<?php echo $maxlength; ?>" size="<?php echo $width; ?>" onfocus="if(this.value=='<?php echo $text; ?>') this.value='';" />

		<?php if($button): ?>
		<?php if($imagebutton): ?>
		<input type="image" value="<?php echo $button_text; ?>" class="button" onclick="this.form.searchword.focus();" src="<?php echo JURI::base(true); ?>/components/com_k2/images/fugue/search.png" />
		<?php else: ?>
		<input type="submit" value="<?php echo $button_text; ?>" class="button" onclick="this.form.searchword.focus();" />
		<?php endif;?>
		<?php endif; ?>

		<input type="hidden" name="categories" value="<?php echo $categoryFilter; ?>" />
		<?php if(!$app->getCfg('sef')): ?>
		<input type="hidden" name="option" value="com_k2" />
		<input type="hidden" name="view" value="itemlist" />
		<input type="hidden" name="task" value="search" />
		<?php endif; ?>
		<?php if($params->get('liveSearch')): ?>
		<input type="hidden" name="format" value="html" />
		<input type="hidden" name="t" value="" />
		<input type="hidden" name="tpl" value="search" />
		<?php endif; ?>
	</form>

	<?php if($params->get('liveSearch')): ?>
	<div class="k2LiveSearchResults"></div>
	<?php endif; ?>
</div>
