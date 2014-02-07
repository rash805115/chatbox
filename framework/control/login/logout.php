<?php

class UserLogoutController extends phpsec\framework\DefaultViewController
{
	function Handle($Request)
	{
		try
		{
			$userSession = new phpsec\Session();
			$sessionID = $userSession->existingSession();
			
			if ($sessionID != FALSE)
			{
				$userID = \phpsec\Session::getUserIDFromSessionID($sessionID);
				$userObj = phpsec\UserManagement::forceLogIn($userID);
				phpsec\UserManagement::logOut($userObj);
			}
			else
			{
				phpsec\User::deleteAuthenticationToken();
			}
			
			$nextURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/home";
			header("Location: {$nextURL}");
		}
		catch (Exception $e)
		{
			$this->error .= $e->getMessage() . "<BR>";
			return require_once(BASE_DIR . "view/somethingwrong.php");
		}
	}
}

?>