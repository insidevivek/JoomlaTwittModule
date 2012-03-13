<?php

// no direct access 
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$rssurl	= $params->get('rssurl', '');

//check if cache diretory is writable
$cacheDir = JPATH_BASE.DS.'cache';
if (!is_writable($cacheDir))
{
	echo '<div>';
	echo JText::_('Make cache directory writable.');
	echo '</div>';
	return;
}

if(true)
{


//check if tweet feed URL has been set  
  
  $feed = modTwittHelper::getFeed($params);
  
}

require(JModuleHelper::getLayoutPath('mod_twitt'));
