<?php

// Sanitize Output Functions
function escape($string) {
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

?>