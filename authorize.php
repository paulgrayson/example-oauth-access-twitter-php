<?php
include_once "config_oauth.php";
include_once "init_oauth.php";

// Get the id of the current user (must be an int)
$user_id = $_REQUEST['user_id'];
$user_id = intval( $user_id );

try
{
  $server = array(
    'consumer_key' => TWITTER_APP_CONSUMER_KEY,
    'consumer_secret' => TWITTER_APP_CONSUMER_SECRET,
    'server_uri' => 'https://api.twitter.com/',
    'signature_methods' => array('HMAC-SHA1', 'PLAINTEXT'),
    'request_token_uri' => 'https://api.twitter.com/oauth/request_token',
    'authorize_uri' => 'https://api.twitter.com/oauth/authorize',
    'access_token_uri' => 'https://api.twitter.com/oauth/access_token'
  );

  $store->deleteServer($server['consumer_key'], $user_id);
  // Save the server in the the OAuthStore
  $consumer_key = $store->updateServer($server, $user_id);

  // Obtain a request token from the server
  $token = OAuthRequester::requestRequestToken($consumer_key, $user_id);

  // Callback to our (consumer) site, will be called when the user finished the authorization at the server
  $callback_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/callback.php';
  session_start();
  $_SESSION[SESSION_KEY_CONSUMER] = $consumer_key;
  $_SESSION[SESSION_KEY_USER] = $user_id;

  // Now redirect to the autorization uri and get us authorized
  if (!empty($token['authorize_uri']))
  {
    // Redirect to the server, add a callback to our server
    if (strpos($token['authorize_uri'], '?'))
    {
      $uri = $token['authorize_uri'] . '&'; 
    }
    else
    {
      $uri = $token['authorize_uri'] . '?'; 
    }
    $uri .= 'oauth_token='.rawurlencode($token['token']).'&oauth_callback='.rawurlencode($callback_uri);
  }
  else
  {
    // No authorization uri, assume we are authorized, exchange request token for access token
    $uri = $callback_uri . '&oauth_token='.rawurlencode($token['token']);
  }

  header('Location: '.$uri);
  exit();
}
catch( OAuthException2 $e )
{
  echo $e->getMessage();
}

?>

