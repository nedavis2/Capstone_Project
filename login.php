<?php
require_once 'vendor/autoload.php';

$clientID = '418675902686-6p06o7996m77v44jng2plhd969plknl0.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/Capstone_Project/src/index.php';

//creating client request to google
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow 
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  
  // get profile info 
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
 
  // now you can use this profile info to create account in your website and make user logged in. 
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}
?>