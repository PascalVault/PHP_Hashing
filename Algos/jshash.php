<?php
//JsHash
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherJsHash extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{
		$this->Check = '90A4224B';
		$this->FHash = 1315423911;
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$Val = (($this->FHash << 5) + ord($Msg[$i]) + ($this->FHash >> 2));
			
			$this->FHash = $this->FHash ^ $Val;
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('Js Hash', 'HasherJsHash');


