<?php
/**
 * This file is used for helper or support functions
 * 
 * /

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
	function dump($var, $label = 'Dump', $echo = TRUE) {
		// Store dump in variable
		ob_start();
		var_dump($var);
		$output = ob_get_clean();
		// Add formatting
		$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
		$output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">'
				. $label . ' => ' . $output . '</pre>';
		// Output
		if ($echo == TRUE) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if (!function_exists('dump_exit')) {
	function dump_exit($var, $label = 'Dump', $echo = TRUE) {
		dump($var, $label, $echo);
		exit;
	}
}
/**
 * dump with comment to hide data
 */
function dump_comment($data){
    echo '<!-- ' . PHP_EOL;   	
    dump($data);    
    echo '-->' . PHP_EOL;
}

/**
 * dump with logged in
 * 
 */
function dump_login($data){
    if(is_user_logged_in() ){
        dump($data);  
    }    
}
/**
 * dump in admin area
 */
function dump_admin($data){
    if(is_user_logged_in() && is_admin()){
        dump($data);  
    }    
}

/**
 * dump in admin area
 */
function dump_die($data){
		dump($data);
	exit();
}

/**
 * Dump with user id
 */
function dump_user($data, $user_id =1){
    if($user_id == get_current_user_id()){
        dump($data);  
    }    
}
/**
 * Alert in javascript
 */
function alert($data){
    echo '<script type="text/javascript"> alert("';    
    echo (string) $data;    
    echo '"); </script>';
}



