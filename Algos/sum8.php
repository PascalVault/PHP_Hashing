<?php
//SUM8
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherSUM8 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{	
		$this->Check = 'DD';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->FHash + ord($Msg[$i]);
			$this->FHash &= 0xFF; //limit to 8bit
		}   
	}
	
	public function Finish()
	{
		return sprintf('%02X', $this->FHash);
	}
}

$HasherList->RegisterHasher('SUM8', 'HasherSUM8');


