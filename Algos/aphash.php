<?php
//Ap Hash
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherApHash extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{	  
		$this->Check = 'C0E86BE5';
		$this->FHash = 0xAAAAAAAA;
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{	
			if (($i & 1) == 0) $Val = (($this->FHash << 7) ^ (ord($Msg[$i])) * ($this->FHash >> 3));
			else               $Val = (~(($this->FHash << 11) + (ord($Msg[$i])) ^ ($this->FHash >> 5)));
			
			$this->FHash = $this->FHash ^ $Val;	
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit			
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('Ap Hash', 'HasherApHash');