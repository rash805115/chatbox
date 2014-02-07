<?php

class FacebookLoginController extends phpsec\framework\DefaultViewController
{
	function Handle($Request)
	{
		require_once(BASE_DIR . "model/authorization/login/facebook/facebook.php");
		
		$facebook = new FacebookLogin();
		$userID = $facebook->fetch("id");
		
		if(!$userID)
		{
			$facebookLoginURL = $facebook->facebook->getLoginUrl();
			header("Location: $facebookLoginURL");
		}
		else
		{
			$result = \phpsec\SQL("SELECT userid FROM links WHERE source = ? AND id = ?", array("facebook", $userID));
		
			if(count($result) === 0)
			{
				$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/signup?source=facebook&id=$userID";
				header("Location: $redirectURL");
				exit;
			}
			else
			{
				$userID = $result[0]['userid'];
			}
			
			$userSession = new \phpsec\Session();
			$userSession->newSession($userID);
			
			if(isset($_GET['request']))
				$Request = urldecode($_GET['request']);
			else
				$Request = INDEXPAGE;
			
			$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/" . $Request;
			header("Location: $redirectURL");
		}
	}
}

?>