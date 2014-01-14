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

// Adjusting content width
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

// Logo file
if ($this->params->get('logoFile'))
{
    $logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="'. $sitename .'" />';
}else
{
    $logo = '<img src="' . JUri::root() . 'templates/' . $this->template . '/images/logo.png" alt="'. $sitename .'" />';
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' .$this->template. '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');
$doc->addStyleSheet('templates/system/css/general.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
	<jdoc:include type="head" />
    <?php
    // Use of Google Font
    if ($this->params->get('googleFont'))
    {
        ?>
        <link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName');?>' rel='stylesheet' type='text/css' />
        <style type="text/css">
            body{
                font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName'));?>', sans-serif;
            }
        </style>
    <?php
    }
    ?>
</head>
<body class="myitemid-<?php echo $itemid; ?>">

    <!-- Body -->
    <div class="body">
        <div class="container">
            <!-- Header -->
            <header class="row-fluid" role="banner">
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
            </header>
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
                <main id="content" role="main" class="<?php echo $span_component; ?>">
                    <jdoc:include type="modules" name="bodytop" style="xhtml" />
                    <jdoc:include type="message" />
                    <jdoc:include type="component" />
                    <jdoc:include type="modules" name="bodybottom" style="xhtml" />
                </main>
                <!-- End Content -->
                <?php if ($this->countModules('right')) : ?>
                    <div id="right-content" class="span3">
                        <!-- Start Right -->
                        <jdoc:include type="modules" name="right" style="xhtml" />
                        <!-- End Right -->
                    </div>
                <?php endif; ?>
            </div>
            <jdoc:include type="modules" name="bottom" style="xhtml" />
        </div>
    </div>
    <!-- Start Footer -->
    <footer class="footer" role="contentinfo">
        <div class="container">
            <jdoc:include type="modules" name="footer" style="none" />
            <p>&copy; <?php echo $sitename; ?> <?php echo date('Y');?></p>
        </div>
    </footer>
    <!-- End Footer -->
    <jdoc:include type="modules" name="debug" style="none" />
</body>
</html>