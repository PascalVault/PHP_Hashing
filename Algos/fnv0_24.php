<?php
//FNV0_24
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV0_24 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{	
		$this->Check = 'D70B29';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->FHash * 0x01000193;
			$this->FHash = $this->FHash ^ ord($Msg[$i]);
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit
		}   
	}
	
	public function Finish()
	{
		$this->FHash = ($this->FHash >> 24) ^ ($this->FHash & 0xFFFFFF);
		return sprintf('%06X', $this->FHash);
	}
}

$HasherList->RegisterHasher('FNV0-24', 'HasherFNV0_24');


