<?php
//FNV0_64
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV0_64 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{	
		$this->Check = 'B8FB573C21FE68F1';
		$this->FHash = 0;
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

$HasherList->RegisterHasher('FNV0-64', 'HasherFNV0_64');


