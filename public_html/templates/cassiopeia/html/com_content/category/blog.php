<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.beez3
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Component\ComponentHelper;

$app = Factory::getApplication();
$templateparams = $app->getTemplate(true)->params;

HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers');

$cparams = ComponentHelper::getParams('com_media');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space

?>
<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
    <div class="row" id="links">


	<?php foreach ($this->lead_items as &$item) : ?>

			<?php


				$this->item = &$item;
				echo $this->loadTemplate('item');
			?>

		<?php $leadingcount++; ?>
	<?php endforeach; ?>

    </div>
<?php if ($this->pagination->pagesTotal > 1 && ($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)) : ?>
	<div class="pagination">
	<?php if ($this->params->def('show_pagination_results', 1)) : ?>
		<p class="counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
	<?php endif; ?>
	<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>

</section>
