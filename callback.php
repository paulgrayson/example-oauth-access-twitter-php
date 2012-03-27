<?php
include_once "init_oauth.php";

if( isset($_GET['denied']) )
{
  // authorization was denied
  header( 'Location: '. DENIED_PATH );
  exit();
}
else
{
  $oauth_token = $_GET['oauth_token'];

  session_start();
  $consumer_key = $_SESSION[SESSION_KEY_CONSUMER];
  $user_id = intval($_SESSION[SESSION_KEY_USER]);

  try
  {
      OAuthRequester::requestAccessToken($consumer_key, $oauth_token, $user_id);
      header( 'Location: '. SUCCESS_PATH );
      exit();
  }
  catch( OAuthException2 $e )
  {
      // Something wrong with the oauth_token.
      // Could be:
      // 1. Was already ok
      // 2. We were not authorized
// TODO: handle error 
      echo "Exception" . $e->getMessage();
  }
}
?>

