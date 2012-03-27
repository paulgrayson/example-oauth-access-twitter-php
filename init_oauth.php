<?php
include_once "config_oauth.php";
include_once "oauth-php/library/OAuthStore.php";
include_once "oauth-php/library/OAuthRequester.php";

// Setup db for storing oauth consumer details during oauth processes
$options = array('server' => MYSQL_HOST, 'username' => MYSQL_USERNAME,
                 'password' => MYSQL_PASSWORD, 'database' => MYSQL_DB_NAME);
$store   = OAuthStore::instance('MySQL', $options);
?>
