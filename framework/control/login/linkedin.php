<?php

class LinkedinLoginController extends phpsec\framework\DefaultViewController
{
	function Handle($Request)
	{
		require_once(BASE_DIR . "model/authorization/login/linkedin/linkedin.php");
		
		$linkedin = new LinkedinLogin();
		$userID = $linkedin->fetch('/v1/people/~:(id)')->id;
		
		$result = \phpsec\SQL("SELECT userid FROM links WHERE source = ? AND id = ?", array("linkedin", $userID));
		
		if(count($result) === 0)
		{
			$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/signup?source=linkedin&id=$userID";
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

?>