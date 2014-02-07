<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<?php
$jsLink = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/js/";
$addFriendButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/addfriend.png";
$unFriendButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/unfriend.png";
?>
  <title><?php echo \chatbox\safeEcho($title); ?></title>

  <script type="text/javascript" src="<?php echo $jsLink . "check.js"; ?>"></script>
  
  <style type="text/css">
#profilediv {
  display: block;
  position: absolute;
  width: 80%;
  height: 90%;
}
#profilepic {
  border-style: solid;
  border-width: 2px;
  display: block;
  position: relative;
  width: 6cm;
  height: 6cm;
  margin-left: 20pt;
}
#profileinformation {
  display: block;
  position: relative;
  width: 25.5cm;
  height: 5.5cm;
  margin-top: -6cm;
  margin-left: 8cm;
  padding-top: 0.5cm;
  padding-left: 0.5cm;
}
#profileinformation table {
  color: #254bbc;
  font-size: 23px;
  font-family: Verdana;
}
#profileaddfriend {
  display: block;
  position: relative;
  width: 3cm;
  height: 1.3cm;
  margin-left: 1cm;
  margin-top: 1cm;
  background-repeat: no-repeat;
}
#profileunfriend {
  display: block;
  position: relative;
  width: 3cm;
  height: 1.3cm;
  margin-top: -1.3cm;
  margin-left: 5cm;
  background-repeat: no-repeat;
}
#addfriendsubmit {
  background-image: url(<?php echo $addFriendButton; ?>);
  background-repeat: no-repeat;
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
}
#unfriendsubmit {
  background-image: url(<?php echo $unFriendButton; ?>);
  display: block;
  position: relative;
  width: 100%;
  height: 100%;
}
#profilepic img {
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


  </style>
</head><body>
<?php include_once(BASE_DIR . "view/include.php"); ?>
<div style="top: 140px; left: 201px;" id="profilediv"><br>
<div id="profilepic" class="tooltip">
<?php echo "<img src='$profilepic' alt='$friendUserID' />"; ?><span class="tooltipcontent"><?php echo $friendUserID; ?></span></div>
<div id="profileinformation">
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td style="vertical-align: top; width: 314px;">Username<br>
      </td>
      <td style="vertical-align: top; width: 630px;"><?php echo \chatbox\safeEcho($friendUserID); ?>
      <br>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top; width: 314px;">First Name<br>
      </td>
      <td style="vertical-align: top; width: 630px;"><br>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top; width: 314px;">Last Name<br>
      </td>
      <td style="vertical-align: top; width: 630px;"><br>
      </td>
    </tr>
  </tbody>
</table>
<br>
</div>
<div id="profileaddfriend">
<form method="post" action="" name="addfriend" id="addfriend"> <input name="addfriendsubmit" id="addfriendsubmit" value="" type="submit"> </form>
</div>
<div id="profileunfriend">
<form method="post" action="" name="unfriend" id="unfriend"> <input name="unfriendsubmit" id="unfriendsubmit" value="" type="submit"> </form>
</div>
</div>

</body></html>