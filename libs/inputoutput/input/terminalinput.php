<?php

namespace chatbox;

final class TerminalInput implements Input
{
	private $terminalCharacter = "";
	private $charReadLimit = 1024;
	private $source = "php://stdin";
	
	public function __construct($terminalCharacter)
	{
		$this->terminalCharacter = $terminalCharacter;
	}
	
	public function safeIn()
	{
		$fp = fopen($this->source, "r");
		$endOfMessage = false;
		$message = "";
		
		while(!$endOfMessage)
		{
			$nextLine = fgets($fp, $this->charReadLimit);
			
			if(!$this->terminalCharacter)
			{
				$message .= $nextLine;
			}
			else
			{
				$endOfMessage = true;
			}
		}
		
		return $message;
	}
}

?>