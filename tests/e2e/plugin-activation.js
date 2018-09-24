import { Selector }  from 'testcafe';
import { mainURL }   from './environment.js';
import { adminUser } from './roles.js';

// The Table Row containing the WP Profiles Hub plugin details
const WPProfilesHubPluginRow            = Selector( 'tr[data-slug="wpprofiles-hub"]' );
const WPProfilesHubActivatePluginLink   = Selector( 'a[aria-label="Activate WPProfiles Hub"]' );
const WPProfilesHubDeactivatePluginLink = Selector( 'a[aria-label="Deactivate WPProfiles Hub"]' );
const pluginMessageNotice               = Selector( '#message' );

fixture( 'Plugin (De)Activation' ).page( mainURL );

// First test that the plugin appears in the plugins list table
test( 'Plugin available in plugins list table.', async t => {
    await t
        .useRole( adminUser )
        .navigateTo( mainURL + '/wp-admin/plugins.php' )
        .expect( WPProfilesHubPluginRow.exists ).ok()
} );

// Test that clicking on the activate button correctly activates the plugin
test( 'Activate plugin by clicking on Activate link', async t => {
    await t
        .useRole( adminUser )
        .navigateTo( mainURL + '/wp-admin/plugins.php' );

    await Selector( '#the-list' );

    await t.click( WPProfilesHubActivatePluginLink )
        .expect( pluginMessageNotice.innerText ).contains( 'Plugin activated.' );
} );

// Test that clicking on the deactivate button correctly deactivates the plugin
test( 'Deactivate plugin by clicking on Deactivate link', async t => {
    await t
        .useRole( adminUser )
        .navigateTo( mainURL + '/wp-admin/plugins.php' );

    await Selector( '#the-list' );

    await t.click( WPProfilesHubDeactivatePluginLink )
        .expect( pluginMessageNotice.innerText ).contains( 'Plugin deactivated.' );
} );