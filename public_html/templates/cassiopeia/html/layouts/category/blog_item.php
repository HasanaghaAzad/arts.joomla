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
?>
<div class="col-lg-3 col-md-4 col-sm-6 oneart">
    <a href="/<?=$fullimage;?>" title="<?=$fullimage_alt;?>"><img src="/<?=$image->image_intro;?>" alt="<?=$image->image_intro_alt;?>"></a>
    <p class="art-title"><?php echo $this->escape($this->item->title); ?></p>

</div>





