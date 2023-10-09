<?php
//PJWHash (book)
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherPJWHash extends HasherBase
{
	protected $FHash, $Test, 
		$BitsInUnsignedInt, $ThreeQuarters, $OneEighth, $HighBits;

	public function __construct()
	{	
		$this->Check = '0678AEE9';
		$this->FHash = 0;
		
		$this->BitsInUnsignedInt = 32;
		$this->ThreeQuarters     = intdiv( ($this->BitsInUnsignedInt  * 3), 4);
		$this->OneEighth         = intdiv($this->BitsInUnsignedInt, 8);
		$this->HighBits          = 0xFFFFFFFF << ($this->BitsInUnsignedInt - $this->OneEighth);
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{		
			$this->FHash = ($this->FHash << $this->OneEighth) + ord($Msg[$i]);
		
			$this->Test = $this->FHash & $this->HighBits;
		
			if ($this->Test !== 0) $this->FHash = ($this->FHash ^ ($this->Test >> $this->ThreeQuarters)) & (~ $this->HighBits);
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}


$HasherList->RegisterHasher('PJW Hash', 'HasherPJWHash');


