<?php
//FNV0_56
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV0_56 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{	
		$this->Check = 'FB573C21FE6849';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = mul64($this->FHash, 0x0100000001B3);
			$this->FHash = xor64($this->FHash, ord($Msg[$i]));
		}   
	}
	
	public function Finish()
	{
		$f1 = and64($this->FHash, '0xffffffffffffff');
		$f2 = shr64($this->FHash, 56);                                            
		$this->FHash = xor64($f2, $f1);
		
		return strtoupper(gmp_strval($this->FHash, 16));
	}
}

$HasherList->RegisterHasher('FNV0-56', 'HasherFNV0_56');


