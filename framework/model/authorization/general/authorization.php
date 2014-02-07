<?php

class Authorization
{
	final public static function check()
	{
		try
		{
			$userSession = new \phpsec\Session();
			$userSessionID = $userSession->existingSession();

			if($userSessionID)
			{
				return \phpsec\Session::getUserIDFromSessionID($userSessionID);
			}
			else
				return false;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	final public static function authorizedAction($request)
	{
		$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/" . $request;
		header("Location: $redirectURL");
	}
	
	final public static function unauthorizedAction($request)
	{
		$urlEncodedRequest = urlencode($request);
		
		$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/view/login/signin.php?request=$urlEncodedRequest";
		header("Location: $redirectURL");
	}
}

?>