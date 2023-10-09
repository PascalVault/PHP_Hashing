<?php
//FNV1a_8
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV1a_8 extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{	
		$this->Check = 'AD';
		$this->FHash = 0x811C9DC5;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->FHash ^ ord($Msg[$i]);
			$this->FHash = $this->FHash * 0x01000193;
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit
		}   
	}
	
	public function Finish()
	{
		$this->FHash = (($this->FHash >> 8) ^ $this->FHash) & 0xff;
		return sprintf('%02X', $this->FHash);
	}
}

$HasherList->RegisterHasher('FNV1a-8', 'HasherFNV1a_8');


