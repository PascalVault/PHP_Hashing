<?php
//FNV1_64
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV1_64 extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{
		$this->Check = 'A72FFC362BF916D6';
		$this->FHash = '0xCBF29CE484222325';
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = mul64($this->FHash, '0x0100000001B3');
			$this->FHash = xor64($this->FHash, ord($Msg[$i]));
		}   
	}
	
	public function Finish()
	{
		return strtoupper(gmp_strval($this->FHash, 16));
	}
}

$HasherList->RegisterHasher('FNV1-64', 'HasherFNV1_64');


