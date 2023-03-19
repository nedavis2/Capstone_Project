function init() {
    document.getElementById('customBtn').addEventListener('click', function () {
        signInWithGoogle();
    });
}

document.addEventListener('DOMContentLoaded', init);

function signInWithGoogle() {
    // Replace with your own client ID
    var clientId = '418675902686-6p06o7996m77v44jng2plhd969plknl0.apps.googleusercontent.com';
    var authUrl = 'https://accounts.google.com/o/oauth2/v2/auth';
    var responseType = 'id_token';
    var scope = 'email profile openid';
    var redirectUri = 'http://localhost/Capstone_Project/src/index.php';
    var nonce = Math.random().toString(36).substring(2, 15);

    var url = authUrl + '?' +
        'client_id=' + encodeURIComponent(clientId) + '&' +
        'response_type=' + encodeURIComponent(responseType) + '&' +
        'scope=' + encodeURIComponent(scope) + '&' +
        'redirect_uri=' + encodeURIComponent(redirectUri) + '&' +
        'nonce=' + encodeURIComponent(nonce);

    window.location.href = url;
}