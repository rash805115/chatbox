<?php
//base dir
//error handling

require_once (__DIR__ . "/../link.php");

class LinkedinLogin implements Link
{
	public static $API_KEY = null;
	public static $API_SECRET = null;
	public static $REDIRECT_URI = null;
	public static $SCOPE = null;
	
	final public function __construct()
	{
		LinkedinLogin::$API_KEY = \phpsec\confidentialString(':5iCf9beKilbTYNHqupLmTm3QFEllyJq4GnaPYaCyzzk=');
		LinkedinLogin::$API_SECRET = \phpsec\confidentialString(':O5W26XOF8xtPPcP2fFkE9PEvi5e7ersADRvLO0pzmd0=');
		LinkedinLogin::$REDIRECT_URI = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/login/linkedin?request=" . $_GET['request'];
		LinkedinLogin::$SCOPE = "r_basicprofile";
	}
	
	final public function getAuthorizatoinCode()
	{
		$params = array(
			"response_type"	=>	"code",
			"client_id"	=>	LinkedinLogin::$API_KEY,
			"scope"		=>	LinkedinLogin::$SCOPE,
			"state"		=>	phpsec\randstr(),
			"redirect_uri"	=>	LinkedinLogin::$REDIRECT_URI,
		);

		$url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
		$_SESSION['state'] = $params['state'];

		header("Location: $url");
		exit;
	}
	
	final public function getAccessToken()
	{
		$params = array(
			"grant_type"	=>	"authorization_code",
			"client_id"	=>	LinkedinLogin::$API_KEY,
			"client_secret"	=>	LinkedinLogin::$API_SECRET,
			"code"		=>	$_GET['code'],
			"redirect_uri"	=>	LinkedinLogin::$REDIRECT_URI,
		);									
	
		$url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
		$context = stream_context_create(array("https"	=>	array("method"	=>	"POST")));

		$response = file_get_contents($url, false, $context);
		$token = json_decode($response);

		$_SESSION['access_token'] = $token->access_token;
		$_SESSION['expires_in'] = $token->expires_in;
		$_SESSION['expires_at'] = \phpsec\time() + $_SESSION['expires_in'];

		return true;
	}
	
	final public function fetch($resource)
	{
		session_name('linkedin');
		session_start();
		
		if(isset($_GET['error']))
		{
			$this->error .= $_GET['error'] . ": " . $_GET['error_description'];
			exit;
		}
		elseif(isset($_GET['code']))
		{
			if($_SESSION['state'] === $_GET["state"])
			{
				$this->getAccessToken();
			}
			else
			{
				$this->error .= CSRF;
				exit;
			}
		}
		else
		{
			if((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at']))
			{
				$_SESSION = array();
			}

			if(empty($_SESSION['access_token']))
			{
				$this->getAuthorizatoinCode();
			}
		}
		
		$params = array(
		    'oauth2_access_token'	=>	$_SESSION['access_token'],
		    'format'			=>	'json',
		);

		$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
		$context = stream_context_create(array("https"	=>	array("method"	=>	"GET")));

		$response = file_get_contents($url, false, $context);
		
		$user = json_decode($response);
		return $user;
	}
}

?>