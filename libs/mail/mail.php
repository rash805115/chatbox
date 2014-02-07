<?php
namespace phpsec;

class GenericMail
{
	private $to = null;
	private $from = null;
	private $subject = null;
	private $body = null;
	private static $host = null;
	private static $port = null;
	private static $username = null;
	private static $password = null;


	final public function __construct($to, $subject, $body)
	{
		require_once(__DIR__ . "/pear_mail/Mail.php");
		require_once(__DIR__ . "/pear_mail/Mail/mime.php");
		
		$this->to = $to;
		$this->from = "rahul300chaudhary400@gmail.com";
		$this->subject = $subject;
		$this->body = $body;
		
		GenericMail::$host = "ssl://smtp.gmail.com";
		GenericMail::$port = "465";
		GenericMail::$username = \phpsec\confidentialString(':y3rZrSMrJdfKjfnnsdPU0/vaEq08dSGLPp9AuI6uVwE=');
		GenericMail::$password = \phpsec\confidentialString(':HcsnaIs9vVWYt4WY3tz6hIM2qs03UQqsW1WSL9vKWuY=');
	}
	
	final public function sendMail()
	{
		$headers = array(
		    "From"		=>	$this->from,
		    "Return-Path"	=>	$this->from,
		    "Subject"		=>	$this->subject
		);
		
		$mime = new \Mail_mime("\n");
		$mime->setHTMLBody($this->body);
		
		$this->body = $mime->get();
		$headers = $mime->headers($headers);

		$smtp = \Mail::factory(
			"smtp",
			array(
			    "host"	=>	GenericMail::$host,
			    "port"	=>	GenericMail::$port,
			    "auth"	=>	true,
			    "username"	=>	GenericMail::$username,
			    "password"	=>	GenericMail::$password
			)
		);
		
		$mail = $smtp->send($this->to, $headers, $this->body);
		
		if(\PEAR::isError($mail))
		{
			echo $mail->getMessage();
			return false;
		}
		
		return true;
	}
}

?>