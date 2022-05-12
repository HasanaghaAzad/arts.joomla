<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentError $this */
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();


$this->setHtml5(true);

// Getting params from template
// $params = $app->getTemplate(true)->params;
$params=$this->params;
// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
 $menu     = $app->getMenu()->getActive()->getParams(); 
if ($task === 'edit' || $layout === 'form')
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
//JHtml::_('bootstrap.framework');

// Logo file or site title param
if ($params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}

// Use a font scheme if set in the template style options
$paramsFontScheme = $this->params->get('useFontScheme', false);
$fontStyles       = '';

 
 

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . htmlspecialchars(Uri::root() . $this->params->get('logoFile'), ENT_QUOTES, 'UTF-8') . '" alt="' . $sitename . '">';
}
elseif ($this->params->get('siteTitle'))
{
	$logo = '<span title="' . $sitename . '">' . htmlspecialchars($this->params->get('siteTitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = HTMLHelper::_('image', 'logo.svg', $sitename, ['class' => 'logo d-inline-block'], true, 0);
}

// Container
$wrapper = $this->params->get('fluidContainer') ? 'wrapper-fluid' : 'wrapper-static';
 
// Enable assets
$wa->usePreset('template.cassiopeia.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr'))
	->useStyle('template.active.language')
	->useStyle('template.user')
	->useScript('template.user')
	->addInlineStyle(":root {
		--hue: 214;
		--template-bg-light: #f0f4fb;
		--template-text-dark: #495057;
		--template-text-light: #ffffff;
		--template-link-color: #2a69b8;
		--template-special-color: #001B4C;
		$fontStyles
	}");

// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.cassiopeia.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);


// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . Uri::root(true) . '/' . htmlspecialchars($this->params->get('logoFile'), ENT_QUOTES) . '" alt="' . $sitename . '">';
}
elseif ($this->params->get('siteTitle'))
{
	$logo = '<span title="' . $sitename . '">' . htmlspecialchars($this->params->get('siteTitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = HTMLHelper::_('image', 'logo.svg', $sitename, ['class' => 'logo d-inline-block'], true, 0);
}

$hasClass = '';

if ($this->countModules('sidebar-left', true))
{
	$hasClass .= ' has-sidebar-left';
}

if ($this->countModules('sidebar-right', true))
{
	$hasClass .= ' has-sidebar-right';
}

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

$stickyHeader = $this->params->get('stickyHeader') ? 'position-sticky sticky-top' : '';

$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');

HTMLHelper::_('stylesheet', 'bootstrap.min.css', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'font-awesome.min.css', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'style.css', array('version' => 'auto', 'relative' => true));
if (!$menu->home) {
    HTMLHelper::_('stylesheet', 'inner.css', array('version' => 'auto', 'relative' => true));

}


$photoslinks=array($this->baseurl.'en/photos',$this->baseurl.'az/photos',$this->baseurl.'ru/photos');
if(in_array(Uri::current(),$photoslinks)){
    HTMLHelper::_('stylesheet', 'blueimp-gallery.min.css', array('version' => 'auto', 'relative' => true));

    $js[]='blueimp-gallery.min';
    $js[]='inphotos';
}
// Use of Google Font
if ($this->params->get('googleFont'))
{
	HTMLHelper::_('stylesheet', '//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
	$this->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
	$this->addStyleDeclaration('
	body.site {
		 
		background-color: ' . $this->params->get('templateBackgroundColor') . ';
	}
	a {
		color: ' . $this->params->get('templateColor') . ';
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: ' . $this->params->get('templateColor') . ';
	}');
}




// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . Uri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}


$lang=strtolower(Factory::getLanguage()->getTag());
if($lang=='en-gb'){$brandname='Mir Nadir Zeynalov';}
if($lang=='az-az'){$brandname='Mir Nadir Zeynalov';}
if($lang=='ru-ru'){$brandname='Мир Надир Зейлналов';}
$brandname='ART<span class="text-danger">S</span> Joomla';
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
	
	
 
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">
	<!-- Body -->
	<div class="body">

	
	<header>

<nav class="navbar navbar-dark navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
				<span class="sr-only"><?php echo JTEXT::_('TPL_PROTOSTAR_TOGGLE_MENU'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">
				 <?=$brandname;?>
			</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<div class="row">
			<ul class="nav navbar-nav navbar-right">
				<li class="lang"><?=(($lang=='az-az')?'<b>AZ</b>':'<a href="/az">AZ</a>');?></li>
				<li class="lang"><?=(($lang=='en-gb')?'<b>EN</b>':'<a href="/en">EN</a>');?></li>
				<li class="lang"><?=(($lang=='ru-ru')?'<b>RU</b>':'<a href="/ru">RU</a>');?></li>
			</ul>
		</div>
		
		<div class="row">
			<jdoc:include type="modules" name="position-1" style="none" />
		</div>
		</div>
	</div>
</nav>
</header>



		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<!-- Header -->
			 
 
			<div class="row-fluid">
				<div id="content" class="span12">
					<!-- Begin Content -->
					<h1 class="page-header"><?php echo Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<p><strong><?php echo Text::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
								<p><?php echo Text::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
								<ul>
									<li><?php echo Text::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
									<li><?php echo Text::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
									<li><?php echo Text::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
									<li><?php echo Text::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
								</ul>
							</div>
							<div class="span6">
								<?php if (JModuleHelper::getModule('search')) : ?>
									<p><strong><?php echo Text::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
									<p><?php echo Text::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
									<?php echo $this->getBuffer('module', 'search'); ?>
								<?php endif; ?>
								<p><?php echo Text::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
								<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home" aria-hidden="true"></span> <?php echo Text::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
							</div>
						</div>
						<hr />
						<p><?php echo Text::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
						<blockquote>
							<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
						 
						</blockquote>
						 
					</div>
					<!-- End Content -->
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<div class="footer">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<hr />
			<?php if ($this->params->get('backTop') == 1) : ?>
		<a href="#top" id="back-top" class="back-to-top-link" aria-label="<?php echo Text::_('TPL_CASSIOPEIA_BACKTOTOP'); ?>">
			<span class="icon-arrow-up icon-fw" aria-hidden="true"></span>
		</a>
	<?php endif; ?>
			<p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			</p>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>