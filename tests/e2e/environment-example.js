/*
This is an example of an environment file which you will need called
environment.js in the wpprofiles-hub/tests/e2e/ directory. It sets
up the required variables to allowe TestCafe to work as expected.
*/

// The main URL for your testing environment. Variable must be mainURL
var mainURL = 'https://wpprofileshub.local';

// Credentials for a user with the standard profile user role. Variable must be profileUser1Details
var profileUser1Details = {
    username: 'profileuser1',
    password: 'superSecureP@s5w0rd!'
};

// Credentials for a user with the admin role. Variable must be adminUserDetails
var adminUserDetails = {
    username: 'adminusername',
    password: 'Adm1nP@5Ssw0r4!!'
}

// Now we export these variables to be availabe in our tests.
// Don't forget to save this file as wpprofiles-hub/tests/e2e/environment.js
export {
    mainURL,
    profileUser1Details,
    adminUserDetails
}