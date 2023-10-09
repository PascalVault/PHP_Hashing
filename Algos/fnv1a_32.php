<?php
//FNV1a_32
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherFNV1a_32 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{
		$this->Check = 'BB86B11C';
		$this->FHash = 0x811C9DC5;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->FHash ^ ord($Msg[$i]);
			$this->FHash = $this->FHash * 0x01000193;
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('FNV1a-32', 'HasherFNV1a_32');


