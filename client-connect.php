<?php

if (!function_exists('curl_init')) {
	die('Curl module not installed!' . PHP_EOL);
}


// the authenticate route needs the "bearer" type passed to it. Either username or google
$route = '/users/authenticate/username';
$data = json_encode(array());
$headers = ["Authorization: Basic ".base64_encode("testuser:testpass").""];
$requestType = "POST";
// test product search by ID
$route = '/products/11';
$data = json_encode(array());
$headers = ["Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJBcHBsaWNhdGlvbiIsInN1YiI6eyJpZCI6IjQiLCJ1c2VybmFtZSI6InJicm93bjEiLCJwYXNzd29yZCI6IiQyYSQwOCRWbWx2aXdXckY5bkpsajVPSmduZGRPaXFGNGZGSXpYd0ZlV3M4US54c0REN0xoNGNRTWVnVyIsIm5hbWUiOiJSZXViZW4gVGVzdCIsImVtYWlsIjoicmV1YmVuYnJvd24xMyt0ZXN0QGdtYWlsLmNvbSIsImFjdGl2ZSI6IlkiLCJtYWlsVG9rZW4iOm51bGwsImNyZWF0ZWRBdCI6IjIwMTUtMDYtMTIgMTA6MTY6MzciLCJ1cGRhdGVkQXQiOiIyMDE1LTA2LTEyIDEwOjQ3OjAxIn0sImlhdCI6MTQzNDIxMDk0MCwiZXhwIjoxNDM0ODE1NzQwfQ.1q5AZ36_oNcWPIuYx8LOcbGt2FheUInUPKuZNkSooUs","Expires: 1434815740","Content-Type: application/json","Content-Length: " . strlen($data)];
$requestType = "GET";
//$route = '/users/me';
//$data = json_encode(array());
//$headers = ["Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJBcHBsaWNhdGlvbiIsInN1YiI6eyJpZCI6IjQiLCJ1c2VybmFtZSI6InJicm93bjEiLCJwYXNzd29yZCI6IiQyYSQwOCRWbWx2aXdXckY5bkpsajVPSmduZGRPaXFGNGZGSXpYd0ZlV3M4US54c0REN0xoNGNRTWVnVyIsIm5hbWUiOiJSZXViZW4gVGVzdCIsImVtYWlsIjoicmV1YmVuYnJvd24xMyt0ZXN0QGdtYWlsLmNvbSIsImFjdGl2ZSI6IlkiLCJtYWlsVG9rZW4iOm51bGwsImNyZWF0ZWRBdCI6IjIwMTUtMDYtMTIgMTA6MTY6MzciLCJ1cGRhdGVkQXQiOiIyMDE1LTA2LTEyIDEwOjQ3OjAxIn0sImlhdCI6MTQzNDIxMDk0MCwiZXhwIjoxNDM0ODE1NzQwfQ.1q5AZ36_oNcWPIuYx8LOcbGt2FheUInUPKuZNkSooUs","Expires: 1434815740","Content-Type: application/json","Content-Length: " . strlen($data)];
//$requestType = "POST";

// create a new user
//$route = '/users'
//$data = json_encode(array('username'=>'testuser','password'=>'testpass','name'=>'Test User','email'=>'testuser@example'));
//$headers = ["Content-Type: application/json","Content-Length: " . strlen($data)];
//$requestType = "POST";

if (isset($argv[1])) {
	$host = 'http://' . $argv[1] . $route;
} else {
	$host = "http://api.example" . $route;
}

//echo $data;
$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $host);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
if ($requestType != "GET"){
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
}
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);

$result = curl_exec($ch);
if ($result === FALSE) {
	echo "Curl Error: " . curl_error($ch);
} else {
	echo PHP_EOL;
	echo "Request: " . PHP_EOL;
	echo curl_getinfo($ch, CURLINFO_HEADER_OUT);	
	echo PHP_EOL;

	echo "Response:" . PHP_EOL;
	echo $result; 
	echo PHP_EOL;
}

curl_close($ch);

?>
