<?php
//SDBM Hash
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherSDBMHash extends HasherBase
{
	protected $FHash;

	public function __construct()
	{
		$this->Check = '68A07035';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ord($Msg[$i]) + ($this->FHash << 6) + ($this->FHash << 16) - $this->FHash;
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('SDBM Hash', 'HasherSDBMHash');


