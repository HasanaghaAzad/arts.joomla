<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$class = ' class="first"';
if ($this->maxLevelcat != 0 && count($this->items[$this->parent->id]) > 0) :
?>
<div class="row" id="links">
<?php foreach ($this->items[$this->parent->id] as $id => $item) : ?>
	<?php
	if ($item->numitems || $this->params->get('show_empty_categories_cat') || count($item->getChildren())) :
	if (!isset($this->items[$this->parent->id][$id + 1]))
	{
		$class = ' class="last"';
	}

	?>
<?php $image=json_decode($item->params);?>
        <div class="col-lg-6 col-md-6 col-sm-6 oneart">
            <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id));?>"><img src="/<?=$image->image;?>" alt="<?=$image->image;?>"></a>
            <p class="art-title"><a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id));?>"><?php echo $this->escape($item->title); ?></a></p>

        </div>

	<?php endif; ?>
<?php endforeach; ?>
</div>
<?php endif; ?>
