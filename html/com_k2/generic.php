<?php
/**
 * @version		1.0.0
* @package		Takai
 * @author		Nuevvo - http://nuevvo.com
 * @copyright Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license		http://nuevvo.com/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div id="k2Container" class="genericView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title') || JRequest::getCmd('task')=='search' || JRequest::getCmd('task')=='date'): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('custom_page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if(JRequest::getCmd('task')=='search' && $this->params->get('googleSearch')): ?>
	<!-- Google Search container -->
	<div id="<?php echo $this->params->get('googleSearchContainer'); ?>"></div>
	<?php endif; ?>

	<?php if(count($this->items) && $this->params->get('genericFeedIcon',1)): ?>
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(count($this->items)): ?>
	<section class="genericItemList">
		<?php foreach($this->items as $item): ?>

		<article class="itemBlock">

			<?php if($item->params->get('genericItemDateCreated')): ?>
			<span class="itemDate Istok">
				<?php echo JHTML::_('date', $item->created , JText::_('K2_DATE_FORMAT_LC2')); ?>
			</span>
			<?php endif; ?>

			<?php if($item->params->get('genericItemTitle')): ?>
			<h3 class="itemTitle">
				<?php if ($item->params->get('genericItemTitleLinked')): ?>
				<a href="<?php echo $item->link; ?>">
					<?php echo $item->title; ?>
				</a>
				<?php else: ?>
				<?php echo $item->title; ?>
				<?php endif; ?>
			</h3>
			<?php endif; ?>

			<?php if($item->params->get('genericItemCategory')): ?>
				<div class="itemCategory Istok">
					<span><?php echo JText::_('K2_IN'); ?></span>
					<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
				</div>
			<?php endif; ?>

			<?php if($item->params->get('genericItemImage') && !empty($item->imageGeneric)): ?>
			  <div class="itemImage">
			    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
			    	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" />
			    </a>
			  </div>
			<?php endif; ?>

			<?php if($item->params->get('genericItemIntroText')): ?>
			<div class="itemIntroText">
				<?php echo $item->introtext; ?>
			</div>
			<?php endif; ?>

			<?php if ($item->params->get('genericItemReadMore')): ?>
				<a class="itemMore Istok" href="<?php echo $item->link; ?>">
					<span><?php echo JText::_('K2_READ_MORE'); ?></span>
				</a>
			<?php endif; ?>


			<div class="clr"></div>

			<?php if($item->params->get('genericItemExtraFields') && count($item->extra_fields)): ?>
			<div class="itemExtraFields">
				<h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
				<ul>
				<?php foreach ($item->extra_fields as $key=>$extraField): ?>
				<?php if($extraField->value): ?>
				<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
					<span class="itemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
					<span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
				</li>
				<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>


			<div class="clr"></div>
		</article>

		<?php endforeach; ?>
	</section>

	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<div class="clr"></div>
	</div>
	<?php echo $this->pagination->getPagesCounter(); ?>

	<?php endif; ?>

	<?php else: ?>

	<?php if(!$this->params->get('googleSearch')): ?>
	<!-- No results found -->
	<div id="genericItemListNothingFound">
		<p><?php echo JText::_('K2_NO_RESULTS_FOUND'); ?></p>
	</div>
	<?php endif; ?>

	<?php endif ;?>
</div>