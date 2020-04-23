<?php
error_reporting(0);
function urlexpand($value)
{
	
  if(textlink($value))
	{
	$link =textlink($value);
	$em = new URL($link);
	$site = $em->get_site();
	if($site != "")
	{
	
	    $code = $em->get_iframe();
	    if($code == "")
	    {
	            $code = $em->get_embed();
				if($code == "")
				{
				$codesrc=$em->get_thumb("medium");
				}
	    }
	    if($codesrc)
	    {
	    $expand = '<div class="img_container"><img src='.$codesrc.' class="imgpreview" /></div>';
		return $expand;
	    }
	    else if($code)
	    return $code;
	}
	}
}

function check_url($value)
{
	$value = trim($value);
	if (get_magic_quotes_gpc()) 
	{
		$value = stripslashes($value);
	}
	$value = strtr($value, array_flip(get_html_translation_table(HTML_ENTITIES)));
	$value = strip_tags($value);
	$value = htmlspecialchars($value);
	return $value;
}	

function file_get_contents_curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $data = curl_exec($ch);
	$info = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
	
	//checking mime types
	if(strstr($info,'text/html')) {
		curl_close($ch);
    	return $data;
	} else {
		return false;
	}
}

?>