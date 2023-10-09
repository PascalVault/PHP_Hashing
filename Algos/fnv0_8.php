<?php
//FNV0_8
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV0_8 extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{	
		$this->Check = 'FA';
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
		$this->FHash = (($this->FHash >> 8) ^ $this->FHash) &  0xFF;
		return sprintf('%02X', $this->FHash);
	}
}

$HasherList->RegisterHasher('FNV0-8', 'HasherFNV0_8');


