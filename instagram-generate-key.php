<?php


$insta_client_id = 'CLIENT_ID';
$insta_client_secret = 'SECRET_CODE';
$insta_redirect_uri = 'https://your-url.com/your-page.php';
$authentication_url = "https://api.instagram.com/oauth/authorize?client_id=".$insta_client_id."&redirect_uri=".$insta_redirect_uri."&response_type=code";

	
if(isset($_GET['code'])){
$code = $_GET['code'];
$uri = 'https://api.instagram.com/oauth/access_token'; 


$data = [
	'client_id' => $insta_client_id, 
	'client_secret' => $insta_client_secret, 
	'grant_type' => 'authorization_code', 
	'redirect_uri' => $insta_redirect_uri, 
	'code' => $code
];
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $uri); // uri
	curl_setopt($ch, CURLOPT_POST, true); // POST
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // POST DATA
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // RETURN RESULT true
	curl_setopt($ch, CURLOPT_HEADER, 0); // RETURN HEADER false
	curl_setopt($ch, CURLOPT_NOBODY, 0); // NO RETURN BODY false / we need the body to return
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // VERIFY SSL HOST false
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // VERIFY SSL PEER false
	$result = json_decode(curl_exec($ch)); // execute curl
	echo '<pre>'; // preformatted view
	
	//ecit directly the result
	//exit(print_r($result)); 
	
	echo $result->access_token;
	echo'<br>';
	$user = $result->user;
	echo $user->id;
} else {
	?>
<a href="<?=$authentication_url; ?>"> Click here to Authenticate</a>

<?

}