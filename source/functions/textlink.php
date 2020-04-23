<?php
function textlink($text){
        $text = html_entity_decode($text);
        $text = " ".$text;
        if(preg_match('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',$text,$a))
		{
		}
		else if(preg_match('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',$text,$a))
		{
		}
		else
		{
		$a=false;
		}
        return $a[0];
}

?>