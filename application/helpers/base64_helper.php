<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if( ! function_exists('base64') ){
	function base64 ($string, $encode=true) {
		if ($encode)
			return base64_encode($string);
		else
			return base64_decode($string);
	}
}
?>
