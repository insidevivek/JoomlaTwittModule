<?php 
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php


if(false) {


// twitter Style 
  	
?>
		
<div id="twitter_div<?php echo $params->get( 'moduleclass_sfx'); ?>">
<h2 style="display: none;" ><?php echo $params->get( 'twitttitle'); ?></h2>
    <ul id="twitter_update_list"></ul>
    <a href="http://twitter.com/<?php echo $params->get( 'twitteruser'); ?>" rel="nofollow" id="twitter-link" style="display:block;text-align:right;">Get my Twitt</a>
    </div>
    <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
    <script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $params->get( 'twitteruser'); ?>.json?callback=twitterCallback2&amp;count=<?php echo $params->get( 'twitteritems'); ?>"></script>

<?php
	
   }
   else {
   // RSS STYLE
    if( $feed != false )
    {
    	//image handling
    	$iUrl 	= isset($feed->image->url)   ? $feed->image->url   : null;
    	$iTitle = isset($feed->image->title) ? $feed->image->title : null;



      
      if(true) 
      {
      
    	?>
   	
    	<div id="twittrssdiv" class="twittrss<?php echo $params->get( 'moduleclass_sfx'); ?>">
    	<?php
    	// description
    	if (!is_null( $feed->title ) && $params->get('rsstitle', 1)) {
    		?>
				<div class="twitttitle<?php echo $params->get( 'moduleclass_sfx'); ?>">
        <a href="<?php echo str_replace( '&', '&amp', $feed->link ); ?>" target="_blank">
    						<?php echo $feed->title; ?></a>
        </div>
    		<?php
    	}
    
  
    	// description
    	if ($params->get('rssdesc', 0)) {
    	?>
    	<div class="twittdescription<?php echo $params->get( 'moduleclass_sfx'); ?>">
    		<?php echo $feed->description; ?>
   		</div>
    		<?php
    	}
    
    	// image
    	if ($params->get('rssimage', 0) && $iUrl) {
    	?>
    	<div class="twittimage<?php echo $params->get( 'moduleclass_sfx'); ?>">
    	<img src="<?php echo $iUrl; ?>" alt="<?php echo @$iTitle; ?>"/>
    	</div>
    	<?php
    	}
    
    	$actualItems = count( $feed->items );
    	$setItems    = $params->get('twitteritems', 5);
    
    	if ($setItems > $actualItems) {
    		$totalItems = $actualItems;
    	} else {
    		$totalItems = $setItems;
    	}
    	?>
    	
    	<div id="twittallitemsdiv" class="twittallitems<?php echo $params->get( 'moduleclass_sfx'); ?>">
    			<?php
    			
          $words = $params->def('word_count', 0);
    			
          for ($j = 0; $j < $totalItems; $j ++)
    			{
    				$currItem = & $feed->items[$j];

            // parse item description

    					// item description
    					$text = $currItem->get_description();
    					$text = str_replace('&apos;', "'", $text);
    

    					// word limit check
    					if ($words)
    					{
                                                
    						$texts = explode(' ', $text);
    						$count = count($texts);
    						if ($count > $words)
    						{
    							$text = '';
    							for ($i = 0; $i < $words; $i ++) {
    								$text .= ' '.$texts[$i];
    							}
    							$text .= '...';
    						}
    						
    					}
    					    				
    				
    				// item title
    				?>
    				<div class="twittitem<?php echo $params->get( 'moduleclass_sfx'); ?>">
    				<?php
    				  				    				
        				if ($params->get('twittitemlink', 0) && !is_null( $currItem->get_link() )) {
        				   $linktext = $params->get( 'twitttitle', '');
        				   if($linktext == '') {
                      $linktext = $params->get( 'twitteruser');
                   }
        				?>
        					<a href="<?php echo $currItem->get_link(); ?>" target="_blank" rel="nofollow"><?php echo $linktext; ?>:</a>
        					<?php echo $text ?>  				
        				<?php
                } else {
        				?>
        					<?php echo $text ?>
                <?php                        
                }
            
            
            ?>
            </div>
            
          <?php
      		}
      		?>
      		<div id="twittfollowmediv" style="display:block;text-align:right;">
      		    <a href="http://twitter.com/<?php echo $params->get( 'twitteruser'); ?>" rel="nofollow"><?php echo $params->get('followmetext', 'Get my twitt'); ?></a>
    		  </div>
    		

</div>
    <?php 
    }    

    
    } 
    
    
    }
  
  ?>
