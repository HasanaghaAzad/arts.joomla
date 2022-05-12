<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$vocab=array();
$vocab['en-gb']['readmore']='Read more';
$vocab['az-az']['readmore']='Ardını oxu';
$vocab['ru-ru']['readmore']='Подробнее';
$lang=strtolower(Factory::getLanguage()->getTag());
?>
<div class="container-fluid shortabout">


    <?php foreach ($list as $item) : ?>
        <?php $image=json_decode($item->images);?>
    <div class="slider">
        <img src="/<?php echo $image->image_intro;?>" alt="<?php echo $image->image_intro_alt;?>">
        <div class="slider_inner">
            <h3><?php echo $item->title; ?></h3>
            <p><?php echo $item->displayIntrotext; ?></p>


            <a class="btn btn-lg btn-white" href="<?php echo $item->link; ?>" role="button"><?=$vocab[$lang]['readmore'];?></a>
        </div>


    </div>
    <?php endforeach; ?>
</div>


