<?php
	$columns = NULL;
	$editmode = NULL;
	$taskmode = JRequest::getCmd('task');
	if ($taskmode == "edit") $editmode = 1;
	if ($this->countModules('left + right') <= 0) $columns="nocolumns";
	elseif ($this->countModules('left') >= 1 && $this->countModules('right') <= 0) $columns="leftcolumn";
	elseif ($this->countModules('right') >= 1 && $this->countModules('left') <= 0) $columns="rightcolumn";
	elseif ($this->countModules('right') >= 1 && $this->countModules('left') >= 1 && $editmode) $columns="leftcolumn";
	$joomlaJS = $this->params->get('defaultJS');
	if (($joomlaJS == "off") && (!$editmode)) {
		$headerjs = $this->getHeadData();
		$headerjs['scripts'] = array();
		$this->setHeadData($headerjs);
	};
	defined('_JEXEC') or die;
	$app = JFactory::getApplication();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >

<head>
	<jdoc:include type="head" />
	<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/template.css" type="text/css"/>
	<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/print.css" type="text/css" media="print" />
	<?php if ($editmode) echo '<link rel="stylesheet" href="/templates/system/css/general.css" type="text/css" />'."\n"; ?>
</head>

<body>

<div id="page">
	<div id="header">
		<div id="logo"><a href="<?php echo JURI::base() ?>" class="title"><?php echo $app->getCfg('sitename'); ?></a></div>
		<div id="menu"><jdoc:include type="modules" name="user3" style="none" /></div>
		<div id="sitenav"><jdoc:include type="modules" name="user4" style="xhtml" /></div>
	</div>
	<jdoc:include type="modules" name="slides" style="none" />
	<div id="contentholder" class="<?php echo $columns ? $columns : 'threecolumns' ?>">
		<div id="center">
			<jdoc:include type="modules" name="breadcrumb" style="none" />
			<jdoc:include type="modules" name="top" style="xhtml" />
			<jdoc:include type="message" />
			<jdoc:include type="component" />
		</div>
		<div id="left"><jdoc:include type="modules" name="position-7" style="rounded" /></div>
		<div id="right"><jdoc:include type="modules" name="right" style="rounded" /></div>
		<span class="clear">&nbsp;</span>
		<div id="bottom"><jdoc:include type="modules" name="footer" style="xhtml" /></div>
	</div>
</div>
	
<div id="footer">
	<?php if ($this->countModules('user1 or user2 or user5')) { ?>
		<div id="footer_panel"><div id="panel_bottom">
			<div class="column"><jdoc:include type="modules" name="user1" style="xhtml" /></div>
			<div class="column"><jdoc:include type="modules" name="user2" style="xhtml" /></div>
			<div class="column"><jdoc:include type="modules" name="user5" style="xhtml" /></div>
			<span class="clear">&nbsp;</span>
		</div></div>
	<?php }; ?>
	<div id="footer_other">
		<div id="copyright">
			<jdoc:include type="modules" name="syndicate" style="none" />
			<jdoc:include type="modules" name="copyright" style="none" />
		</div>
		<span class="clear">&nbsp;</span>
	</div>
</div>

<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>