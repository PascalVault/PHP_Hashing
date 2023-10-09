<?php
//RsHash
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherRsHash extends HasherBase
{
	protected $FHash, $A, $B;
	
	public function __construct()
	{	
		$this->Check = '704952E9';
		$this->FHash = 0;
		$this->B = 378551;
		$this->A = 63689;
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->FHash * $this->A + ord($Msg[$i]);
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit    
			
			$this->A = $this->A * $this->B;
			$this->A &= 0xFFFFFFFF; //limit to 32bit	
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}


$HasherList->RegisterHasher('Rs Hash', 'HasherRsHash');


