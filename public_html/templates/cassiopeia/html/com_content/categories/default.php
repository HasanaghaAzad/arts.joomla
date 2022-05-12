<?php
/**
 * @package     Joomla.Site
 * @subpackage  Template.beez5
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();
HTMLHelper::addIncludePath(JPATH_COMPONENT.'/helpers');


    $vocab['en-gb']['allartw'] = 'All artworks';
    $vocab['az-az']['allartw'] = 'Bütün əsərlər';
    $vocab['ru-ru']['allartw'] = 'Вся галлерея';
    $lang = strtolower(Factory::getLanguage()->getTag());


?>

<div class="categories-list<?php echo $this->pageclass_sfx;?>">
    <article>
<?php if ($this->params->get('show_page_heading')) : ?>
<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>
<?php if ($this->params->get('show_base_description')) : ?>
	<?php 	//If there is a description in the menu parameters use that; ?>
		<?php if ($this->params->get('categories_description')) : ?>
			<?php echo  HTMLHelper::_('content.prepare', $this->params->get('categories_description'), '', 'com_content.categories'); ?>
		<?php  else: ?>
			<?php //Otherwise get one from the database if it exists. ?>
			<?php  if ($this->parent->description) : ?>
				<div class="category-desc">
					<?php  echo HTMLHelper::_('content.prepare', $this->parent->description, '', 'com_content.categories'); ?>
				</div>
			<?php  endif; ?>
		<?php  endif; ?>
<?php endif; ?>
<?php
echo $this->loadTemplate('items');
?>
    </article>
    <p class="text-center">
        <a class="btn btn-lg btn-primary" href="<?=Uri::current();?>/all-artworks" role="button"><?=$vocab[$lang]['allartw'];?></a>
    </p>
</div>