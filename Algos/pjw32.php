<?php
//PJW-32, invented by Peter J. Weinberger
//Author: domasz
//Last Update: 2022-11-22
//Licence: MIT  

require_once 'HasherBase.php';

class HasherPJW32 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{	
		$this->FHash =  0;
		$this->Check = '067897FC';
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{    	
			$this->FHash = ($this->FHash << 4) + ord($Msg[$i]);
			$Test = $this->FHash & 0xF0000000;
			
			if ($Test !== 0) $this->FHash = (($this->FHash ^ ($Test >> 28)) & 0x0FFFFFFF);	
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash); 
	}
}

$HasherList->RegisterHasher('PJW-32', 'HasherPJW32');


