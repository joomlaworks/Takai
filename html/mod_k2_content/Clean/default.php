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

<?php if($params->get('feed')): ?>
	<div class="k2FeedIcon">
		<a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&format=feed&moduleID='.$module->id);?>" title="<?php echo JText::_('Subscribe to this RSS feed'); ?>">
			<span><?php echo JText::_('Subscribe to this RSS feed'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2ItemsBlock">

	<?php if($params->get('itemPreText')): ?>
	<p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
	<?php endif; ?>

  <ul>
    <?php foreach ($items as $key=>$item):	?>
    <li class="<?php echo ($key%2) ? "odd" : "even"; ?>">

      <!-- Plugins: BeforeDisplay -->
      <?php echo $item->event->BeforeDisplay; ?>

      <!-- K2 Plugins: K2BeforeDisplay -->
      <?php echo $item->event->K2BeforeDisplay; ?>

      <?php if($params->get('itemTitle')): ?>
      <a class="moduleItemTitle" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
      <?php endif; ?>


      <!-- Plugins: AfterDisplayTitle -->
      <?php echo $item->event->AfterDisplayTitle; ?>

      <!-- K2 Plugins: K2AfterDisplayTitle -->
      <?php echo $item->event->K2AfterDisplayTitle; ?>

      <!-- Plugins: BeforeDisplayContent -->
      <?php echo $item->event->BeforeDisplayContent; ?>

      <!-- K2 Plugins: K2BeforeDisplayContent -->
      <?php echo $item->event->K2BeforeDisplayContent; ?>

      <?php if($params->get('itemImage') || $params->get('itemIntroText')): ?>
      <p class="moduleItemIntrotext">

	      <?php if($params->get('itemImage') && isset($item->image)): ?>
	      <a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('Continue reading'); ?> &quot;<?php echo htmlentities($item->title, ENT_QUOTES, 'UTF-8'); ?>&quot;">
	      	<img src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>"/>
	      </a>
	      <?php endif; ?>

      	<?php if($params->get('itemIntroText')): ?>
      	<?php echo $item->introtext; ?>
      	<?php endif; ?>

      	<?php if($params->get('itemReadMore')): ?>
			<a class="moduleItemReadMore" href="<?php echo $item->link; ?>">
				<?php echo JText::_('Read more...'); ?>
			</a>
		<?php endif; ?>

      	<span class="clr"></span>

      </p>
      <?php endif; ?>

      <?php if($params->get('itemAuthorAvatar')): ?>
      	<p class="moduleItemAuthorAvatarAndName">
			<img class="moduleItemAuthorAvatar" src="<?php echo $item->authorAvatar; ?>" alt="<?php echo $item->author; ?>" />
			<?php if($params->get('itemAuthor')): ?>
			<span class="moduleItemAuthorDetails">
			<?php // echo K2HelperUtilities::writtenBy($item->authorGender); ?>

			<?php if(isset($item->authorLink)): ?>
			<a class="moduleItemAuthorLink" href="<?php echo $item->authorLink; ?>">- <?php echo $item->author; ?></a>
			<?php else: ?>
				<?php echo $item->author; ?>
			<?php endif; ?>
			</span>
			<?php endif; ?>
		</p>
	  <?php else:?>

		  <?php if($params->get('itemAuthor')): ?>
	      <?php echo K2HelperUtilities::writtenBy($item->authorGender); ?>

				<?php if(isset($item->authorLink)): ?>
				<a class="moduleItemAuthorLink" href="<?php echo $item->authorLink; ?>"><?php echo $item->author; ?></a>
				<?php else: ?>
					<?php echo $item->author; ?>
				<?php endif; ?>
		  <?php endif; ?>

      <?php endif; ?>



      <?php if($params->get('itemExtraFields') && count($item->extra_fields)): ?>
      <b><?php echo JText::_('Additional Info'); ?></b>
      <ul class="moduleItemExtraFields">
        <?php foreach ($item->extra_fields as $extraField): ?>
				<li class="type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
					<span class="moduleItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
					<span class="moduleItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
					<br class="clr" />
				</li>
        <?php endforeach; ?>
      </ul>
      <div class="clr"></div>
      <?php endif; ?>



      <?php if($params->get('itemVideo')): ?>
      <p class="moduleItemVideo">
      	<?php echo $item->video ;?>
      	<br class="clr" />
      	<span class="moduleItemVideoCaption"><?php echo $item->video_caption ;?></span>
      	<span class="moduleItemVideoCredits"><?php echo $item->video_credits ;?></span>
      	<br class="clr" />
      </p>
      <div class="clr"></div>
      <?php endif; ?>


      <!-- Plugins: AfterDisplayContent -->
      <?php echo $item->event->AfterDisplayContent; ?>

      <!-- K2 Plugins: K2AfterDisplayContent -->
      <?php echo $item->event->K2AfterDisplayContent; ?>

      <?php if($params->get('itemDateCreated')): ?>
      <span class="moduleItemDateCreated"><?php echo JText::_('Written_on') ;?> <?php echo JHTML::_('date', $item->created, JText::_('DATE_FORMAT_TEMPLATE')); ?></span>
      <?php endif; ?>

      <?php if($params->get('itemCategory')): ?>
      <span class="moduleItemCategory">
      <?php echo JText::_('in') ;?> <a href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryname; ?></a></span>
      <?php endif; ?>


      <?php if($params->get('itemTags') && count($item->tags)>0): ?>
      <span class="moduleItemTags">
      	<b><?php echo JText::_('Tags'); ?>:</b>
        <?php foreach ($item->tags as $key=>$tag): ?>
        <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a><?php if (($key+1)<(count($item->tags)))echo ', '; ?>
        <?php endforeach; ?>
      </span>
      <?php endif; ?>

      <?php if($params->get('itemAttachments') && count($item->attachments)): ?>
	  <p class="moduleAttachements">
	  <?php foreach ($item->attachments as $attachment): ?>
		<a title="<?php echo $attachment->titleAttribute; ?>" href="<?php echo JRoute::_('index.php?option=com_k2&view=item&task=download&id='.$attachment->id); ?>">
			<?php echo $attachment->title ; ?>
		</a>
	  <?php endforeach;?>
	  </p>
      <?php endif; ?>

			<?php if($params->get('itemCommentsCounter') && $componentParams->get('comments')): ?>

				<?php if($item->numOfComments>0): ?>
				<a class="moduleItemComments" href="<?php echo $item->link.'#itemCommentsAnchor'; ?>">
					[<?php echo $item->numOfComments; ?> <?php if($item->numOfComments>1) echo JText::_('comments'); else echo JText::_('comment'); ?>]
				</a>
				<?php else: ?>
				<a class="moduleItemComments" href="<?php echo $item->link.'#itemCommentsAnchor'; ?>">
					[<?php echo JText::_('Be the first to comment!'); ?>]
				</a>
				<?php endif; ?>
			<?php endif; ?>

			<?php if($params->get('itemHits')): ?>
			<span class="moduleItemHits">
				<?php echo JText::_('Read'); ?> <?php echo $item->hits; ?> <?php echo JText::_('times'); ?>
			</span>
			<?php endif; ?>


      <!-- Plugins: AfterDisplay -->
      <?php echo $item->event->AfterDisplay; ?>

      <!-- K2 Plugins: K2AfterDisplay -->
      <?php echo $item->event->K2AfterDisplay; ?>

    </li>
    <?php endforeach; ?>
  </ul>

	<?php if($params->get('itemCustomLink')): ?>
	<a class="moduleCustomLink" href="<?php echo $params->get('itemCustomLinkURL'); ?>" title="<?php echo htmlentities($params->get('itemCustomLinkTitle'), ENT_QUOTES, 'UTF-8'); ?>">
		<?php echo $params->get('itemCustomLinkTitle'); ?>
	</a>
	<?php endif; ?>



</div>