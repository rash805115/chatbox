<?php

class SignupController extends phpsec\framework\DefaultViewController
{
	function Handle($Request)
	{
		if(isset($_POST['submit']) && ($_POST['userid'] != "") && ($_POST['pass'] != "") && ($_POST['email'] != ""))
		{
			if(phpsec\BasicPasswordManagement::$passwordStrength > phpsec\BasicPasswordManagement::strength($_POST['pass']))
			{
				$this->error .= "This password is not strong. Please try a different password.<BR>";
			}
			elseif(!\phpsec\checkEmail($_POST['email']))
			{
				$this->error .= "This email-id does not looks valid. Please recheck your email-id.<BR>";
			}
			else
			{
				$sourceSet = false;
			
				if(isset($_GET['source']) && isset($_GET['id']))
				{
					$result = \phpsec\SQL("SELECT USERID FROM user WHERE `P_EMAIL` = ?", array($_POST['email']));
				
					if(count($result) === 1)
					{
						\phpsec\SQL("INSERT INTO links (source, id, userid) VALUES (?, ?, ?)", array($_GET['source'], $_GET['id'], $result[0]['USERID']));
						
						$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/login/{$_GET['source']}";
						header("Location: $redirectURL");
						exit;
					}
					else
						$sourceSet = true;
				}
				
				try
				{
					\phpsec\UserManagement::createUser($_POST['userid'], $_POST['pass'], $_POST['email']);
					if($_GET['source'] === "linkedin")
					{
						require_once(BASE_DIR . "model/authorization/login/linkedin/linkedin.php");
						$_GET['request'] = "";
						$linkedin = new LinkedinLogin();
						$user = $linkedin->fetch('/v1/people/~:(firstName,lastName,pictureUrl)');
						
						\phpsec\SQL("INSERT INTO xuser(USERID, `FIRST_NAME`, `LAST_NAME`, profilepic) VALUES (?, ?, ?, ?)", array($_POST['userid'], $user->firstName, $user->lastName, $user->pictureUrl));
					}
					elseif($_GET['source'] === "facebook")
					{
						require_once(BASE_DIR . "model/authorization/login/facebook/facebook.php");
						$facebook = new FacebookLogin();
						$firstName = $facebook->fetch("first_name");
						$lastName = $facebook->fetch("last_name"); 
						$profilepic = $facebook->fetch("data", "/me/picture", array('redirect' =>	false, 'height' =>	'200', 'width' => '200', 'type' =>	'normal'));
						$profilepic = $profilepic['url'];
						
						\phpsec\SQL("INSERT INTO xuser(USERID, `FIRST_NAME`, `LAST_NAME`, profilepic) VALUES (?, ?, ?, ?)", array($_POST['userid'], $firstName, $lastName, $profilepic));
					}
					
					if($sourceSet)
					{
						\phpsec\SQL("INSERT INTO links (source, id, userid) VALUES (?, ?, ?)", array($_GET['source'], $_GET['id'], $_POST['userid']));
					}
					
					require_once(BASE_DIR . "model/authentication/email/generateemailauth.php");
					$generateRequest = new GenerateEmailAuthentication($_POST['userid'], $_POST['email']);
					$generateRequest->generateRequest();
					
					return require_once(BASE_DIR . "view/authentication/emailsent.php");
				}
				catch(Exception $e)
				{
					$this->error .= $e->getMessage();
				}
			}
		}
		else
		{
			$this->error .= "Empty fields are not allowed.<BR>";
		}
		
		return require_once(BASE_DIR . "view/login/signup.php");
	}
}

?>