<?php

class AuthorizationController extends phpsec\framework\DefaultController
{
	function Handle($Request, $userID)
	{
		$userID = Authorization::check();
		
		if($userID)
		{
			return $userID;
		}
		else
		{
			$Request = substr(\phpsec\HttpRequest::URL(), strpos(\phpsec\HttpRequest::URL(), \phpsec\HttpRequest::InternalPath()));
			Authorization::unauthorizedAction($Request);
		}
	}
}

?>