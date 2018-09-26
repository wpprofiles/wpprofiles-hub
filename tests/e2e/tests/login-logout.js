import { Selector, ClientFunction }  from 'testcafe';
import { mainURL }                   from '../environment.js';
import { adminUser, profileUser1 }   from '../roles.js';
import { ensurePluginIsActive }      from '../utils.js';

// The 'Howdy, <username>' item in the admin bar
const profileLinkContainer      = Selector( '#wp-admin-bar-my-account' );

// Logout link
const profileLogoutLink         = Selector( '#wp-admin-bar-logout a' );

// Login page message container
const LoginPageMessageContainer = Selector( '#login .message' );

// The current URL
const getWindowLocation         = ClientFunction( () => window.location );


fixture( 'Login/out as admin' ).page( mainURL ).beforeEach( async t => ensurePluginIsActive( t ) );

// First test that the plugin appears in the plugins list table
test( 'Test admin login/out still works when plugin is active.', async t => {

        // As an admin, navigate to the profile page to make sure it still works
        // Then click the log out button and ensure we log out correctly.
        await t
            .useRole( adminUser )
            .navigateTo( mainURL + '/wp-admin/profile.php' )
            .hover( profileLinkContainer )
            .click( profileLogoutLink );

        const location = await getWindowLocation();

        await t
            .expect( location.href ).contains( 'wp-login.php?loggedout=true' )
            .expect( LoginPageMessageContainer.innerText ).contains( 'You are now logged out.' );

} );


fixture( 'Test login/out for Profile User works as expected.' ).page( mainURL );

// Test the redirect for profile users
test( 'Test profile users are redirected to their profile on login.', async t => {

    await t
        .useRole( profileUser1 )
        .navigateTo( mainURL + '/wp-login.php?redirect_to=' + mainURL + '/wp-admin/' );

    const location = await getWindowLocation();

    await t
        .expect( location.href ).contains( '/wp-admin/profile.php' );

} );
