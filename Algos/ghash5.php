<?php
//GHash5
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherGHash5 extends HasherBase
{
	protected $FHash;
		
	public function __construct()
	{	
		$this->Check = '43B130DD';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash << 5) + $this->FHash + ord($Msg[$i]);
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit	
		}   
	}
	
	public function Finish()
	{	
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('GHash5', 'HasherGHash5');


