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

$app            = Factory::getApplication();
$templateparams = $app->getTemplate(true)->params;
$app->getDocument(true)->title=$this->category->title.' - '.$app->getDocument(true)->title;

HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers');

$showCategoryTitle            = $this->params->get('show_category_title') == 1;
$showCategoryHeadingTitleText = $this->params->get('show_category_heading_title_text', 1) == 1;
$pageSubHeading               = $this->params->get('page_subheading');
?>

<article>
    <h1><?php echo $this->category->title; ?></h1>
<div><?php echo $this->category->description; ?></div>

    <div class="row" id="links">
        <?php echo $this->loadTemplate('articles'); ?>
	</div>
    </article>