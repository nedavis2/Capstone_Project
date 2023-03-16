var googleUser = {};
var startApp = function () {
    gapi.load('auth2', function () {
        auth2 = gapi.auth2.init({
            client_id: '418675902686-6p06o7996m77v44jng2plhd969plknl0.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
        });
        attachSignin(document.getElementById('customBtn'));
    });
};

function attachSignin(element) {
    console.log("Attaching Signin to:", element.id);
    auth2.attachClickHandler(element, {},
        function (googleUser) {
            console.log("Google Sign-In successful");
            // Get the user's ID token
            var id_token = googleUser.getAuthResponse().id_token;

            // Redirect the user to the PHP script with the ID token as a URL parameter
            window.location.href = 'login.php?id_token=' + id_token;
        }, function (error) {
            console.error("Google Sign-In error:", error);
            alert(JSON.stringify(error, undefined, 2));
        });
}

// Call startApp when the page is fully loaded
document.addEventListener('DOMContentLoaded', startApp);