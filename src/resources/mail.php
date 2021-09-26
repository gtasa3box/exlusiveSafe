<?php

include("SxGeo.php");

$method = $_SERVER['REQUEST_METHOD'];

//Script Foreach
$c = true;
if ( $method === 'POST' ) {
	//$admin_email = 'info@etalon-safe.ru';
	$admin_email = 'gtasa3box@gmail.com';
	$form_subject = 'etalon-safe.ru';

	$massive = [];

	$ip=$_SERVER['REMOTE_ADDR'];

	$SxGeo = new SxGeo('SxGeoCity.dat');

	

	$GeoPos = $SxGeo->getCity($ip);

	$massive['Geo'] = $GeoPos['city']['name_ru'];

	$massive['Geo'] .= ' ('.$ip.')';
	
	$massive['checkboxes']  = 'None';
	if(isset($_POST['storage']) && is_array($_POST['storage']) && count($_POST['storage']) > 0){
		$massive['checkboxes'] = htmlspecialchars(implode(', ', $_POST['storage']), ENT_QUOTES);
	}

	$massive['variabletext'] = htmlspecialchars(trim($_POST["variable-text"]), ENT_QUOTES);

	$massive['width'] = intval(trim($_POST["width"]));
	$massive['height']  = intval(trim($_POST["height"]));
	$massive['depth']  = intval(trim($_POST["depth"]));

	$massive['break'] = htmlspecialchars(trim($_POST["break"]), ENT_QUOTES);
	$massive['fire'] = htmlspecialchars(trim($_POST["fire"]), ENT_QUOTES);

	$massive['number']  = htmlspecialchars(trim($_POST["number"]), ENT_QUOTES);


	foreach ( $massive as $key => $value ) {
		if ( $value != "") {
			$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}
}

$message = "<table style='width: 100%;'>$message</table>";

function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
'From: '.adopt($project_name).' <'.$admin_email.'>' . PHP_EOL .
'Reply-To: '.$admin_email.'' . PHP_EOL;

mail($admin_email, adopt($form_subject), $message, $headers );

header('Location: http://'.$_SERVER['HTTP_HOST'].'/');
exit;