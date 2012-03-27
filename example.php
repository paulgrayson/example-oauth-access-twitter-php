<?php

include_once "init_oauth.php";

session_start();
$user_id = intval($_SESSION[SESSION_KEY_USER]);

$request_uri = 'https://api.twitter.com/1/statuses/home_timeline.json';
// any params to put on the request
$params = null;

try
{
  $req = new OAuthRequester($request_uri, 'GET', $params);

  // Sign the request, perform a curl request and return the results, throws OAuthException exception on an error
  $result = $req->doRequest($user_id);

  // $result is an array of the form: array ('code'=>int, 'headers'=>array(), 'body'=>string)
  echo $result['body'];

}
catch( OAuthException2 $e )
{
  echo "Exception!<br/>";
  echo "Exception: " . $e->getMessage();
}

?>

