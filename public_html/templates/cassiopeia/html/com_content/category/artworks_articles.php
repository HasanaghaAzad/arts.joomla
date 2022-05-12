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
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;

$app = Factory::getApplication();

HTMLHelper::addIncludePath(JPATH_COMPONENT.'/helpers/html');

$params    = &$this->item->params;
$n         = count($this->items);
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

// Check for at least one editable article
$isEditable = false;

$vocab=array();
$vocab['en-gb']['sizes']='Sizes';
$vocab['az-az']['sizes']='Ölçülər';
$vocab['ru-ru']['sizes']='Размеры';
$lang=strtolower(Factory::getLanguage()->getTag());

if (!empty($this->items))
{
	foreach ($this->items as $article)
	{
		if ($article->params->get('access-edit'))
		{
			$isEditable = true;
			break;
		}
	}
}

?>


			<?php foreach ($this->items as $i => &$article) :

    $article->jcfields[4]->title=$vocab[$lang]['sizes'];
                ?>
                <?php $image=json_decode($article->images);

                ?>
                <div class="col-md-3 col-sm-6 oneart">
                    <a href="<?php echo  RouteHelper::getArticleRoute($article->slug, $article->catid, $article->language); ?>"><img src="/<?=$image->image_intro?>" alt="<?=$image->image_intro_alt?>"></a>
                    <p class="art-title"><a href="<?php echo Route::_(RouteHelper::getArticleRoute($article->slug, $article->catid, $article->language)); ?>"><?php echo $this->escape($article->title); ?></a></p>

                   	<?php
                    if($article->jcfields[4]->value){
                        print '<p class="gray">'.$article->jcfields[4]->title.' : '.$article->jcfields[4]->value.'</p>';
                    }
                    ?>
                    <p class="black"><?=$article->jcfields[7]->value;?></p>
                </div>


			<?php endforeach; ?>

<?php // Add pagination links ?>
<?php if (!empty($this->items)) : ?>
	<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			 <p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php  endif; ?>

		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>


<?php endif; ?>