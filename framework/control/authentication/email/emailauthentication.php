<?php

class EmailAuthenticationController extends phpsec\framework\DefaultViewController
{
	function Handle($Request)
	{
		if(isset($_GET['user']) && isset($_GET['token']) && (\phpsec\checkToken($_GET['token'])))
		{
			$userID = $_GET['user'];
			
			if(\phpsec\AdvancedPasswordManagement::tempPassword($userID, $_GET['token']))
			{
				\phpsec\SQL("UPDATE user SET INACTIVE = 0 WHERE USERID = ?", array($userID));
				
				$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/view/authentication/success.php";
				header("Location: $redirectURL");
			}
			else
			{
				$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/view/authentication/failure.php";
				header("Location: $redirectURL");
			}
		}
		else
		{
			$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/view/404.php";
			header("Location: $redirectURL");
		}
	}
}

?>