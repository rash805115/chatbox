<?php
class DefaultController extends phpsec\framework\DefaultViewController
{
	function Handle($Request)
	{
		return require_once (BASE_DIR . "view/404.php");
	}
}

?>