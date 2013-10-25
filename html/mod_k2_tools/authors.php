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

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2AuthorsListBlock">
  <ul>
    <?php foreach ($authors as $key=>$author): ?>
	    <li class="<?php echo ($key%2) ? "odd" : "even"; if(count($authors)==$key+1) echo ' lastItem'; ?>" >
	  	      <?php if ($params->get('authorAvatar')):?>
		      <a class="k2Avatar abAuthorAvatar" rel="author" href="<?php echo $author->link; ?>" title="<?php echo $author->name; ?>">
		      	<img src="<?php echo $author->avatar; ?>" alt="<?php echo $author->name; ?>" style="width:<?php echo $avatarWidth; ?>px;height:auto;" />
		      </a>
		      <?php endif; ?>

		      <a class="abAuthorName Istok" rel="author" href="<?php echo $author->link; ?>">
		      	<?php echo $author->name; ?>
				<br />
		      	<?php if ($params->get('authorItemsCounter')):?>
		      		<span><?php echo $author->items; ?> articles</span>
		      	<?php endif; ?>
		      </a>

			<?php if ($params->get('authorLatestItem')):?>
			<h4 class="hAuthorLatestItem">
				<a class="abAuthorLatestItem" href="<?php echo $author->latest->link; ?>" title="<?php echo $author->latest->title; ?>">
					<?php echo $author->latest->title; ?>
				</a>
			</h4>
			<a class="abAuthorLatestItem Istok" href="<?php echo $author->latest->link; ?>" title="<?php echo $author->latest->title; ?>">
				<span class="abAuthorCommentsCount">
				  	<strong><?php echo $author->latest->numOfComments; ?> <?php echo JText::_('K2_COMMENTS'); ?></strong>
				</span>
			</a>
	      <?php endif; ?>
	    </li>
    <?php endforeach; ?>
  </ul>
</div>
