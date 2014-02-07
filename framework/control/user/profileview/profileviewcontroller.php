<?php

class ProfileViewController extends phpsec\framework\DefaultViewController
{
	function Handle($Request)
	{
		$friendUserID = $Request;
		$result = \phpsec\SQL("SELECT `first_name`, `last_name`, profilepic FROM xuser WHERE USERID = ?", array($friendUserID));
		$firstName = $result[0]['first_name'];
		$lastName = $result[0]['last_name'];
		$title = $firstName . " " . $lastName . "'s Profile";
		$profilepic = $result[0]['profilepic'];
		
		if(isset($_POST['addfriendsubmit']))
		{
			require_once(BASE_DIR . "control/authorization.php");
			
			$Request = substr(\phpsec\HttpRequest::URL(), strpos(\phpsec\HttpRequest::URL(), \phpsec\HttpRequest::InternalPath()));
			$autorization = new \AuthorizationController($Request);
			$userID = $autorization->Handle($Request, "");
			
			if(!\chatbox\Friends::addFriend($userID, $friendUserID))
			{
				$this->error .= "You are already friends with this person.<BR>";
			}
			else
			{
				$this->info .= "Friend Request Sent.<BR>";
			}
		}
		
		if(isset($_POST['unfriendsubmit']))
		{
			require_once(BASE_DIR . "control/authorization.php");
			
			$Request = substr(\phpsec\HttpRequest::URL(), strpos(\phpsec\HttpRequest::URL(), \phpsec\HttpRequest::InternalPath()));
			$autorization = new \AuthorizationController($Request);
			$userID = $autorization->Handle($Request, "");
			
			if(!\chatbox\Friends::unFriend($userID, $friendUserID))
			{
				$this->error .= "You need to be a friend to unfriend this person.<BR>";
			}
			else
			{
				$this->info .= "Deleted From your friend list.<BR>";
			}
		}
		
		return require_once(BASE_DIR . "view/user/profileview/profileview.php");
	}
}

?>