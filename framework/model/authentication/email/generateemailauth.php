<?php

class GenerateEmailAuthentication
{
	private $email = null;
	private $userID = null;
	
	final public function __construct($userID, $email)
	{
		$this->userID = $userID;
		$this->email = $email;
	}
	
	final public function generateRequest()
	{
		$authToken = \phpsec\AdvancedPasswordManagement::tempPassword($this->userID);
		$authTokenVerifier = \phpsec\HttpRequest::Protocol() . "://" . \phpsec\HttpRequest::Host() . \phpsec\HttpRequest::PortReadable() . "/" . APPNAME . "/framework/emailverification?user={$this->userID}&token=$authToken";
		
		$to = $this->email;
		$subject = APPNAME . " - " . "Email Verification";
		$body = "Hi.<BR>This message is generated in response to your action in " . APPNAME . ".<BR>You said that you have a new email. We want to verify this.<BR><BR>Please click the link below to validate your request.<BR>";
		$body .= "<a href='$authTokenVerifier'>$authToken</a>";
		
		$mail = new \phpsec\GenericMail($to, $subject, $body);
		return $mail->sendMail();
	}
}

?>