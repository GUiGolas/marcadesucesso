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
	if(empty($_POST['lead']['name']) || empty($_POST['lead']['email']) 
		|| empty($_POST['lead']['phone']) || //	empty($_POST['message'])   ||
		!filter_var($_POST['lead']['email'],FILTER_VALIDATE_EMAIL)){
			echo "No arguments Provided!";
			return false;
	}
	
	$lead = $_POST['lead'];
    $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	$lead['created'] = $lead['created'] = $today->format("Y-m-d H:i:s");
    $lead['name'] = $lead['name'];
	$lead['email'] = $lead['email'];
	$lead['phone'] = $lead['phone'];
	
	$ip = get_ip_address();
	if($ip == true){
		$lead['ip_addr'] = $ip;
	}
	
    save('leads', $lead);
//    header('location: index.php');
}