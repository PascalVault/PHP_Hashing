<?php
//BKDR Hash
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherBKDRHash extends HasherBase
{
	protected $FHash, $Seed;
	
	public function __construct()
	{	
		$this->Seed = 131;
		$this->Check = 'DE43D6D5';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash * $this->Seed) + ord($Msg[$i]);
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('BKDR Hash', 'HasherBKDRHash');