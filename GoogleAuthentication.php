<?php
require_once __DIR__ . '/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('418675902686-6p06o7996m77v44jng2plhd969plknl0.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/auth/google/callback');
$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

if (isset($_GET['code'])) {
    // Exchange the authorization code for an access token
    $client->authenticate($_GET['code']);
    $_SESSION['google_token'] = $client->getAccessToken();
    header('Location: /');
    exit;
}

if (isset($_SESSION['google_token'])) {
    // Retrieve the user's information
    $client->setAccessToken($_SESSION['google_token']);
    $oauth2 = new Google_Service_Oauth2($client);
    $userinfo = $oauth2->userinfo->get();

    // Set the user's information in the session
    $_SESSION['user'] = [
        'id' => $userinfo->id,
        'email' => $userinfo->email,
        'name' => $userinfo->name,
        'picture' => $userinfo->picture,
    ];

    // Redirect the user to the home page
    header('Location: /');
    exit;
}

// Render the login page
echo $twig->render('login.html', [
    'google_auth_url' => $client->createAuthUrl(),
]);
