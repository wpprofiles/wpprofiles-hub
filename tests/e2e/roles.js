import { Role, Selector } from 'testcafe';
import { mainURL, adminUserDetails, profileUser1Details } from './environment.js';

const adminUser = Role( mainURL + '/login', async t => {
    await Selector( '#user_login' );
    await t
        .typeText( '#user_login', adminUserDetails.username )
        .typeText( '#user_pass', adminUserDetails.password )
        .click( '#wp-submit' );
} );

const profileUser1 = Role( mainURL + '/login', async t => {
    await Selector( '#user_login' );
    await t
        .typeText( '#user_login', profileUser1Details.username )
        .typeText( '#user_pass', profileUser1Details.password )
        .click( '#wp-submit' );
} );

export {
    adminUser,
    profileUser1
}