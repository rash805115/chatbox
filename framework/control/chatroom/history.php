<?php

class ChatHistoryController extends phpsec\framework\DefaultController
{
	function Handle($Request, $userID)
	{
		$chatList = \chatbox\Chat::getChatHistory($userID);
		return require_once(BASE_DIR . "view/chat/chathistory.php");
	}
}

?>