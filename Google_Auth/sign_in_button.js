import { GoogleLogin } from 'library'

function onLoadGoogleAuthLibrary() {
  console.log('Google 3P Authorization library loaded');
  
  // Initialize the Google Sign-In button
  gapi.load('auth2', function() {
    gapi.auth2.init({
      client_id: '<your-client-id>',
      scope: 'email profile openid'
    }).then(function() {
      console.log('Google Sign-In initialized');
    });
  });
}
