<?php

$method = $_SERVER['REQUEST_METHOD'];

//Script Foreach
$c = true;
if ( $method === 'POST' ) {
	//$admin_email = 'info@etalon-safe.ru';
	$admin_email = 'gtasa3box@gmail.com';
	$form_subject = 'etalon-safe.ru';

	$selectedStorage  = 'None';
	if(isset($_POST['storage']) && is_array($_POST['storage']) && count($_POST['storage']) > 0){
		$selectedStorage = implode(', ', $_POST['storage']);
	}
	$body .= 'Selected Storage: ' . $selectedStorage;
	$variabletext = trim($_POST["variable-text"]);

	$width = trim($_POST["width"]);
	$height  = trim($_POST["height"]);
	$depth  = trim($_POST["depth"]);

	$break = trim($_POST["break"]);
	$fire = trim($_POST["fire"]);

	$number  = trim($_POST["number"]);
	

	foreach ( $_POST as $key => $value ) {
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