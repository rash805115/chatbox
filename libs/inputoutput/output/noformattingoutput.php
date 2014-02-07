<?php

namespace chatbox;

final class NoFormattingOutput implements Output
{
	public function safeEcho($echoString)
	{
		echo $echoString;
	}
}

?>