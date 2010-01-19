<?php
/*
Plugin Name: PHPCode
Version: 0.1 
Plugin URI: http://www.itandme.de/phpcode-wordpress-plugin-0-1-released.html
Author: Sebastian Schedlbauer
Author URI: http://www.itandme.de
Description: Paste syntax-highlighted PHP snipptets into your posts

*/


function highlight_php_code($text)
{

    
    while (strpos($text,'<phpcode>')!== false)
    {
        $tag_start = strpos($text,'<phpcode>');
        $tag_end = strpos($text,'</phpcode>');  

        if ($tag_end === false)
        {
            $tag_end=(strlen($text));    
        }
        
        $phpcode = substr($text,$tag_start+9,$tag_end-$tag_start-9);
        
        $text_before = substr($text,0,$tag_start);
        $text_after = substr($text,$tag_end+10);
        
        if (strpos($phpcode,'<?php')===false)
        {
            
            $phpcode = str_replace('&lt;?php','',highlight_string('<?php' . $phpcode,true));            
        }
        else
        {
            $phpcode = highlight_string($phpcode,true);
        }
        
        $text = $text_before . $phpcode . $text_after;
           
    }

 


  return $text;
} 




add_filter('the_content', 'highlight_php_code',8);
add_filter('the_excerpt', 'highlight_php_code',8);

?>
