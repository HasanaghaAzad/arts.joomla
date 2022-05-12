<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;


/** @var JDocumentHtml $this */
$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Color Theme
$paramsColorName = $this->params->get('colorName', 'colors_standard');
$assetColorName  = 'theme.' . $paramsColorName;
$wa->registerAndUseStyle($assetColorName, 'media/templates/site/cassiopeia/css/global/' . $paramsColorName . '.css');


// Use a font scheme if set in the template style options
$paramsFontScheme = $this->params->get('useFontScheme', false);
$fontStyles       = '';

if ($paramsFontScheme)
{
	if (stripos($paramsFontScheme, 'https://') === 0)
	{
		$this->getPreloadManager()->preconnect('https://fonts.googleapis.com/', ['crossorigin' => 'anonymous']);
		$this->getPreloadManager()->preconnect('https://fonts.gstatic.com/', ['crossorigin' => 'anonymous']);
		$this->getPreloadManager()->preload($paramsFontScheme, ['as' => 'style', 'crossorigin' => 'anonymous']);
		$wa->registerAndUseStyle('fontscheme.current', $paramsFontScheme, [], ['media' => 'print', 'rel' => 'lazy-stylesheet', 'onload' => 'this.media=\'all\'', 'crossorigin' => 'anonymous']);

		if (preg_match_all('/family=([^?:]*):/i', $paramsFontScheme, $matches) > 0)
		{
			$fontStyles = '--cassiopeia-font-family-body: "' . str_replace('+', ' ', $matches[1][0]) . '", sans-serif;
			--cassiopeia-font-family-headings: "' . str_replace('+', ' ', isset($matches[1][1]) ? $matches[1][1] : $matches[1][0]) . '", sans-serif;
			--cassiopeia-font-weight-normal: 400;
			--cassiopeia-font-weight-headings: 700;';
		}
	}
	else
	{
		$wa->registerAndUseStyle('fontscheme.current', $paramsFontScheme, ['version' => 'auto'], ['media' => 'print', 'rel' => 'lazy-stylesheet', 'onload' => 'this.media=\'all\'']);
		$this->getPreloadManager()->preload($wa->getAsset('style', 'fontscheme.current')->getUri() . '?' . $this->getMediaVersion(), ['as' => 'style']);
	}
}

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

// Container
$wrapper = $this->params->get('fluidContainer') ? 'wrapper-fluid' : 'wrapper-static';

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

$stickyHeader = $this->params->get('stickyHeader') ? 'position-sticky sticky-top' : '';

$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');


$js=[];


//SOME JS SETTINGS FROM OLD TEMPLATE PROTOSTAR

$js[]='bootstrap.min';
// Add html5 shiv
HTMLHelper::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));
unset($app->_scripts);
unset($app->_script);
unset($this->_scripts);
unset($this->_script);
unset($this->_scripts[Uri::root(true).'/media/jui/js/bootstrap.min.js']);



// Add Stylesheets
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="site <?php echo $option
	. ' ' . $wrapper
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($pageclass ? ' ' . $pageclass : '')
	. $hasClass
	. ($this->direction == 'rtl' ? ' rtl' : '');
?>">
<div id="page">
	<!-- Body -->
    <header>

        <nav class="navbar navbar-dark navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only"><?php echo TEXT::_('TPL_PROTOSTAR_TOGGLE_MENU'); ?></span>
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
    <jdoc:include type="modules" name="position-0" style="none" />


    <?php



    if (!$menu->home) {
      ?>

        <div class="white">
            <div class="container">

                <jdoc:include type="modules" name="position-2" style="none" />
                <jdoc:include type="component" />
            </div>
		</div>



    <?php
    }

    ?>
    <footer>
        <div class="container text-center"><div class="col-md-6 text-left">  
                <jdoc:include type="modules" name="footer" style="none" />
            </div>
                <div class="col-md-6 text-right">
                    <jdoc:include type="modules" name="position-7" style="none" />
                    <ul>
                        <li><a href="https://www.facebook.com/azeriarts"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                         
                        <li><a href="https://www.pinterest.com/arts_gallery/"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul></div>



        </div>
    </footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<?php
foreach ($js as $name){
    print '<script src="/templates/cassiopeia/js/'.$name.'.js"></script>'."\n";
}
?>
<?php if ($this->params->get('backTop') == 1) : ?>
		<a href="#top" id="back-top" class="back-to-top-link" aria-label="<?php echo Text::_('TPL_CASSIOPEIA_BACKTOTOP'); ?>">
			<span class="icon-arrow-up icon-fw" aria-hidden="true"></span>
		</a>
	<?php endif; ?>

<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>