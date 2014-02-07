<html>
<head>
<title><?php echo APPNAME . "- " . FAILURE; ?></title>
<style type="text/css">
#failurediv {
display: block;
position: absolute;
width: 40%;
height: 30%;
}
#failuretitle {
display: block;
position: relative;
width: 100%;
height: 20%;
background-color: #969696;
color: white;
}
#failurebody {
display: block;
position: relative;
width: 100%;
height: 60%;
}

</style>
</head>
<body>
<div style="top: 188px; left: 350px;" id="failurediv">
<div style="top: 0px; left: 0px;" id="failuretitle">
<p
style="font-family: Baskerville,'Palatino Linotype',Palatino,'Century Schoolbook L','Times New Roman',serif; text-align: center; font-size: 24px;"><strong>Oops.
Failure!!!</strong></p>
</div>
<div style="top: 0px; left: 0px;" id="failurebody">
<p
style="font-family: Verdana; font-style: italic; color: rgb(40, 80, 201);"><big><big>What
Happened?<br>
</big></big></p>
<span style="font-family: Verdana;">The email that we were trying to
send you, failed. If you wish, you can report this problem to the
developer. Or, you may try again later.</span><br>
</div>
</div>
</body>
</html>
