<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<?php $selfSignincontroller = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/login/self?request=" . $_GET['request'];
$linkedincontroller = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/login/linkedin?request=" . $_GET['request'];
$facebookcontroller = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/login/facebook?request=" . $_GET['request'];

$linkedinImage = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/signin_external/linkedin-icon.png";
$facebookImage = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/signin_external/facebook-icon.png";

$loginButton = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/file/images/buttons/login.png";
$signinLink = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/signup";

?>
  <title>chatbox - ChatRoom</title>

  
  
  <style type="text/css">
#logindiv {
  position: absolute;
  display: block;
  width: 40%;
  height: 40%;
}
#loginself {
  border-style: solid;
  border-width: 2px;
  display: block;
  position: fixed;
  width: 26.4em;
  margin-left: 5.8cm;
  height: 30%;
  margin-top: -7.2pc;
}
#username {
  position: fixed;
  display: block;
  width: 7cm;
  margin-left: 3.9cm;
  margin-top: -1.3cm;
  height: 1cm;
}
#password {
  position: fixed;
  display: block;
  width: 7cm;
  height: 1cm;
  margin-left: 3.9cm;
  margin-top: -1.3cm;
}
#signin_submit {
  background-image: url(<?php echo $loginButton ?>);
  width: 3.1cm;
  height: 1.3cm;
  margin-left: 4.6cm;
  margin-bottom: -0.7cm;
  background-repeat:no-repeat;
}

  </style>
</head><body>
<?php
include_once(BASE_DIR . "view/message/error.php");
include_once(BASE_DIR . "view/message/info.php");
?>
<br>

<div style="top: 239px; left: 519px;" id="logindiv"><br style="color: rgb(0, 108, 0);">
<big style="color: rgb(0, 108, 0);"><big><span style="font-family: Verdana;background: #969696; padding: 10px; color: white;">Sign-In Using (Choose 1 of any 3
methods):<BR></span></big></big><br>
<br>
<a href="<?php echo $facebookcontroller; ?>"><img style="width: 113px; height: 113px;" alt="Facebook" src="<?php echo $facebookImage; ?>"></a>
<div id="loginself"><big><span style="font-family: Verdana;">&nbsp;</span></big>&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp; <br>
<form action="<?php echo $selfSignincontroller; ?>" method="post" id="site_signin" name="site_signin"><big><span style="font-family: Verdana;">&nbsp; Username</span></big><br>
&nbsp;&nbsp;&nbsp; <input id="username" name="username" maxlength="32" type="text" style="font-family: Verdana;"><br>
  <br>
&nbsp;&nbsp;&nbsp; <big><span style="font-family: Verdana;">Password</span></big><br>
  <br>
  <input id="password" name="password" maxlength="128" type="password" style="font-family: Verdana;"><br>
  <br>
  <span style='font-family: Verdana; font-size: 15px;'>Remember Me:  </span><input type="checkbox" name="remember-me" />
  <br>
  <input name="signin_submit" id="signin_submit" type="submit" value=""></form>
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <br>
</div>
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; <br>
<br>
<a href="<?php echo $linkedincontroller; ?>"><img style="width: 114px; height: 114px;" alt="LinkedIn" src="<?php echo $linkedinImage; ?>"></a><br>
<br><br><br><br><span style='font-family: Verdana; font-size: 15px;'>Don't have an account? Don't want to signup using facebook or linkedin? No Problem. You can <a href='<?php echo $signinLink; ?>'>Signup here</a>.</span>
</div>

</body></html>