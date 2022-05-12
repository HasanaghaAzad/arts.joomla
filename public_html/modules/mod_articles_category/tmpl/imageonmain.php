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
$vocab['en-gb']['gallery']='Artworks';
$vocab['az-az']['gallery']='Əsərlər';
$vocab['ru-ru']['gallery']='Галерея';
$vocab['en-gb']['gallery_link']='/artworks';
$vocab['az-az']['gallery_link']='/az/artworks-az';
$vocab['ru-ru']['gallery_link']='/ru/artworks-ru';

$lang=strtolower(Factory::getLanguage()->getTag());
?>
<div class="container-fluid">

    <?php foreach ($list as $item) : ?>
        <?php $image=json_decode($item->images);?>
    <div class="slider">
        <img src="/<?php echo $image->image_intro;?>" alt="<?php echo$image->image_intro_alt;?>">
        <div class="slider_inner">
            <h1><?php echo $item->title; ?></h1>
            <p><?php echo $item->displayIntrotext;?></p>

            <a class="btn btn-lg btn-primary" href="<?=$vocab[$lang]['gallery_link'];?>" role="button"><?=$vocab[$lang]['gallery'];?></a>
        </div>


    </div>
    <?php endforeach; ?>
</div>
