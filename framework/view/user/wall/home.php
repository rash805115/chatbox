<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
$searchButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/searchuser.png";
$startChatButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/startchat.png";
?>

<html><head><title><?php echo \chatbox\safeEcho(APPNAME) . " - " . \chatbox\safeEcho(HOMETITLE); ?></title>

  

  
  
  <style type="text/css">
#walldiv {
  display: block;
  position: absolute;
  width: 80%;
  height: 90%;
}
#searchdiv {
  display: block;
  position: relative;
  width: 13cm;
  height: 1cm;
  margin-left: 7cm;
  margin-top: 0.3cm;
}
#usertosearch {
  display: block;
  position: relative;
  width: 11cm;
  height: 1cm;
  margin-top: 0.3cm;
}
#submitsearchuser {
  background-image: url(<?php echo $searchButton; ?>);
  background-repeat: no-repeat;
  display: block;
  position: relative;
  width: 3cm;
  height: 1.3cm;
  margin-top: -1.2cm;
  margin-left: 11.4cm;
}
#friendlistdiv {
  overflow-y: scroll;
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
}
#friendlistdiv table {
  border-style: none none none solid;
  border-width: 1px 1px 1px 2px;
  display: block;
  position: relative;
  border-collapse: separate;
  border-spacing: 15px 0px;
}
#friendlistdiv table tr td {
  border-style: none solid solid none;
  display: block;
  position: relative;
  width: 3cm;
  height: 3cm;
  border-right-width: 2px;
  border-bottom-width: 2px;
}
#friendlistdiv table tr td img {
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
}
#friendlistupperdiv {
  display: block;
  position: relative;
  width: 40%;
  height: 10cm;
  margin-top: 4cm;
  margin-left: 2cm;
}
#pendingfriendlistdiv {
  overflow-y: scroll;
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
}
#pendingfriendlistupperdiv {
  display: block;
  position: fixed;
  width: 30%;
  height: 10cm;
  margin-top: -10cm;
  margin-left: 19cm;
}
#startchatsubmit {
  display: block;
  position: fixed;
  background-image: url(<?php echo $startChatButton; ?>);
  background-repeat: no-repeat;
  width: 3cm;
  height: 1.3cm;
  margin-top: 11.5cm;
  margin-left: -3cm;
}
#startchat {
  display: block;
  position: fixed;
  width: 10cm;
  font-family: Verdana;
  font-weight: bold;
  color: #254bbc;
  margin-left: 7.6cm;
  height: 1.5cm;
  padding-top: 0.4cm;
  margin-top: -13cm;
}
#searchresults {
  overflow-y: scroll;
  display: block;
  position: absolute;
  width: 12cm;
  height: 4.4cm;
  margin-top: -15cm;
  margin-left: 22.5cm;
}
#yourpic {
  border-style: solid;
  border-width: 2px;
  display: block;
  position: fixed;
  width: 4cm;
  height: 4cm;
  margin-top: -15cm;
  margin-left: 2cm;
}

#yourpic img {
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
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

  </style></head><body>
  <?php include_once(BASE_DIR . "view/include.php"); ?>
<div style="top: 140px; left: 259px;" id="walldiv">
<div id="searchdiv">
<form method="post" action="" name="searchuser" id="searchuser"> <input name="usertosearch" id="usertosearch" maxlength="32" style="font-family: Verdana;" type="text"> <input name="submitsearchuser" id="submitsearchuser" value="" type="submit"> </form>
</div>
<div id="friendlistupperdiv"><big style="color: rgb(37, 75, 188);">
</big>
<div><span style="font-family: Verdana;"><big style="color: rgb(37, 75, 188);">My Friends<br>
</big></span></div>
<div id="friendlistdiv"><big style="color: rgb(37, 75, 188);"><big style="color: rgb(37, 75, 188);"><br>
</big>
</big>
<table style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
  <tbody>
<?php $friendList = \chatbox\Friends::myFriends($userID);
$onEachRow = 5;
$count = 0;
$table = "<tr>";
foreach($friendList as $friend=>$picture)
{
if($count<$onEachRow)
{
$profileLink = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/profile/$friend";
$table .= "<td style='vertical-align: top;' class='tooltip'><a href='$profileLink'><img class='tooltip' src='$picture' alt='$friend' /></a><span class='tooltipcontent'>$friend</span></td>";
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
<div id="yourpic" class='tooltip'><?php 
$pic = \chatbox\Friends::getUserProfilePicture($userID);
echo "<img src='$pic' alt='$userID' class='tooltip' /><span class='tooltipcontent'>$userID</span>"; ?></div>
<div id="pendingfriendlistupperdiv"><big style="color: rgb(37, 75, 188);">
</big>
<div><span style="font-family: Verdana;"><big style="color: rgb(37, 75, 188);">My Pending requests<br>
</big></span></div>
<div id="pendingfriendlistdiv"><big style="color: rgb(37, 75, 188);"><big style="color: rgb(37, 75, 188);"><br>
</big>
</big>


<?php $requests = \chatbox\Friends::pendingRequests($userID);
foreach($requests as $friendReq)
{
$profileLink = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/profile/{$friendReq['friend_source']}";
$acceptLink = "<a style='font-family: Verdana; font-size: 15px;' href='$profileLink'>{$friendReq['friend_source']}</a> wants to be friends with you.";
$acceptLink .= "
<form method='POST' action=''>
<input type='hidden' name='friend_source' value='{$friendReq['friend_source']}' />
<input type='submit' name='acceptfriendreq' value='Accept Request' />
</form><BR>
";
echo $acceptLink;
}
?>

</div>
</div>
<div id="startchat"><big><big>
Let's Chat</big></big><?php $redirectURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/chatroom";

?>
<form method="post" action="<?php echo \chatbox\safeEcho($redirectURL); ?>" name="startchat" id="startchat"><big style="color: rgb(37, 75, 188);"><input name="startchatsubmit" id="startchatsubmit" value="" type="submit"> </big></form>
</div>
<div id="searchresults"><span style="font-family: Verdana;"><big style="color: rgb(37, 75, 188);">Your search results are below:
</big></span><br>
<br>
<span style="font-family: Verdana;"><big style="color: rgb(37, 75, 188);">
<?php if($userSearched === null)

{

echo "";

}

elseif($userSearched === "")

{

echo "<span style='font-family: Verdana; font-size: 15px;'>No Such user found!</span>";

}

else

{

$userProfileLink = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/profile/$userSearched";

echo "<a href='$userProfileLink'><span style='font-family: Verdana; font-size: 15px;'>$userSearched</span></a>";

}

?></big></span></div>
</div>

</body></html>