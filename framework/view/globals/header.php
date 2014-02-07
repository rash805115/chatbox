<?php
	$preURL = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/";
?>

<style>

#topheaderdiv {
display: block;
position: absolute;
height: 1cm;
width: 25cm;
background-color: rgb(36, 72, 182);
}

#topheaderleftdiv {
display: block;
position: relative;
height: 100%;
width: 40%;
left: 0%;
}

#topheaderleftdiv ul {
display: block;
position: relative;
height: 100%;
width: 100%;
}

#topheaderleftdiv ul li{
display: inline;
left: 0%;
margin-right: 15px;
}

#topheaderleftdiv ul li a{
text-decoration: none;
font-weight: bold;
color: white;
font-family: Verdana;
font-size: 15px;
padding-bottom: 5px;
}

#topheaderleftdiv ul li a:hover{
color: orange;
}

#topheadermiddlediv {
display: block;
position: relative;
height: 100%;
width: 30%;
top: -40px;
left: 40%;
}

#topheaderrightdiv {
display: block;
position: relative;
height: 100%;
width: 30%;
top: -90px;
left: 70%;
}
#topheaderrightdiv ul li{
display: inline;
position: relative;
height: 100%;
margin-right: 15px;
}

#topheaderrightdiv ul li a{
text-decoration: none;
font-weight: bold;
color: white;
font-family: Verdana;
font-size: 15px;
padding-bottom: 5px;
}

#topheaderrightdiv ul li a:hover{
color: orange;
}
</style>

<div id="topheaderdiv">
	<div id="topheaderleftdiv">
		<ul>
			<li><a href="<?php echo $preURL . "home"; ?>">Home</a></li>
			<li><a href="<?php echo $preURL . "chatroom"; ?>">ChatRoom</a></li>
			<li><a href="<?php echo $preURL . "history"; ?>">Chat History</a></li>
		</ul>
	</div>
	
	<div id="topheadermiddlediv">
	</div>
	
	<div id="topheaderrightdiv">
		<ul>
			<li><a href="<?php echo $preURL . "logout"; ?>">Log Out</a></li>
		</ul>
	</div>
</div>