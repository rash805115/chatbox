<?php

class SelfLoginController extends phpsec\framework\DefaultViewController
{
	function Handle($Request)
	{
		try
		{
			$config = require_once (BASE_DIR . "config/config.php");
			$userID = \phpsec\User::checkRememberMe();
			
			if (!$userID)
			{
				if ((isset($_POST['signin_submit'])))
				{
					if( (isset($_POST['username'])) && (\phpsec\User::isUserIDValid($_POST['username'])) && (isset($_POST['password'])) && ($_POST['password'] != "") )
					{
						try
						{
							$userID = $_POST['username'];
							$userObj = phpsec\UserManagement::logIn($_POST['username'], $_POST['password']);
						}
						catch (phpsec\WrongPasswordException $e)
						{
							if ($config['BRUTE_FORCE_DETECTION'] === "ON")
							{
								try
								{
									new phpsec\AdvancedPasswordManagement($_POST['username'], $_POST['password'], TRUE);
								}
								catch (phpsec\BruteForceAttackDetectedException $ex)
								{
									\phpsec\User::lockAccount($_POST['username']);
									$this->error .= "Brute Force Attack detected on this account. This account has now been locked. If its not your fault, then please contact the administrator." . "<BR>";
								}
							}

							$this->error .= "Incorrect Username/Password combination!" . "<BR>";
							return require_once (BASE_DIR . "view/login/signin.php");
						}
						catch (phpsec\UserAccountInactive $e)
						{
							
						}

						if( (isset($_POST['remember-me'])) && ($_POST['remember-me'] == "on") )
						{
							if (phpsec\HttpRequest::isHTTPS())
							{
								phpsec\User::enableRememberMe($_POST['username']);
							}
							else
							{
								phpsec\User::enableRememberMe($_POST['username'], FALSE, TRUE);
							}
						}
					}
					else
						$this->error .= "Empty fields are not allowed. Please fill the required areas." . "<BR>";
				}
				else
					return require_once (BASE_DIR . "view/login/signin.php");
			}
			
			$userSession = new \phpsec\Session();
			
			try
			{
				$sessionID = $userSession->existingSession();
				
				if ($sessionID)
				{
					$userSessionID = $userSession->rollSession();
				}
				else
				{
					$userSessionID = $userSession->newSession($userID);
				}

				$userObj = phpsec\UserManagement::forceLogIn($userID);

				if ($userObj->isPasswordExpired() )
				{
					$this->info .= "Its been too long since you have changed your password. For security reasons, please change your password." . "<BR>";
				}
				
				$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/home";
				header("Location: $redirectURL");
			}
			catch (\phpsec\SessionExpired $e)
			{
				$this->error .= $e->getMessage() . "<BR>";
				\phpsec\User::deleteAuthenticationToken();
			}
		}
		catch (Exception $e)
		{
			$this->error .= $e->getMessage() . "<BR>";
		}
		
		return require_once (BASE_DIR . "view/login/signin.php");
	}
}

?>