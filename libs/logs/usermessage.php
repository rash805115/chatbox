<?php

class UserMessageQueue
{
	public $userID = null;
	public $queueLength = null;
	public $queue = null;
	
	public function __construct($userID, $queueLength)
	{
		$this->userID = $userID;
		$this->queueLength = $queueLength;
		$this->queue = array();
	}
	
	public function push($error)
	{
		if(count($this->queue) > $this->queueLength)
		{
			$this->clean(1);
		}
		array_push($this->queue, $error);
	}
	
	public function clean($noOfElements)
	{
		while($noOfElements > 0)
		{
			array_shift($this->queue);
			$noOfElements--;
		}
	}
	
	public function pop($noOfElements)
	{
		if(count($this->queue) == 0)
			return false;
		
		$errors = array();
		
		while($noOfElements > 0)
		{
			array_push($errors, array_pop($this->queue));
		}
		
		return $errors;
	}
}

class UserMessageFormat
{
	public $fileName = null;
	public $errorDescription = null;
	public $timestamp = null;
	public $errorLevel = null;
}

?>