<?php

namespace chatbox;

class Friends
{
	final public static function addFriend($user1, $user2)
	{
		if($user1 !== $user2 && (!Friends::areFriends($user1, $user2)))
		{
			\phpsec\SQL("INSERT INTO friends (`friend_source`, `friend_dest`, date) VALUES (?, ?, ?)", array($user1, $user2, \phpsec\time()));
			return true;
		}
		
		return false;
	}
	
	final public static function unFriend($user1, $user2)
	{
		if(Friends::areFriends($user1, $user2))
		{
			\phpsec\SQL("DELETE FROM friends WHERE `friend_source` = ? AND `friend_dest` = ?", array($user1, $user2));
			\phpsec\SQL("DELETE FROM friends WHERE `friend_source` = ? AND `friend_dest` = ?", array($user2, $user1));
			return true;
		}
		
		return false;
	}
	
	final public static function areFriends($user1, $user2)
	{
		$result = \phpsec\SQL("SELECT `friend_source`, `friend_dest` FROM friends WHERE `friend_source` = ? AND `friend_dest` = ?", array($user1, $user2));
		
		if(count($result) === 0)
		{
			$result = \phpsec\SQL("SELECT `friend_source`, `friend_dest` FROM friends WHERE `friend_source` = ? AND `friend_dest` = ?", array($user2, $user1));
			
			if(count($result) === 0)
			{
				return false;
			}
		}
		
		return true;
	}
	
	final public static function getUserProfilePicture($userID)
	{
		$result = \phpsec\SQL("SELECT profilepic FROM xuser WHERE USERID = ?", array($userID));
		
		if(count($result) === 1)
		{
			return $result[0]['profilepic'];
		}
		
		return false;
	}
	
	final public static function myFriends($userID)
	{
		$friendList = \phpsec\SQL("SELECT `friend_source`, `friend_dest` FROM friends WHERE (`friend_source` = ? OR `friend_dest` = ?) AND `req_pending` = 0", array($userID, $userID));
		$friendsWithPicture = array();
		
		foreach($friendList as $friend)
		{
			$theFriend = null;
			
			if($friend['friend_source'] === $userID)
			{
				$theFriend = $friend['friend_dest'];
			}
			else
			{
				$theFriend = $friend['friend_source'];
			}
			
			$friendProfilePicture = Friends::getUserProfilePicture($theFriend);
			$friendsWithPicture[$theFriend] = $friendProfilePicture;
		}
		
		return $friendsWithPicture;
	}
	
	final public static function pendingRequests($userID)
	{
		$result = \phpsec\SQL("SELECT `friend_source` FROM friends WHERE `friend_dest` = ? AND `req_pending` = 1", array($userID));
		return $result;
	}
}

?>