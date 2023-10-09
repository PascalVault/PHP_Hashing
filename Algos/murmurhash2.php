<?php
//MurmurHash2
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherMurmurHash2 extends HasherBase
{
	protected $FHash, $M, $R;
		
	public function __construct()
	{	
		$this->Check = 'DCCB0167';
		$this->FHash = 0;
		$this->M = 0x5bd1e995;
		$this->R = 24;
	}
	
	public function Update($Msg, $Length)
	{
		$Seed = 0;
		$Tmp = array();
		
		$this->FHash = xor32($Seed, $Length);
		$K = 0;
		$Offset = 0;
		
		while ($Length >= 4)
		{
			$Tmp[0] = ord($Msg[$Offset++]);
			$Tmp[1] = ord($Msg[$Offset++]);
			$Tmp[2] = ord($Msg[$Offset++]);
			$Tmp[3] = ord($Msg[$Offset++]);	    
			
			$K = $Tmp[0];
			$K = or32($K, shl32($Tmp[1], 8));
			$K = or32($K, shl32($Tmp[2], 16));
			$K = or32($K, shl32($Tmp[3], 24));
			
			$K = mul32($K, $this->M);
			$K = xor32($K, shr32($K, $this->R));
			$K = mul32($K, $this->M);
			
			$this->FHash = mul32($this->FHash, $this->M);
			$this->FHash = xor32($this->FHash, $K);
			
			$Length -= 4;
		}  
		
		$Tmp = array(0,0,0,0);
		
		if ($Length > 0)
		$Tmp[0] = ord($Msg[$Offset++]);
		
		if ($Length > 1)  
		$Tmp[1] = ord($Msg[$Offset++]);
		
		if ($Length > 2)  
		$Tmp[2] = ord($Msg[$Offset++]);
		
		if ($Length > 3)  
		$Tmp[3] = ord($Msg[$Offset++]);
		  
		switch ($Length)
		{
			case 3: $this->FHash = xor32($this->FHash, shl32($Tmp[2], 16));
					break;
			case 2: $this->FHash = xor32($this->FHash, shl32($Tmp[1], 8));
					break;
			case 1: $this->FHash = xor32($this->FHash, $Tmp[0]);
			        $this->FHash = mul32($this->FHash, $this->M);		
		}
		
		$this->FHash = xor32($this->FHash, shr32($this->FHash, 13));
		$this->FHash = mul32($this->FHash, $this->M);
		$this->FHash = xor32($this->FHash, shr32($this->FHash, 15));
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('MurmurHash2', 'HasherMurmurHash2');