<?php
namespace phpsec;

function checkEmail($email)
{
	if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@([a-z0-9-])+\.([a-z0-9-]+)(\.[a-z]{2,63})?$/', $email))
	{
		return false;
	}
	
	return true;
}

function checkToken($token)
{
	if( (strlen($token) > 1) && (strlen($token) < 512) )
	{
		return true;
	}
	
	return false;
}

?>