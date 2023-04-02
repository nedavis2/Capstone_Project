<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

$clientID = '418675902686-6p06o7996m77v44jng2plhd969plknl0.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/Capstone_project/src/login.php';

//creating client request to google
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri); 
$client->addScope("email");
$client->addScope("profile");


$_SESSION["works on login"] = True;
print_r($_GET);
print_r($_SESSION);

// authenticate ID token from Google Sign-In
if (isset($_GET['code'])) {
    echo 1;
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  echo 2;
  $client->setAccessToken($token['access_token']);
  echo 3;

  print_r($token);
  $payload = $client->verifyIdToken(client["id_token"]);
  echo 4;
  if ($payload) {
    $userid = $payload['sub'];
    // get profile info 
    $email = $payload['email'];
    $name = $payload['name'];

    // set session variables
    $_SESSION['userid'] = $userid;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    
    // redirect to a page that requires authentication
    header('Location: index.php');
    exit();
  } else {
    // Invalid ID token
    echo "Invalid ID token.";
  }
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}
?> 

