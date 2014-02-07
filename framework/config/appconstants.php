<?php

$basePath = realpath(__DIR__ . "/../");
define("BASE_DIR", $basePath . "/");



//location
define("DEFAULTCHATLOCATION", BASE_DIR . "model/chats/");



//filenames
define("DEFAULTCHATGROUPNAME", "Untitled");


//pages
define("INDEXPAGE", "home");
define("CHATPAGE", "chatroom");



//page titles
define("SIGNINTITLE", "Sign In");
define("CHATROOMTITLE", "ChatRoom");
define("CHATHISTORYTITLE", "Chat History");
define("HOMETITLE", "Home");






//strings
define("DEFAULTMESSAGEINTEXTAREA", "Type Your Message Here.");
define("LEAVECHATROOM", "Leave This Chat Room");
define("SUBMITMESSAGE", "Submit");




define("SUCCESS", "Success");
define("FAILURE", "Failure");





//attacks
define("CSRF", "CSRF attack detected. To be on the safe side, please do not use the website for some time.");




//severity level
define("SERVER", 10);
define("FATAL", 9);
define("CRITICAL", 8);
define("HIGH", 7);
define("MEDIUM", 6);
define("LOW", 5);
define("WARNING", 4);
define("INFO", 3);
define("DEBUG", 2);
define("TRACE", 1);

?>