<?php

class ChatStartController extends phpsec\framework\DefaultController
{
	public $chatObject = null;
	
	function Handle($Request, $userID)
	{
		if(isset($_POST['groupid']))
		{
			$this->begin($_POST['userid'], $_POST['groupid']);
			$chatData = $this->chatObject->getChatData();
			$totalData = "";
			
			foreach($chatData as $eachLine)
			{
				$profilePicture = \chatbox\Friends::getUserProfilePicture($eachLine[0]);
				if($eachLine[0] == $_POST['userid'])
					$totalData .= "<div class='tooltip' align='right' style='background-color: #ADD8E6; font-family: Verdana; font-size: 15px;'>" . " " . $eachLine[2] . " " . "<img class='tooltip' src='$profilePicture' alt='$eachLine[0]' /><span class='tooltipcontent'>$eachLine[0]</span>" . "<BR><span style='font-family: Verdana; font-size: 10px;'>" . date("H:i:s  m-d-Y", intval($eachLine[1])) . "</span>" . "</div><BR><BR>";
				else
					$totalData .= "<div align='left' style='background-color: #B6B6B4; color: white; font-family: Verdana; font-size: 15px;' class='tooltip'><img class='tooltip' src='$profilePicture' alt='$eachLine[0]' /><span class='tooltipcontent'>$eachLine[0]</span>" . " " . $eachLine[2] . " " ."<BR><span style='font-family: Verdana; font-size: 10px;'>" . date("H:i:s  m-d-Y", intval($eachLine[1])) . "</span>" . "</div><BR><BR>";
			}
			
			echo $totalData;
			exit;
		}
		
		if(\chatbox\safeIn($Request) === CHATPAGE)
		{
			$this->begin($userID);
			$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/chatroom/{$this->chatObject->getGroupID()}";
			header("Location: $redirectURL");
			exit;
		}
		else
		{
			$this->begin($userID, \chatbox\safeIn($Request));
			
			if(isset($_POST['submitmessage']))
			{
				$this->addMessage($userID, str_replace(array("\r\n", "\n", "\r"), ". ", \chatbox\safeIn($_POST['message'])));
			}
			elseif(isset($_POST['submitaddmember']))
			{
				$this->addPersonToChat(\chatbox\safeIn($_POST['usertoadd']));
			}
			elseif(isset($_POST['leavechatbutton']))
			{
				$this->removePersonFromChat($userID);
				$redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/home";
				header("Location: $redirectURL");
				exit;
			}
			elseif(isset($_POST['sendchatrequest']))
			{
				\chatbox\Chat::sendRequest($userID, \chatbox\safeIn($Request));
				$this->info .= "Chat Request Sent.<BR>";
			}
			elseif(isset($_POST['groupnamesubmit']))
			{
				$this->chatObject->setGroupName($_POST['groupname']);
			}
			
			$groupID = $this->chatObject->getGroupID();
			
			if($groupID === null || $groupID == "")
			{
				$chatRequestForm = "You are currently not included in the chat. Click to send a chat request.";
				$chatRequestForm .= "
					<form method='POST' action=''>
						<input type='submit' name='sendchatrequest' value='Send Chat Request' />
					</form>
				";
				echo $chatRequestForm;
				exit;
			}
			
			$userList = $this->prepareUserList($this->chatObject->getUserList());
			$chatData = $this->chatObject->getChatData();
			$groupName = $this->chatObject->getGroupName();
			
			return require_once(BASE_DIR . "view/chat/chatroom.php");
		}
	}
	
	function prepareUserList($userList)
	{
		$UserList = array();
		$profilePic = null;
		
		foreach($userList as $user)
		{
			$UserList[$user] = $this->getProfilePic($user);
		}
		
		return $UserList;
	}
	
	function getProfilePic($userID)
	{
		$result = \phpsec\SQL("SELECT profilepic FROM xuser WHERE USERID = ?", array($userID));
		$profilePic = null;
		
		if(count($result) === 1)
		{
			$profilePic = $result[0]['profilepic'];
		}
		else
		{
			$profilePic = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/profilepic/nopic.jpeg";
		}
		
		return $profilePic;
	}
	
	function begin($userID, $groupID = "")
	{
		$userList = array($userID);
		$this->chatObject = new \chatbox\Chat($userList, $groupID);
	}
	
	function addPersonToChat($userToAdd)
	{
		$this->chatObject->addPersonToChat($userToAdd);
	}
	
	function removePersonFromChat($userToRemove)
	{
		$this->chatObject->removePersonFromChat($userToRemove);
	}
	
	function refresh()
	{
		$this->chatObject->updateChat();
	}
	
	function addMessage($messageFromUser, $message)
	{
		$this->chatObject->appendMessage($messageFromUser, $message);
	}
	
	function changeGroupName($newName)
	{
		$this->chatObject->setGroupName($newName);
	}
}

?>