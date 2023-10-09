<?php
//Sum BSD
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherSUM_BSD extends HasherBase
{
	protected $FHash;

	public function __construct()
	{
		$this->FHash =  0;
		$this->Check = 'D16F';
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash >> 1) + (($this->FHash & 1) << 15);
			$this->FHash = $this->FHash + ord($Msg[$i]);
			$this->FHash = $this->FHash & 0xffff;
		}   
	}
	
	public function Finish()
	{
		return sprintf('%04X', $this->FHash);
	}
}

$HasherList->RegisterHasher('SUM BSD', 'HasherSUM_BSD');


