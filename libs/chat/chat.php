<?php

namespace chatbox;

class Chat
{
	private $userList = null;
	private $groupName = null;
	private $groupID = null;
	private $groupSecret = null;
	private $chatData = null;
	private $chatFileLocation = null;
	
	public function __construct($userList, $groupID = "", $groupName = DEFAULTCHATGROUPNAME, $chatFileLocation = DEFAULTCHATLOCATION)
	{
		if($groupID === "")
		{
			$this->userList = $userList;
			$this->groupName = $groupName;
			$this->groupID = $this->generateGroupID();
			$this->groupSecret = $this->generateGroupSecret();
			$this->chatFileLocation = $chatFileLocation;
			$this->updateChat();
			
			\phpsec\SQL("INSERT INTO chats (groupid, groupname, groupsecret, chatlocation, users) VALUES (?, ?, ?, ?, ?)", array($this->groupID, $this->groupName, $this->groupSecret, $this->chatFileLocation, implode(",", $this->userList)));
			
			
			$result = \phpsec\SQL("SELECT chats FROM xuser WHERE USERID = ?", array($userList[0]));
			
			if($result[0]['chats'] == "" || $result[0]['chats'] == NULL)
				$chatList = array();
			else
				$chatList = explode(",", $result[0]['chats']);
			
			if(!in_array($this->groupID, $chatList))
				array_push($chatList, $this->groupID);
			
			\phpsec\SQL("UPDATE xuser SET chats = ? WHERE USERID = ?", array(implode(",", $chatList), $userList[0]));
		}
		else
		{
			$result = \phpsec\SQL("SELECT * FROM chats WHERE groupid = ?", array($groupID));
			
			if(count($result) === 1 && $this->checkIfUserAuthorized($userList[0], explode(",", $result[0]['users'])))
			{
				$this->userList = explode(",", $result[0]['users']);
				$this->groupName = $result[0]['groupname'];
				$this->groupID = $result[0]['groupid'];
				$this->groupSecret = $result[0]['groupsecret'];
				$this->chatFileLocation = $result[0]['chatlocation'];
				$this->updateChat();
			}
		}
	}
	
	private function generateGroupSecret()
	{
		return \phpsec\randstr(11);
	}
	
	private function generateGroupID()
	{
		return \phpsec\randstr(10);
	}
	
	private function checkIfUserAuthorized($userID, $userList)
	{
		if(in_array($userID, $userList))
		{
			return true;
		}
		
		return false;
	}
	
	private function putFileContents($data)
	{
		$fileFullAddress = $this->chatFileLocation . $this->groupID;
		$encrypt = new \phpsec\Crypt($this->groupSecret);
		$fileContents = $encrypt->encrypt($data);
		
		if(file_put_contents($fileFullAddress, $fileContents, LOCK_EX))
		{
			return true;
		}
		
		return false;
	}
	
	private function getFileContents()
	{
		$fileFullAddress = $this->chatFileLocation . $this->groupID;
		
		if(file_exists($fileFullAddress))
		{
			$decrypt = new \phpsec\Crypt($this->groupSecret);
			
			if(($fileContents = file_get_contents($fileFullAddress)) !== false)
			{
				$fileContents = $decrypt->decrypt($fileContents);
			}
			
			return $fileContents;
		}
		
		return false;
	}
	
	private function prepareMessage($userID, $message)
	{
		$currentTime = \phpsec\time();
		$message = "\[$userID\[$currentTime\[$message";
		return $message;
	}
	
	private function closeChat()
	{
		if($this->putFileContents($this->chatData))
		{
			$this->userList = null;
			$this->groupName = null;
			$this->groupID = null;
			$this->groupSecret = null;
			$this->chatData = null;
			$this->chatFileLocation = null;
			
			return true;
		}
		
		return false;
	}
	
	private function renderChatData()
	{
		$eachLine = explode("\n", $this->chatData);
		array_shift($eachLine);
		$count = 0;
		
		foreach($eachLine as $line)
		{
			$metadata = explode("\[", $line);
			array_shift($metadata);
			$eachLine[$count] = array();
			$eachLine[$count][0] = $metadata[0];
			$eachLine[$count][1] = $metadata[1];
			$eachLine[$count][2] = $metadata[2];
			$count++;
		}
		
		return $eachLine;
	}
	
	final public function reOpenChat()
	{
		$this->addPersonToChat($this->userList);
	}
	
	final public function isChatOpen()
	{
		$result = \phpsec\SQL("SELECT users from chats WHERE groupid = ?", array($this->groupID));
		
		if(count($result) == 1)
		{
			$userList = explode(",", $result[0]['users']);
			
			if(count($userList) === 0)
			{
				return false;
			}
			
			return true;
		}
		
		return false;
	}
	
	final public function updateChat()
	{
		if(($this->chatData = $this->getFileContents()) === false)
		{
			$this->chatData = "";
		}
	}
	
	final public function appendMessage($userID, $message)
	{
		if(in_array($userID, $this->userList))
		{
			$this->chatData .= "\n" . $this->prepareMessage($userID, $message);
			$this->putFileContents($this->chatData);
		}
		else
			return false;
	}
	
	final public static function sendRequest($userID, $groupID)
	{
		$result = \phpsec\SQL("SELECT requests FROM chats WHERE groupid = ?", array($groupID));
		
		if($result[0]['requests'] == "" || $result[0]['requests'] == NULL)
			$reqList = array();
		else
			$reqList = explode(",", $result[0]['requests']);
			
		if(!in_array($userID, $reqList))
			array_push($reqList, $userID);
			
		\phpsec\SQL("UPDATE chats SET requests = ? WHERE groupid = ?", array(implode(",", $reqList), $groupID));
	}
	
	final public function acceptRequest($userID)
	{
		$result = \phpsec\SQL("SELECT requests FROM chats WHERE groupid = ?", array($this->groupID));
		
		if($result[0]['requests'] == "" || $result[0]['requests'] == NULL)
			$reqList = array();
		else
			$reqList = explode(",", $result[0]['requests']);
			
		if(($key = array_search($userID, $reqList)) !== false)
		{
			unset($reqList[$key]);
			\phpsec\SQL("UPDATE chats SET requests = ? WHERE groupid = ?", array(implode(",", $reqList), $this->groupID));
			$this->addPersonToChat($userID);
		}
	}
	
	final public static function allPendingRequests($groupID)
	{
		$result = \phpsec\SQL("SELECT requests FROM chats WHERE groupid = ?", array($groupID));
		$allReq = array();
		
		if($result[0]['requests'] == "" || $result[0]['requests'] == NULL)
			$reqList = array();
		else
			$reqList = explode(",", $result[0]['requests']);
			
		foreach($reqList as $req)
		{
			$profilePic = \chatbox\Friends::getUserProfilePicture($req);
			$allReq[$req] = $profilePic;
		}
			
		return $allReq;
	}
	
	final public function rejectRequest($userID)
	{
		$result = \phpsec\SQL("SELECT requests FROM chats WHERE groupid = ?", array($this->groupID));
		
		if($result[0]['requests'] == "" || $result[0]['requests'] == NULL)
			$reqList = array();
		else
			$reqList = explode(",", $result[0]['requests']);
			
		if(($key = array_search($userID, $reqList)) !== false)
		{
			unset($reqList[$key]);
			\phpsec\SQL("UPDATE chats SET requests = ? WHERE groupid = ?", array(implode(",", $reqList), $this->groupID));
		}
	}
	
	final public function addPersonToChat($userID)
	{
		if(!\phpsec\UserManagement::userExists($userID))
			return false;
		
		$pendingRequests = Chat::allPendingRequests($this->groupID);
		if(isset($pendingRequests[$userID]))
		{
			$this->acceptRequest($userID);
		}
		else
		{
			if(!in_array($userID, $this->userList))
			array_push($this->userList, $userID);
		
			\phpsec\SQL("UPDATE chats SET users = ? WHERE groupid = ?", array(implode(",", $this->userList), $this->groupID));
			
			$result = \phpsec\SQL("SELECT chats FROM xuser WHERE USERID = ?", array($userID));
			
			if($result[0]['chats'] == "" || $result[0]['chats'] == NULL)
				$chatList = array();
			else
				$chatList = explode(",", $result[0]['chats']);
			
			if(!in_array($this->groupID, $chatList))
				array_push($chatList, $this->groupID);
			
			\phpsec\SQL("UPDATE xuser SET chats = ? WHERE USERID = ?", array(implode(",", $chatList), $userID));
		}
	}
	
	final public function removePersonFromChat($userID)
	{
		if(($key = array_search($userID, $this->userList)) !== false)
			unset($this->userList[$key]);
		
		\phpsec\SQL("UPDATE chats SET users = ? WHERE groupid = ?", array(implode(",", $this->userList), $this->groupID));
		
		$result = \phpsec\SQL("SELECT chats FROM xuser WHERE USERID = ?", array($userID));
		
		if($result[0]['chats'] == "" || $result[0]['chats'] == NULL)
			$chatList = array();
		else
			$chatList = explode(",", $result[0]['chats']);
		
		if(($key = array_search($this->groupID, $chatList)) !== false)
			unset($chatList[$key]);
		
		\phpsec\SQL("UPDATE xuser SET chats = ? WHERE USERID = ?", array(implode(",", $chatList), $userID));
		
		if(count($this->userList) === 0)
		{
			$this->closeChat();
		}
	}
	
	final public function getChatData()
	{
		$data = $this->renderChatData();
		return $data;
	}
	
	final public function getUserList()
	{
		return $this->userList;
	}
	
	final public function getGroupName()
	{
		return $this->groupName;
	}
	
	final public function getGroupID()
	{
		return $this->groupID;
	}
	
	final public function getFileLocation()
	{
		return $this->chatFileLocation;
	}
	
	final public function setGroupName($name)
	{
		$this->groupName = $name;
		\phpsec\SQL("UPDATE chats SET groupname = ? WHERE groupid = ?", array($this->groupName, $this->groupID));
	}
	
	final public function deleteChatRecord()
	{
		$fileFullAddress = $this->chatFileLocation . $this->groupID;
		
		if(unlink($fileFullAddress))
		{
			$result = \phpsec\SQL("SELECT users FROM chats WHERE groupid = ?", array($this->groupID));
			$userList = explode(",", $result[0]['chats']);
			foreach($userList as $userID)
			{
				$result = \phpsec\SQL("SELECT chats FROM xuser WHERE USERID = ?", array($userID));
				
				if($result[0]['chats'] == "" || $result[0]['chats'] == NULL)
					$chatList = array();
				else
					$chatList = explode(",", $result[0]['chats']);
				
				if(($key = array_search($this->groupID, $chatList)) !== false)
					unset($chatList[$key]);
				
				\phpsec\SQL("UPDATE xuser SET chats = ? WHERE USERID = ?", array(implode(",", $chatList), $userID));
			}
			
			\phpsec\SQL("DELETE FROM chats WHERE groupid = ?", array($this->groupID));
			$this->userList = null;
			$this->groupName = null;
			$this->groupID = null;
			$this->groupSecret = null;
			$this->chatData = null;
			$this->chatFileLocation = null;
			
			return true;
		}
		
		return false;
	}
	
	final public static function getChatHistory($userID)
	{
		$result = \phpsec\SQL("SELECT chats FROM xuser WHERE USERID = ?", array($userID));
		
		if($result[0]['chats'] == "" || $result[0]['chats'] == NULL)
			$chatList = array();
		else
			$chatList = explode(",", $result[0]['chats']);
		
		return $chatList;
	}
	
	final public static function getChatDataFromID($groupID)
	{
		$result = \phpsec\SQL("SELECT groupname, users FROM chats WHERE groupid = ?", array($groupID));
		$details = array();
		$details[0] = $result[0]['groupname'];
		$details[1] = explode(",", $result[0]['users']);
		
		return $details;
	}
}

?>