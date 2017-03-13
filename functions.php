<?php

require_once('config.php');
require_once(DBAPI);

function get_ip_address() {
    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                // trim for safety measures
                $ip = trim($ip);
                // attempt to validate IP
                if (validate_ip($ip)) {
                    return $ip;
                }
            }
        }
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
}
/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */
function validate_ip($ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return false;
    }
    return true;
}

function add() {	
	if(empty($_POST['name']) || empty($_POST['email']) 
		|| empty($_POST['phone']) || //	empty($_POST['message'])   ||
		!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			echo "No arguments Provided!";
			echo "POST= " . $_POST;
			return false;
	}
	
    $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	$lead['created'] = $_POST['created'] = $today->format("Y-m-d H:i:s");
    $lead['name'] = $_POST['name'];
	$lead['email'] = $_POST['email'];
	$lead['phone'] = $_POST['phone'];
	
	$ip = get_ip_address();
	if($ip == true){
		$lead['ip_addr'] = $ip;
	}
	
    save('leads', $lead);
//    header('location: index.php');
}