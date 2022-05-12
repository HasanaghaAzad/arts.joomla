<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$vocab=array();
$vocab['en-gb']['seeall']='See all';
$vocab['az-az']['seeall']='Hamısına bax';
$vocab['ru-ru']['seeall']='Посмотреть все';
$vocab['en-gb']['gallery_link']='/artworks';
$vocab['az-az']['gallery_link']='/az/artworks';
$vocab['ru-ru']['gallery_link']='/ru/artworks';
$lang=strtolower(JFactory::getLanguage()->getTag());
?>
<?php JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

//$jcFields = FieldsHelper::getFields($context = 'com_content.article', $item = null, $prepareValue = false, null);

$model = JModelLegacy::getInstance('Field', 'FieldsModel', array('ignore_request' => true));
//print_r($model);

/*
$fieldsp = FieldsHelper::getFields('com_content.article','11',true);
print_r($fieldsp);
$fields=array();
foreach ($fieldsp as $field){
    $fields[$field->name]=array('name'=>$field->name,'id'=>$field->id,'title'=>$field->title);
}
*/

$sizesid=4;
//$sizestitle=$fields['sizes']['title'];
if($lang=='en-gb'){$sizestitle='Sizes';}
if($lang=='az-az'){$sizestitle='Olçülər';}
if($lang=='ru-ru'){$sizestitle='Размеры';}
$priceid=7;

//$currentCatFields = $model->getFieldValues(array($sizesid), 9);


?>
<section class="white container-fluid">
    <div class="container text-center">
        <h2><?=$module->title;?></h2>
        <div class="row">
            <?php foreach ($list as $item) :

            $id=$item->id;
                ?>

                <?php $image=json_decode($item->images);?>
                <div class="col-md-3 col-sm-6 oneart">
                    <a href="<?php echo $item->link; ?>"> <img src="/<?php echo $image->image_intro;?>" alt="<?php echo $image->image_intro_alt;?>"></a>
                    <p class="art-title"><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></p>
                    <p class="gray"><?=$item->category_title;?></p>
                     <?php
                     /*
                    $sizes=$model->getFieldValues(array($sizesid), $id)[$sizesid];
                    if($sizes){
                        print '<p class="gray">'.$sizestitle.' : '.$sizes.'</p>';
                    }
                   
                    <p class="black"><?=$model->getFieldValues(array($priceid), $id)[$priceid];?></p>
                     */
                    ?>
                </div>
            <?php endforeach; ?>

        </div>
        <p>
            <a class="btn btn-lg btn-primary" href="<?=$vocab[$lang]['gallery_link'];?>" role="button"><?=$vocab[$lang]['seeall'];?></a>
        </p>
    </div>
</section>
