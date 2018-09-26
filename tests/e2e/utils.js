import { Selector }  from 'testcafe';
import { mainURL }   from './environment.js';
import { adminUser } from './roles.js';

/**
 * Ensure that the Hub plugin is active by logging in as an admin
 * and checking for the Activate button and clicking it if is exists
 *
 * @param {test Object} t the currently running test
 * @return void
 */
var ensurePluginIsActive = async function( t ) {
    // Activate link
    const WPProfilesHubActivatePluginLink = Selector( 'a[aria-label="Activate WPProfiles Hub"]' );

    // Ensure the plugin is activated before running these tests
    await t.useRole( adminUser ).navigateTo( mainURL + '/wp-admin/plugins.php' );

    // Activate link exists therefore we need to click it to activate the plugin
    if ( await WPProfilesHubActivatePluginLink.exists ) {
        await t.click( WPProfilesHubActivatePluginLink );
    }
};

export {
    ensurePluginIsActive
}