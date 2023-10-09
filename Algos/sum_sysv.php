<?php
//SUM SYSV
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherSUM_SYSV extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{	
		$this->Check = '01DD';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->FHash + ord($Msg[$i]);			
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit    
		}   
	}
	
	public function Finish()
	{
		$Val = ($this->FHash & 0xFFFF) + ((($this->FHash & 0xFFFFFFFF) >> 16) & 0xFFFF);
		
		$this->FHash = ($Val & 0xFFFF) + ($Val >> 16);
		
		return sprintf('%04X', $this->FHash);
	}
}

$HasherList->RegisterHasher('SUM SYSV', 'HasherSUM_SYSV');


