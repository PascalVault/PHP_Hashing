<?php
//FNV1A_56
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV1A_56 extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{	
		$this->Check = 'D5573923C6CDFA';
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
		$f1 = shr64($this->FHash, 56);
		$f2 = and64($this->FHash, '0xffffffffffffff');
		$this->FHash = xor64($f1, $f2);
		
		return strtoupper(gmp_strval($this->FHash, 16));
	}
}

$HasherList->RegisterHasher('FNV1a-56', 'HasherFNV1A_56');


