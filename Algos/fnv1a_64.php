<?php
//FNV1A_64
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV1A_64 extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{	
		$this->Check = '06D5573923C6CDFC';
		$this->FHash = '0xCBF29CE484222325';
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = xor64($this->FHash, ord($Msg[$i]));
			$this->FHash = mul64($this->FHash, '0x0100000001B3');
		}   
	}
	
	public function Finish()
	{	
		return sprintf('%016X', $this->FHash);
	}
}

$HasherList->RegisterHasher('FNV1a-64', 'HasherFNV1A_64');


