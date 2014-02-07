<?php

class ShowAsIsController extends phpsec\framework\DefaultViewController
{
	function Handle($Request)
	{
		return require_once(BASE_DIR . "view/" . $Request);
	}
}

?>