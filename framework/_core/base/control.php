<?php

namespace phpsec\framework;

abstract class Controller 
{
	abstract function Start();
}

abstract class DefaultController extends Controller
{
	private $RestOfRequest=null;
	public $info = "";
	public $error = "";
	
	public function __construct($RestOfRequest)
	{
		$this->RestOfRequest=$RestOfRequest;
	}
	
	function Start()
	{
		require_once(__DIR__ . "/../../control/authorization.php");
		$autorization = new \AuthorizationController($this->RestOfRequest);
		$userID = $autorization->Handle($autorization->RestOfRequest, "");
		
		if(\phpsec\UserManagement::userExists($userID))
			return $this->Handle($this->RestOfRequest, $userID); 
	}
	
	abstract function Handle($Request, $userID);
}

abstract class DefaultViewController extends Controller
{
	private $RestOfRequest=null;
	public $info = "";
	public $error = "";
	
	public function __construct($RestOfRequest)
	{
		$this->RestOfRequest=$RestOfRequest;
	}
	
	function Start()
	{
		return $this->Handle($this->RestOfRequest);
	}
	
	abstract function Handle($Request);
}

?>