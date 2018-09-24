These End2End tests rely on TestCafe.

http://devexpress.github.io/testcafe/

After installing testcafe, you will need to create an environment file.
To do so, check out the environment-example.js file for a skeleton of
what variables you will need to have in order to run these tests correctly.

Once you have a wpprofiles-hub/tests/e2e/environment.js file (which is
`.gitngore`d) you can run the tests from the root of this plugin thus:

testcafe firefox ./tests/e2e/plugin-activation.js

You can switch `firefox` out for any browser of your choice.

Note: There's a weird bug in Safari that, sometimes, you won't be able
to sign in correctly because the first letter of the username won't be
"typed" into the username field.