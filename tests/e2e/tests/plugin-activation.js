import { Selector }  from 'testcafe';
import { mainURL }   from '../environment.js';
import { adminUser } from '../roles.js';

// The Table Row containing the WP Profiles Hub plugin details
const WPProfilesHubPluginRow            = Selector( 'tr[data-slug="wpprofiles-hub"]' );

// Activate link
const WPProfilesHubActivatePluginLink   = Selector( 'a[aria-label="Activate WPProfiles Hub"]' );

// Deactivate link
const WPProfilesHubDeactivatePluginLink = Selector( 'a[aria-label="Deactivate WPProfiles Hub"]' );

// Where the message appears on plugin de/activation
const pluginMessageNotice               = Selector( '#message' );

fixture( 'Plugin (De)Activation' ).page( mainURL );

// First test that the plugin appears in the plugins list table
test( 'Test plugin available and can be activated/deactivated appropriately.', async t => {
    await t
        .useRole( adminUser )
        .navigateTo( mainURL + '/wp-admin/plugins.php' )
        .expect( WPProfilesHubPluginRow.exists ).ok()
        .click( WPProfilesHubActivatePluginLink )
        .expect( pluginMessageNotice.innerText ).contains( 'Plugin activated.' )
        .click( WPProfilesHubDeactivatePluginLink )
        .expect( pluginMessageNotice.innerText ).contains( 'Plugin deactivated.' );
} );
