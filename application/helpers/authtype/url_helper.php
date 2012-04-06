<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  if( ! function_exists('third_party_auth') ){
    function third_party_auth($username, $password){
			$base_url = 'http://user.zjut.in/';
			$the_url = $base_url . "api.php?app=member&action=login&username="
				.urlencode($username)."&password=".urlencode($password);
      $status = json_decode(file_get_contents($the_url));
			if( $status->state == 'success' ){
				$result = $status->data;
				$result->password = $password;
			} else {
				$result = false;
			}
			return $result;
    }
  }
?>
