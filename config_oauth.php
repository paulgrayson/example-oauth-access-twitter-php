<?php

// Should match your app's mysql db
define( 'MYSQL_HOST', 'your.db.host' );
define( 'MYSQL_USERNAME', 'your.username' );
define( 'MYSQL_PASSWORD', 'your.pasword' );
define( 'MYSQL_DB_NAME', 'your.db.name' );

// Get these values from Twitter https://dev.twitter.com/apps
define( 'TWITTER_APP_CONSUMER_KEY', 'your.consumer.key.from.twitter' );
define( 'TWITTER_APP_CONSUMER_SECRET', 'your.consumer.secret.from.twitter' );

// these are the keys we're using to store some items in the session - should not need to change
define( 'SESSION_KEY_CONSUMER', 'oconskey' );
define( 'SESSION_KEY_USER', 'ouser' );

// these tell the oauth code where to go when authorization succeeds for fails
define( 'SUCCESS_PATH', '/example.php' );
define( 'DENIED_PATH', '/denied.php' );

?>

