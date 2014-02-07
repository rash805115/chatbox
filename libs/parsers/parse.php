<?php

namespace chatbox;

interface Parse
{
	public function parse($regexToParse, $stringToParse);
}

class ParseToArray implements Parse
{
	public function parse($regexToParse, $stringToParse)
	{
		return preg_split($regexToParse, $stringToParse, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
	}
}

class ParseEmoticons extends ParseToArray
{
	private $emoticonImages = "";

	public function __construct()
	{
		$this->emoticonImages = include_once("mapping/emoticonmapping.php");
	}
	
	private function generateRegex()
	{
		$regex = "/";
		
		$regex .= "/i";
	}
}

$a = new ParseToArray();
$a->parse("/(:\))/i", "Hi, this is my new car :). I will be driving this soon. :). I make lots of :), right");

?>