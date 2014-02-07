<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<?php $chatMetaData = array();



?>
  <title><?php echo \chatbox\safeEcho(APPNAME) . " - " .
\chatbox\safeEcho(CHATHISTORYTITLE); ?></title>

  
  
  <style type="text/css">
#historydiv {
  display: block;
  position: absolute;
  width: 80%;
  height: 90%;
}
#historylist {
  overflow-y: scroll;
  display: block;
  position: fixed;
  width: 9cm;
  height: 18cm;
  margin-top: 0.5cm;
  margin-left: 0.5cm;
}
#historylist div {
  border-style: none none solid solid;
  border-color: #999999;
  border-width: 0px 0px 1px 1px;
  display: block;
  position: relative;
  height: 2cm;
  width: 100%;
  margin: 0px;
  padding: 0px;
}
#metadata {
  visibility: hidden;
  overflow-y: scroll;
  display: block;
  position: fixed;
  width: 10cm;
  height: 5cm;
  margin-left: 15cm;
}
#chatwindow {
  display: block;
  position: fixed;
  width: 24.5cm;
  height: 18cm;
  margin-left: 10cm;
  margin-top: 0.5cm;
}
#chatwindow iframe {
  display: block;
  position: fixed;
  width: 100%;
  height: 100%;
}

  </style>
  
  <script>
function loadiframe(obj)
{
link = obj.firstElementChild.firstElementChild.href;
document.getElementById("chatwindow").firstElementChild.setAttribute("src", link);
}
  </script>
</head><body>
<?php include_once(BASE_DIR . "view/include.php"); ?>
<div style="top: 140px; left: 230px;" id="historydiv">
<div id="historylist"><br>
<br>
<?php foreach($chatList as $chat)
{
$metaData = \chatbox\Chat::getChatDataFromID($chat);
$chatMetaData[$chat] = $metaData;

$link = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/chatroom/$chat";
echo "<div onclick='loadiframe(this)'><span style='font-family: Verdana;'><a href='$link'>{$metaData[0]}</a></span></div>";
}
?></div>
<div id="chatwindow"><iframe></iframe></div>
<div id="metadata"><?php foreach($chatMetaData as $chatid=>$chatData)
{
$members = implode(",", $chatData[1]);

echo "<div id='$chatid' style='border-style: solid; border-width: 1px;'>
Group ID: $chatid <BR>
Group Name: $chatData[0] <BR>
Group Members: $members <BR></div>
";
}
?>
</div>
</div>

</body></html>