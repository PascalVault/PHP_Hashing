<?php
//FNV1_16
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV1_16 extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{	
		$this->Check = 'AC02';
		$this->FHash = 0x811C9DC5;
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
		$this->FHash = ($this->FHash >> 16) ^ ($this->FHash & 0xffff);
		return sprintf('%04X', $this->FHash);
	}
}

$HasherList->RegisterHasher('FNV1-16', 'HasherFNV1_16');


