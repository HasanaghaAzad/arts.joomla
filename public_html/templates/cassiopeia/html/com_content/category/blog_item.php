<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.beez3
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$params = &$this->item->params;
$images = json_decode($this->item->images);
$app = JFactory::getApplication();
$canEdit = $this->item->params->get('access-edit');

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>
<?php $image=json_decode($this->item->images);
$fullimage=$image->image_intro;
$fullimage_alt=$image->image_intro_alt;
if($image->image_fulltext){
    $fullimage=$image->image_fulltext;
    $fullimage_alt=$image->image_fulltext_alt;
}

$article=$this->item;
 if(!isset($vocab)){


 $vocab=array();
 }
 if(empty($vocab)) {
     $vocab['en-gb']['sizes'] = 'Sizes';
     $vocab['az-az']['sizes'] = 'Ölçülər';
     $vocab['ru-ru']['sizes'] = 'Размеры';
     $lang = strtolower(JFactory::getLanguage()->getTag());

 }
$article->jcfields[4]->title=$vocab[$lang]['sizes'];
?>

<div class="col-md-3 col-sm-6 oneart">
    <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language)); ?>"><img src="/<?=$image->image_intro?>" alt="<?=$image->image_intro_alt?>"></a>
    <p class="art-title"><a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language)); ?>"><?php echo $this->escape($article->title); ?></a></p>

    <p class="gray"><?=$article->jcfields[4]->title;?>: <?=$article->jcfields[4]->value;?></p>
    <p class="black"><?=$article->jcfields[7]->value;?></p>
</div>



