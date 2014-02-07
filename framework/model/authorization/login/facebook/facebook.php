<?php

require_once (__DIR__ . "/../link.php");
require_once (__DIR__ . '/facebook_php_sdk/facebook.php');

class FacebookLogin implements Link
{
	public $facebook = null;
	private static $API_KEY = null;
	private static $API_SECRET = null;
	
	final public function __construct()
	{
		FacebookLogin::$API_KEY = \phpsec\confidentialString(':QzE4VqjKDK0BO0Y18kk7DTfNtU2FJo+g4/l6uR4Q200=');
		FacebookLogin::$API_SECRET = \phpsec\confidentialString(':hKqrjQqUeAQ+gJP2sdNwGxhYDr87i7Zy4/sme9eb23+qIlsPiRENWxCYfaTWcnk7PzJre5/gZSJaylHQHplUDw==');
	}
	
	final public function fetch($resource, $source = "/me", $optionalRenderingData = "")
	{
		$config = array(
		    "appId"			=>	FacebookLogin::$API_KEY,
		    "secret"			=>	FacebookLogin::$API_SECRET,
		    "allowSignedRequest"	=>	false,
		    "fileUpload"		=>	false,
		);
		
		$this->facebook = new Facebook($config);
		$userID = $this->facebook->getUser();
		
		if($userID)
		{
			try
			{
				if($source === "/me")
					$userProfile = $this->facebook->api($source, "GET");
				else
					$userProfile = $this->facebook->api($source, "GET", $optionalRenderingData);
					
				return $userProfile[$resource];
			}
			catch(FacebookApiException $e)
			{
				return false;
			}
		}
		
		return false;
	}
}

?>