<?php

class UserWallController extends phpsec\framework\DefaultController
{
	function Handle($Request, $userID)
	{
		$userSearched = null;
		
		if(isset($_POST['submitsearchuser']))
		{
			$result = \phpsec\SQL("SELECT USERID from user WHERE USERID = ?", array($_POST['usertosearch']));
			if(count($result) === 1)
			{
				$userSearched = $_POST['usertosearch'];
			}
			else
			{
				$userSearched = "";
			}
		}
		
		if(isset($_POST['acceptfriendreq']))
		{
			\phpsec\SQL("UPDATE friends SET `req_pending` = 0 WHERE `friend_source` = ? AND `friend_dest` = ?", array($_POST['friend_source'], $userID));
			$this->info .= "You are now friends with {$_POST['friend_source']}.<BR>";
		}
		
		return require_once(BASE_DIR . "view/user/wall/home.php");
	}
}

?>