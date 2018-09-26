import { Role, Selector } from 'testcafe';
import { mainURL, adminUserDetails, profileUser1Details } from './environment.js';

const adminUser = Role( mainURL + '/wp-admin/', async t => {

    const userLoginInput    = await Selector( '#user_login' );
    const passwordInput     = await Selector( '#user_pass' );
    const loginSubmitButton = await Selector( '#wp-submit' );

    await t
        .click( userLoginInput )
        .typeText( userLoginInput, adminUserDetails.username, { replace: true } )
        .expect( userLoginInput.value ).eql( profileUser1Details.username );

    await t
        .click( passwordInput )
        .typeText( passwordInput, adminUserDetails.password, { replace: true } )
        .click( loginSubmitButton );
} );

const profileUser1 = Role( mainURL + '/wp-admin/', async t => {

    const userLoginInput    = await Selector( '#user_login' );
    const passwordInput     = await Selector( '#user_pass' );
    const loginSubmitButton = await Selector( '#wp-submit' );

    await t
        .click( userLoginInput )
        .typeText( userLoginInput, profileUser1Details.username, { replace: true } )
        .expect( userLoginInput.value ).eql( profileUser1Details.username );

    await t
        .click( passwordInput )
        .typeText( passwordInput, profileUser1Details.password, { replace: true } )
        .click( loginSubmitButton );
} );

export {
    adminUser,
    profileUser1
}