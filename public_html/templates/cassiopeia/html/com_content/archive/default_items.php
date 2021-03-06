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
use Joomla\CMS\Helper\RouteHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();
$templateparams = $app->getTemplate(true)->params;

if (!$templateparams->get('html5', 0))
{
	require JPATH_BASE.'/components/com_content/views/archive/tmpl/default_items.php';
	//evtl. ersetzen durch JPATH_COMPONENT.'/views/...'
} else {
HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers');
$params = &$this->params;
?>
<ul id="archive-items">
<?php foreach ($this->items as $i => $item) : ?>
	<li class="row<?php echo $i % 2; ?>">

		<h2>
		<?php if ($params->get('link_titles')) : ?>
			<a href="<?php echo RouteHelper::getArticleRoute($item->slug, $item->catid, $item->language); ?>">
				<?php echo $this->escape($item->title); ?></a>
		<?php else: ?>
				<?php echo $this->escape($item->title); ?>
		<?php endif; ?>
		</h2>


<?php if ($params->get('show_author') or $params->get('show_parent_category') or $params->get('show_category') or $params->get('show_create_date') or $params->get('show_modify_date') or $params->get('show_publish_date') or $params->get('show_hits')) : ?>
 <dl class="article-info">
 <dt class="article-info-term"><?php echo Text::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>
<?php if ($params->get('show_parent_category')) : ?>
		<dd class="parent-category-name">
			<?php	$title = $this->escape($item->parent_title);
					$url = '<a href="'.RouteHelper::getCategoryRoute($item->parent_slug).'">'.$title.'</a>';?>
			<?php if ($item->parent_slug && $params->get('link_parent_category')) : ?>
				<?php echo Text::sprintf('COM_CONTENT_PARENT', $url); ?>
				<?php else : ?>
				<?php echo Text::sprintf('COM_CONTENT_PARENT', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>

<?php if ($params->get('show_category')) : ?>
		<dd class="category-name">
			<?php	$title = $this->escape($item->category_title);
					$url = '<a href="' .  RouteHelper::getCategoryRoute($item->catslug) . '">' . $title . '</a>'; ?>
			<?php if ($item->catslug && $params->get('link_category')) : ?>
				<?php echo Text::sprintf('COM_CONTENT_CATEGORY', $url); ?>
				<?php else : ?>
				<?php echo Text::sprintf('COM_CONTENT_CATEGORY', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_create_date')) : ?>
		<dd class="create">
		<?php echo Text::sprintf('COM_CONTENT_CREATED_DATE_ON', HTMLHelper::_('date', $item->created, Text::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
		<dd class="modified">
		<?php echo Text::sprintf('COM_CONTENT_LAST_UPDATED', HTMLHelper::_('date', $item->modified, Text::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_publish_date')) : ?>
		<dd class="published">
		<?php echo Text::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', HTMLHelper::_('date', $item->publish_up, Text::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if (!empty($item->author) && $params->get('show_author')) : ?>
	<dd class="createdby">
		<?php $author = $item->created_by_alias ?: $item->author; ?>
			<?php if (!empty($item->contact_link ) &&  $params->get('link_author') == true):?>
				<?php echo Text::sprintf('COM_CONTENT_WRITTEN_BY', HTMLHelper::_('link', $item->contact_link, $author)); ?>
			<?php else :?>
				<?php echo Text::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
			<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_hits')) : ?>
		<dd class="hits">
		<?php echo Text::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_author') or $params->get('show_category') or $params->get('show_create_date') or $params->get('show_modify_date') or $params->get('show_publish_date') or $params->get('show_hits')) :?>
	 </dl>
<?php endif; ?>

<?php  if ($params->get('show_intro')) :?>
		<div class="intro">
			<?php echo HTMLHelper::_('string.truncate', $item->introtext, $params->get('introtext_limit')); ?>
		</div>

		<?php endif; ?>
	</li>
<?php endforeach; ?>
</ul>
<div id="pagination">
	<span><?php echo $this->pagination->getPagesLinks(); ?></span>
	<span><?php echo $this->pagination->getPagesCounter(); ?></span>
</div>
<?php } ?>
