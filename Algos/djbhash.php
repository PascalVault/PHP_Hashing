<?php
//DJB Hash
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherDJBHash extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{	
		$this->Check = '35CDBB82';
		$this->FHash = 5381;
	}
		
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = (($this->FHash << 5) + $this->FHash) + ord($Msg[$i]);
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('DJB Hash', 'HasherDJBHash');


