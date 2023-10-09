<?php
//Elf Hash
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherElfHash extends HasherBase
{
	protected $FHash, $X;
		
	public function __construct()
	{
		$this->Check = '0678AEE9';
		$this->FHash = 0;
		$this->X = 0;
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash << 4) + ord($Msg[$i]);
			$Val = $this->FHash & 0xF0000000;
			
			if ($Val !== 0) 
			{
				$this->FHash = $this->FHash ^ ($Val >> 24);
				$this->X = $Val;
			}
			
			$this->FHash = $this->FHash & (~$this->X);
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('Elf Hash', 'HasherElfHash');


