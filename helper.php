<?php

// no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class modtwittHelper
{

  function getFeed($params)
	{
	
	  $allthese = str_replace(" ", "+", $params->get('allthese',''));
	  $exactphrase = str_replace(" ", "+", $params->get('exactphrase',''));
	  $anyofthese = str_replace(" ", "+OR+", $params->get('anyofthese','')); 
	  $noneofthese = str_replace(" ", "+-", $params->get('noneofthese',''));
	  $thishashtag = str_replace(" ", "+%23", $params->get('thishashtag','')); 
  
	  
	  
	  $allthesepart = '';
    $exactphrasepart = '';
    $anyofthesepart = '';
    $noneofthesepart = '';
    $onlylinkspart = '';
    $thishashtagpart = '';
        
    if ($allthese != '') {
    	$allthesepart = '+'.$allthese;
    }
    
    if ($exactphrase != '') {
      $exactphrasepart = '+"'.$exactphrase.'"';
    }
    
    if($anyofthese != '') {
      $anyofthesepart = '+'.$anyofthese;
    }
    
    if($noneofthese != '') {
      $noneofthesepart = '++-'.$noneofthese;
    }
    if($thishashtag != '') {
      $thishashtagpart = '+%23'.$thishashtag;
    }
    
    if($params->get('onlylinks', 0)) {
      $onlylinkspart = '+filter:links';
    }
    
    
    $rssurl = 'http://search.twitter.com/search.atom?q='.$allthesepart.$exactphrasepart.$anyofthesepart.$noneofthesepart.$thishashtagpart."+from:".$params->get( 'twitteruser').$onlylinkspart.'&rpp='.$params->get('twitteritems', 10);
    
		//  get RSS parsed object
		$options = array();
		$options['rssUrl'] 		= $rssurl;
		if ($params->get('cache')) {
			$options['cache_time']  = $params->get('cache_time', 15) ;
			$options['cache_time']	*= 60;
		} else {
			$options['cache_time'] = null;
		}

		$rssDoc =& JFactory::getXMLparser('RSS', $options);

		$feed = new stdclass();

		if ($rssDoc != false)
		{
			// channel header and link
			$feed->title = $rssDoc->get_title();
			$feed->link = $rssDoc->get_link();
			$feed->description = $rssDoc->get_description();

			// channel image
			$feed->image->url = $rssDoc->get_image_url();
			$feed->image->title = $rssDoc->get_image_title();

			// items
			$items = $rssDoc->get_items();

			// feed elements
			$feed->items = array_slice($items, 0, $params->get('twitteritems', 5));
		} else {
			$feed = false;
		}

		return $feed;
	}
	
}