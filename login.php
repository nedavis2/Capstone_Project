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

// authenticate ID token from Google Sign-In
if (isset($_GET['id_token'])) {
  $id_token = $_GET['id_token'];
  $payload = $client->verifyIdToken($id_token);
  echo "token if state";
  if ($payload) {
    $userid = $payload['sub'];
    // get profile info 
    $email = $payload['email'];
    echo "email if state";
    
    // start a new session
    session_start();

    // set session variables
    $_SESSION['userid'] = $userid;
    $_SESSION['email'] = $email;
    
    // redirect to a page that requires authentication
    header('Location: authenticated_page.php');
    exit();
  } else {
    // Invalid ID token
    echo "Invalid ID token.";
  }
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}
?>

In this example, after a user successfully authenticates with Google, we start a new session and set session variables for the user's ID, email, and name. Then, we redirect the user to an authenticated page (e.g., authenticated_page.php) that requires authentication.

You can access the session variables on any page that has access to the session by calling session_start() at the beginning of the page and using the $_SESSION superglobal array to access the session variables.