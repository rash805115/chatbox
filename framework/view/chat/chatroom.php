<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<?php

$jsLink = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/js/";
$leaveButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/leavechat.png";
$addUserButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/adduser.png";
$updateButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/update.png";
$submitChatButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/submitchat.png";

?>
  <title><?php echo \chatbox\safeEcho(APPNAME) . " - " .
\chatbox\safeEcho(CHATROOMTITLE); ?></title>

  
  
  <style type="text/css">
#chatdiv {
  border: 2px solid black;
  display: block;
  position: absolute;
  width: 60%;
  height: 90%;
}
#middle {
  border:  none;
  display: block;
  position: fixed;
  width: 39%;
  height: 77%;
  margin-left: 21%;
  margin-top: 6%;
}
#leftsidebar {
  border:  none;
  display: block;
  position: fixed;
  width: 20%;
  height: 77%;
  margin-top: 6%;
}
#header {
  border-style: none none solid;
  border-color: #999999;
  border-width: 0px 0px 2px;
  display: block;
  position: fixed;
  width: 60%;
  height: 11.4%;
}
#groupinfo {
  display: block;
  position: fixed;
  width: 30%;
  height: 12%;
}
#leave {
  border-left: 2px solid #999999;
  display: block;
  position: fixed;
  width: 30%;
  height: 12%;
  margin-left: 30%;
}
#groupinformation {
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
  font-family: Verdana;
}
#chatentry {
  display: block;
  position: fixed;
  width: 39%;
  height: 20%;
  margin-top: 29%;
}
#entrybay {
  display: block;
  position: fixed;
  width: 34%;
  height: 19.8%;
}
#submissionbay {
  display: block;
  position: relative;
  width: 10%;
  height: 100%;
  margin-left: 90%;
}
#chatdata {
  border: 2px solid #999999;
  overflow: scroll;
  display: block;
  position: fixed;
  width: 38.5%;
  height: 55%;
}

#chatdata div img {
  width: 1cm;
  height: 1cm;
}


#memberlist {
  display: block;
  position: fixed;
  width: 20%;
  height: 46%;
  margin-top: 0%;
}
#pendingrequests {
  display: block;
  position: fixed;
  width: 20%;
  height: 30%;
  margin-top: 23.5%;
  border-top-color: #999999;
}
#addmember {
  border-top: 2px solid #999999;
  display: block;
  position: fixed;
  width: 20%;
  margin-top: 0.3%;
  height: 7%;
}
#members {
  border-top: 2px solid #999999;
  border-bottom: 2px solid #999999;
  display: block;
  position: fixed;
  width: 20%;
  height: 37%;
  margin-top: 4.2%;
}
#pendingrequesttitle {
  border-bottom: 2px solid #999999;
  display: block;
  position: fixed;
  width: 20%;
  height: 4%;
}
#pendingrequestbody {
  overflow-y: scroll;
  display: block;
  position: fixed;
  width: 20%;
  height: 25.4%;
  margin-top: 2.1%;
}
#memberstitle {
  border-bottom: 2px solid #999999;
  display: block;
  position: fixed;
  width: 20%;
  height: 1.8%;
}
#membersbody {
  overflow-y: scroll;
  display: block;
  position: fixed;
  height: 36%;
  width: 20%;
  margin-top: 1%;
}
#submitmessage {
  background-image: url(<?php echo $submitChatButton; ?>);
  background-repeat: no-repeat;
  background-color: transparent;
  display: block;
  position: relative;
  width: 64px;
  height: 155px;
}
#entrybay textarea {
  border-right: 2px solid #999999;
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
  max-width: 100%;
  max-height: 100%;
  font-family: Verdana;
}
#groupname {
  display: block;
  position: fixed;
  margin-left: 2.5cm;
  margin-top: -0.5cm;
  width: 8cm;
  font-family: Verdana;
}
#groupnamesubmit {
  display: block;
  position: fixed;
  margin-top: -0.5cm;
  margin-left: 11.5cm;
  background-image: url(<?php echo $updateButton; ?>);
  background-repeat: no-repeat;
  background-color: transparent;
  background-position: left top;
  width: 82px;
  height: 35px;
}
#groupinformation tr {
  max-width: 0.4cm;
}
#leavechatbutton {
  background-image: url(<?php echo $leaveButton; ?>);
  background-repeat: no-repeat;
  display: block;
  position: relative;
  width: 160px;
  height: 66px;
  background-color: transparent;
  margin-top: 0.2cm;
  margin-left: 8cm;
}
#submitaddmember {
  background-image: url(<?php echo $addUserButton; ?>);
  background-repeat: no-repeat;
  background-position: left center;
  width: 2.2cm;
  height: 0.9cm;
}

#membersbody table {
  border-style: none none none solid;
  border-width: 0px 0px 0px 1px;
  display: block;
  position: relative;
  border-collapse: separate;
  border-spacing: 10px 0px;
}
#membersbody table tr td {
  border-style: none solid solid none;
  display: block;
  position: relative;
  width: 2cm;
  height: 2cm;
  border-right-width: 1px;
  border-bottom-width: 1px;
}
#membersbody table tr td img {
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
}

#pendingrequestbody table {
  border-style: none none none solid;
  border-width: 0px 0px 0px 1px;
  display: block;
  position: relative;
  border-collapse: separate;
  border-spacing: 10px 0px;
}
#pendingrequestbody table tr td {
  border-style: none solid solid none;
  display: block;
  position: relative;
  width: 2cm;
  height: 2cm;
  border-right-width: 1px;
  border-bottom-width: 1px;
}
#pendingrequestbody table tr td img {
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
}

#availableemoticons {
	display: block;
	position: absolute;
	top: 100px;
	left: 1200px;
	border: 1px solid black;
	font-family: Verdana;
	font-size: 15px;
	color: rgb(36, 72, 182);
	max-width: 10cm;
	max-height: 4cm;
}

.tooltip:hover .tooltipcontent {
    display: block;
}


.tooltipcontent {
    display: none;
    background: #FFDB58;
    margin-left: 28px;
    padding: 10px;
    position: absolute;
    z-index: 1000;
    width:auto;
    height:auto;
}



  </style>
</head><body>
<?php include_once(BASE_DIR . "view/include.php"); ?>
<div style="top: 140px; left: 135px;" id="chatdiv">
<div id="header">
<div id="groupinfo">
<table id="groupinformation">
  <tbody>
    <tr>
      <td><small><span style="font-family: Verdana; color: rgb(36, 72, 182); font-style: italic;">Your
ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></small><span id='useriduser'><?php echo \chatbox\safeEcho($userID); ?></span>
      </td>
    </tr>
    <tr>
<?php $changeGroupNameForm = "<form method='POST' action=''>

<input type='text' name='groupname' id='groupname' maxlength='256' value='$groupName' />

<input type='submit' name='groupnamesubmit' id='groupnamesubmit' value='' />

</form>";

?>
      <td><small><span style="font-family: Verdana; color: rgb(36, 72, 182);">Group
Name:&nbsp;</span></small><?php echo $changeGroupNameForm; ?> </td>
    </tr>
    <tr>
      <td><small><span style="font-family: Verdana; color: rgb(36, 72, 182); font-style: italic;">Group
ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></small><span id='groupiduser'><?php echo \chatbox\safeEcho($groupID); ?></span>
      </td>
    </tr>
  </tbody>
</table>
</div>
<div id="leave">
<form name="leavechat" id="leavechat" method="post" action=""> <input name="leavechatbutton" id="leavechatbutton" value="" type="submit"></form>
</div>
</div>
<div id="leftsidebar">
<div id="memberlist">
<div id="addmember"> <small><span style="font-family: Verdana; font-style: italic; color: rgb(36, 72, 182);">Type
username to add:</span></small>
<form method="post" action="" name="addmemberform" id="addmemberform"> <input name="usertoadd" id="usertoadd" maxlength="32" type="text"> <input name="submitaddmember" id="submitaddmember" value="" type="submit"> </form>
</div>
<div id="members">
<div style="font-family: Verdana; font-weight: bold; font-style: italic; color: rgb(36, 72, 182);" id="memberstitle"><small><small>Chat Members:</small></small></div>
<div id="membersbody">
<table style="text-align: left;" border="1" cellpadding="1" cellspacing="1">
  <tbody>
<?php

$onEachRow = 4;
$count = 0;
$table = "<tr>";
foreach($userList as $user=>$pic)
{
	if($count < $onEachRow)
	{
		$table .= "<td class='tooltip' style='vertical-align: top;'><img class='tooltip' class='tooltip' src='$pic' alt='$user' /><span class='tooltipcontent'>$user</span></td>";
		$count++;
	}
	else
	{
		$table .= "</tr><tr>";
		$count = 0;
	}
}
echo $table;

?>
  </tbody>
</table>
</div>
</div>
</div>
<div id="pendingrequests">
<div style="font-family: Verdana;" id="pendingrequesttitle"><small><small><span style="font-weight: bold; color: rgb(36, 72, 182); font-style: italic;">Pending
Chat Requests:</span> Type their user-id's
in the "add member" text area to add them to this chat.</small></small></div>
<div id="pendingrequestbody">
<table style="text-align: left;" border="1" cellpadding="1" cellspacing="1">
  <tbody>
<?php $requests = \chatbox\Chat::allPendingRequests($groupID);

$onEachRow = 4;
$count = 0;
$table = "<tr>";
foreach($requests as $user=>$pic)

{

if($count < $onEachRow)
	{
		$table .= "<td class='tooltip' style='vertical-align: top;'><img src='$pic' class='tooltip' alt='$user' /><span class='tooltipcontent'>$user</span></td>";
		$count++;
	}
	else
	{
		$table .= "</tr><tr>";
		$count = 0;
	}

}
echo $table;
?>
  </tbody>
</table>
</div>
</div>
</div>
<div id="middle">
<div id="chatdata"></div>
<div id="chatentry">
<form id="chatentryform" name="chatentryform" method="post" action="">
  <div id="entrybay"><textarea name="message"></textarea></div>
  <div id="submissionbay"> <input name="submitmessage" id="submitmessage" value="" type="submit"> </div>
</form>
</div>
</div>

<div id ="availableemoticons">
To put an emoticon, enter the symbol and give a space before and after that emoticon. Available emoticons are:<BR>
<pre>:)  :(  :'(  :p  ;)  :D  ^_^  :*  (heart)</pre>
</div>
</div>

<script type="text/javascript" src="<?php echo $jsLink . "chatroomfunctions.js"; ?>"></script>
<script type="text/javascript" src="<?php echo $jsLink . "jquery.js"; ?>"></script>
</body></html>