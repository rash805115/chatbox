<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
$signupButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/signup.png";
?>

<html><head>
  <title>chatbox - Signup</title>

  
  
  <style type="text/css">
#signupdiv {
  display: block;
  position: absolute;
  width: 40%;
  height: 40%;
}
#signuptitle {
  display: block;
  position: relative;
  width: 100%;
  height: 40%;
  margin-top: 0%;
  margin-left: 0%;
  background-color: #969696;
  color: white;
  padding-top: 0.4cm;
  padding-bottom: 0cm;
  padding-right: 0cm;
  font-weight: bold;
}
#signupbody {
  display: block;
  position: relative;
  width: 100%;
  height: 90%;
  margin-top: 0%;
}
#userid {
  width: 10.9cm;
  height: 1cm;
  position: fixed;
  display: block;
  margin-top: -23pt;
  margin-left: 180pt;
}
#pass {
  width: 10.9cm;
  height: 1cm;
  margin-left: 180pt;
  position: fixed;
  display: block;
  margin-top: -23pt;
}
#email {
  display: block;
  position: fixed;
  width: 10.9cm;
  height: 1cm;
  margin-top: -23pt;
  margin-left: 180pt;
}
#submit {
  width: 3.1cm;
  height: 1.3cm;
  margin-left: 7.8cm;
  margin-bottom: -0.7cm;
  background-repeat: no-repeat;
  background-image: url(<?php echo $signupButton; ?>);
  display: block;
  position: fixed;
  margin-top: 25pt;
}

  </style>
</head><body>
<?php
include_once(BASE_DIR . "view/message/error.php");
include_once(BASE_DIR . "view/message/info.php");
?>
<br>

<div style="top: 197px; left: 467px;" id="signupdiv">
<div id="signuptitle"><big style="font-family: Verdana; font-weight: normal;"><big>Welcome
New
User!<br>
<br>
We need your credentials in order to
create an account for you. Please fill this "one-time" form.</big></big><br>
</div>
<br>
<div id="signupbody">
<form name="signupform" id="signupform" method="post" action=""><big><span style="font-family: Verdana;"><big style="color: rgb(39, 79, 198);"><span style="font-family: Verdana; font-style: italic;">Fill all the fields.<br>
  <br>
</span></big>
  <br>
Desired User ID</span></big>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input name="userid" id="userid" maxlength="32" type="text"> <br>
  <big><span style="font-family: Verdana;"><br>
Desired Password</span></big> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; <input name="pass" id="pass" maxlength="128" type="password"> <br>
  <big><span style="font-family: Verdana;"><br>
Primary Email Address&nbsp;&nbsp;&nbsp;&nbsp; </span></big><input name="email" id="email" maxlength="128" type="text"> <br>
  <input name="submit" id="submit" value="" type="submit"><br>
</form>
</div>
</div>

</body></html>