<html>
<head>
<title><?php echo APPNAME . "- " . SUCCESS; ?></title>
<style type="text/css">
#successdiv {
display: block;
position: absolute;
width: 40%;
height: 30%;
}
#successtitle {
display: block;
position: relative;
width: 100%;
height: 20%;
background-color: #969696;
color: white;
}
#successbody {
display: block;
position: relative;
width: 100%;
height: 60%;
}

</style>
</head>
<body>
<div style="top: 188px; left: 350px;" id="successdiv">
<div style="top: 0px; left: 0px;" id="successtitle">
<p
style="font-family: Baskerville,'Palatino Linotype',Palatino,'Century Schoolbook L','Times New Roman',serif; text-align: center; font-size: 24px;"><strong>Yayyy!!!</strong></p>
</div>
<div style="top: 0px; left: 0px;" id="successbody">
<p
style="font-family: Verdana; font-style: italic; color: rgb(40, 80, 201);"><big><big>What
Happened?<br>
</big></big></p>
<span style="font-family: Verdana;">Your requested has been
successfully verified.<br></span>
<br>
Congratulation! Job Well Done.<br>
<span style="font-size: 15px;"><BR><BR>You can now go to the <a href='<?php echo \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/home"; ?>' style='font-size: 25px;'>login</a> page.</span>
</div>
</div>
</body>
</html>

