<?php
//MurmurHash2a
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherMurmurHash2a extends HasherBase
{
	protected $FHash, $M, $R;
		
	public function __construct()
	{	
		$this->Check = '72D40B4C';
		$this->FHash = 0;
		$this->M = 0x5bd1e995;
		$this->R = 24;
	}
	
	public function mmix(&$h, &$k)
	{
		$k = mul32($k, $this->M);
		$k = xor32($k, shr32($k, $this->R));
		$k = mul32($k, $this->M);
		$h = mul32($h, $this->M);
		$h = xor32($h, $k);
	}
	
	public function Update($Msg, $Length)
	{
		$Seed = 0;
		
		$Tmp = array();
		$Tmp2 = 0;
		
		$L = $Length;
		
		$this->FHash = $Seed;
		$K = 0;
		$Offset = 0;
		
		while ($Length >= 4)
		{
			//Move(ord($Msg[$i]), Tmp2, 4);
			$Tmp2 = unpack('V', substr($Msg, $Offset, 4))[1];
			
			$this->mmix($this->FHash, $Tmp2);
			
			$Offset += 4;
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
		
		$T = 0;
		
		switch ($Length)
		{
			case 3: $T = xor32($T, shl32($Tmp[2], 16));
			case 2: $T = xor32($T, shl32($Tmp[1], 8));
			case 1: $T = xor32($T, $Tmp[0]);
		}
		
		$this->mmix($this->FHash, $T);
		$this->mmix($this->FHash, $L);
		
		$this->FHash = xor32($this->FHash, shr32($this->FHash, 13));
		$this->FHash = mul32($this->FHash, $this->M);
		$this->FHash = xor32($this->FHash, shr32($this->FHash, 15));
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('MurmurHash2a', 'HasherMurmurHash2a');