<?php

namespace phpsec;

class Crypt
{
	private $algo = null;
	private $key = null;
	private $iv = "12345678901234567890123456789012";
	private $mode = "cbc";
	
	public function __construct($key, $algo = MCRYPT_RIJNDAEL_256)
	{
		$this->algo = $algo;
		$this->key = $key;
	}
	
	public function encrypt($data)
	{
		if(substr($data, 0, 1) !== ":")
		{
			$encryptedData = \mcrypt_encrypt($this->algo, $this->key, $data, $this->mode, $this->iv);
			$encryptedData = \base64_encode($encryptedData);
			return (":" . $encryptedData);
		}
		
		return $data;
	}
	
	public function decrypt($data)
	{
		if(substr($data, 0, 1) === ":")
		{
			$decryptedString = \substr($data, 1);
			$decryptedString = \base64_decode($decryptedString);
			$decryptedString = \mcrypt_decrypt($this->algo, $this->key, $decryptedString, $this->mode, $this->iv);
			
			return $decryptedString;
		}
		
		return $data;
	}
}

?>