<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ostrainingbreeze
 *
 * @copyright   Copyright (C) 2009, 2013 OSTraining.com
 * @license     GNU General Public License version 2 or later; see license.txt
 */

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

// Adjusting main content width
if ($this->countModules('left') && $this->countModules('right'))
{
    $span_component = "span6";
}
elseif ($this->countModules('left') && !$this->countModules('right'))
{
    $span_component = "span9";
}
elseif (!$this->countModules('left') && $this->countModules('right'))
{
    $span_component = "span9";
}
else
{
    $span_component = "span12";
}

// Adjusting bottom width
if ($this->countModules('bottom-a and bottom-b and bottom-c'))
{
    $span_bottom = "span4";
}elseif($this->countModules('bottom-a xor bottom-b xor bottom-c')){
    $span_bottom = "span12";
}else{
    $span_bottom = "span6";
}

// Adjusting footer width
if ($this->countModules('footer-a and footer-b and footer-c'))
{
    $span_footer = "span4";
}elseif($this->countModules('footer-a xor footer-b xor footer-c')){
    $span_footer = "span12";
}else{
    $span_footer = "span6";
}

// Logo file
if ($this->params->get('logoFile'))
{
    $logo = '<img src="' . $this->baseurl . '/' . $this->params->get('logoFile') . '" alt="'. $sitename .'" />';
}else
{
    $logo = '<img src="' . $this->baseurl . '/templates/' . $this->template . '/images/logo.png" alt="'. $sitename .'" />';
}

// color scheme
$color_scheme = $this->params->get('colorScheme', '#2184CD');

// hover color
$hover_color = $this->params->get('hoverColor', '#41A1D6');

// Google font
$google_font = explode( ':', $this->params->get('googleFontName') );

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' .$this->template. '/js/template.js');
$doc->addScript('templates/' .$this->template. '/js/jquery.mobilemenu.js');

// Add Stylesheets
$doc->addStyleSheet('templates/system/css/general.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Mobile menu
if ($this->params->get('mobileMenu', 1))
{
    $doc->addScript('templates/' .$this->template. '/js/mobilemenu.js');
    $doc->addStyleSheet('templates/'.$this->template.'/css/mobilemenu.css');
}

// font awesome
if ($this->params->get('fontAwesome', 1))
{
    $doc->addStyleSheet('templates/'.$this->template.'/css/font-awesome/css/font-awesome.min.css');
}

// custom css
if( file_exists('templates/'.$this->template.'/css/custom.css')){
    $doc->addStyleSheet('templates/'.$this->template.'/css/custom.css');
}

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        a{
            color:<?php echo $color_scheme; ?>;
        }
        #footer{
            border-color:<?php echo $color_scheme; ?>;
        }
        .btn-primary,
        .navigation,
        #mainmenu > li > ul > li > a:hover,
        .navigation .nav-child li > a:hover,
        .navigation .nav-child li > a:focus,
        .navigation .nav-child:hover > a,
        .nav > li a,
        #mainmenu > li > ul > li > span:hover,
        .navigation .nav-child li > span:hover,
        .navigation .nav-child li > span:focus,
        .navigation .nav-child:hover > span,
        .nav > li span {
            background-color:<?php echo $color_scheme; ?>;
        }
        #mainmenu > .active > a,
        #mainmenu > .active > a:hover,
        #mainmenu > .active > a:focus,
        #mainmenu > .active > span,
        #mainmenu > .active > span:hover,
        #mainmenu > .active > span:focus,
        #mainmenu > li > a:hover,
        #mainmenu > li > a:focus,
        #mainmenu > li > span:hover,
        #mainmenu > li > span:focus {
            background-color: <?php echo $hover_color; ?>;
        }
    </style>
    <?php
    // Use of Google Font
    if ($this->params->get('googleFont'))
    {
        ?>
        <link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName');?>' rel='stylesheet' type='text/css' />
        <style type="text/css">
            body{
                font-family: '<?php echo str_replace('+', ' ', $google_font[0]);?>', sans-serif;
            }
        </style>
    <?php
    }
    ?>
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body class="myitemid-<?php echo $itemid; ?>">

    <!-- Body -->
    <div class="body">
        <div class="container">
            <!-- Header -->
            <div class="row-fluid" id="top-brand">
                <div class="span3">
                    <a class="brand pull-left" href="<?php echo $this->baseurl; ?>">
                        <?php echo $logo; ?>
                    </a>
                </div>
                <div class="span9">
                    <div class="header-search pull-right">
                        <jdoc:include type="modules" name="top" style="none" />
                    </div>
                </div>
            </div>
            <?php if ($this->countModules('menu')) : ?>
                <nav class="navigation" role="navigation">
                    <jdoc:include type="modules" name="menu" style="none" />
                </nav>
            <?php endif; ?>
            <jdoc:include type="modules" name="banner" style="well" />
            <div class="row-fluid">
                <?php if ($this->countModules('left')) : ?>
                    <!-- Start Left -->
                    <div id="left-content" class="span3">
                        <div class="sidebar-nav">
                            <jdoc:include type="modules" name="left" style="xhtml" />
                        </div>
                    </div>
                    <!-- Start Left -->
                <?php endif; ?>
                <!-- Start Content -->
                <div id="content" role="main" class="<?php echo $span_component; ?>">
                    <jdoc:include type="modules" name="bodytop" style="xhtml" />
                    <jdoc:include type="message" />
                    <jdoc:include type="component" />
                    <jdoc:include type="modules" name="bodybottom" style="xhtml" />
                </div>
                <!-- End Content -->
                <?php if ($this->countModules('right')) : ?>
                    <div id="right-content" class="span3">
                        <!-- Start Right -->
                        <jdoc:include type="modules" name="right" style="xhtml" />
                        <!-- End Right -->
                    </div>
                <?php endif; ?>
            </div>
            <!-- Start bottom -->
            <?php if ($this->countModules('bottom-a or bottom-b or bottom-c')) : ?>
                <div class="row-fluid" id="bottom">
                    <?php if ($this->countModules('bottom-a')) : ?>
                        <!-- Start bottom-a -->
                        <div id="bottom-a" class="<?php echo $span_bottom; ?>">
                            <jdoc:include type="modules" name="bottom-a" style="well" />
                        </div>
                        <!-- End bottom-a -->
                    <?php endif; ?>
                    <?php if ($this->countModules('bottom-b')) : ?>
                        <!-- Start bottom-b -->
                        <div id="bottom-b" class="<?php echo $span_bottom; ?>">
                            <jdoc:include type="modules" name="bottom-b" style="well" />
                        </div>
                        <!-- End bottom-b -->
                    <?php endif; ?>
                    <?php if ($this->countModules('bottom-c')) : ?>
                        <!-- Start bottom-c -->
                        <div id="bottom-c" class="<?php echo $span_bottom; ?>">
                            <jdoc:include type="modules" name="bottom-c" style="well" />
                        </div>
                        <!-- End bottom-c -->
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <!-- End bottom -->
        </div>
    </div>
    <!-- Start Footer -->
    <footer class="footer" role="contentinfo">
        <div class="container">
            <jdoc:include type="modules" name="footer" style="xhtml" />
            <!-- Start bottom -->
            <?php if ($this->countModules('footer-a or footer-b or footer-c')) : ?>
                <div class="row-fluid" id="footer">
                    <?php if ($this->countModules('footer-a')) : ?>
                        <!-- Start footer-a -->
                        <div id="footer-a" class="<?php echo $span_footer; ?>">
                            <jdoc:include type="modules" name="footer-a" style="footer" />
                        </div>
                        <!-- End footer-a -->
                    <?php endif; ?>
                    <?php if ($this->countModules('footer-b')) : ?>
                        <!-- Start footer-b -->
                        <div id="footer-b" class="<?php echo $span_footer; ?>">
                            <jdoc:include type="modules" name="footer-b" style="footer" />
                        </div>
                        <!-- End footer-b -->
                    <?php endif; ?>
                    <?php if ($this->countModules('footer-c')) : ?>
                        <!-- Start footer-c -->
                        <div id="footer-c" class="<?php echo $span_footer; ?>">
                            <jdoc:include type="modules" name="footer-c" style="footer" />
                        </div>
                        <!-- End footer-c -->
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <!-- End footer -->
            <div class="row-fluid copyright-ost">
                <div class="span6">&copy; <?php echo $sitename; ?> <?php echo date('Y');?></div>
                <div class="span6"><jdoc:include type="modules" name="credits" style="no" /></div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <jdoc:include type="modules" name="debug" style="none" />
</body>
</html>