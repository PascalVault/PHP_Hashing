<?php
//One at a time
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherOneAt extends HasherBase
{
	protected $FHash;

	public function __construct()
	{		
		$this->Check = 'C66B58C5';
		$this->FHash = 0;
	}

	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->FHash + ord($Msg[$i]);
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit  
			  
			$this->FHash = $this->FHash + ($this->FHash << 10);
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit    
			
			$this->FHash = $this->FHash ^ ($this->FHash >> 6);			
		}   
	}

	public function Finish()
	{
		$this->FHash = $this->FHash + ($this->FHash << 3);
		$this->FHash &= 0xFFFFFFFF; //limit to 32bit 
		 	  
		$this->FHash = $this->FHash ^ ($this->FHash >> 11);
			  
		$this->FHash = $this->FHash + ($this->FHash << 15);
		$this->FHash &= 0xFFFFFFFF; //limit to 32bit
		  
		return sprintf('%08X', $this->FHash);
	}
}


$HasherList->RegisterHasher('One at a time', 'HasherOneAt');


