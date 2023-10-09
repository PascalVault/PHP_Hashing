<?php
//MurmurHash3, based on public domain code by Austin Appleby
//MurmurHash3_x86_32 variant
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherMurmurHash3 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{		
		$this->Check = 'B4FEF382';
		$this->FHash = 0;
	}
	
	public function fmix32($h)
	{
		$h = xor32($h, shr32($h, 16));
		$h = mul32($h,    0x85ebca6b);
		$h = xor32($h, shr32($h, 13));
		$h = mul32($h,    0xc2b2ae35);
		$h = xor32($h, shr32($h, 16));
		
		return $h;
	}

	public function Update($Msg, $Length)
	{
		$Seed = 0;
		$c1 = 0xcc9e2d51;
		$c2 = 0x1b873593;
		$FinalBytes = array();
				
		$BlockCount = intdiv($Length, 4);
		$Hash = $Seed;
		$Offset = 0;
				
		for ($i=0; $i<$BlockCount; $i++)
			{
			$Data = unpack('V', substr($Msg, $Offset, 4))[1];
			$Offset += 4;
			
			$Data = mul32($Data, $c1);
			$Data = rol32($Data, 15);
			$Data = mul32($Data, $c2);
			
			$Hash = xor32($Hash, $Data);
			$Hash = rol32($Hash, 13); 
			$Hash = add32(mul32($Hash, 5), 0xe6546b64);
		}
		
		//final bytes
		$BytesLeft = $Length - ($BlockCount*4);
		
		$FinalBytes = array(0,0,0,0);
		
		if ($BytesLeft > 0)  
		$FinalBytes[0] = ord($Msg[$Offset++]);
		
		if ($BytesLeft > 1)  
		$FinalBytes[1] = ord($Msg[$Offset++]);
		
		if ($BytesLeft > 2)    
		$FinalBytes[2] = ord($Msg[$Offset++]);
		
		if ($BytesLeft > 3)  
		$FinalBytes[3] = ord($Msg[$Offset++]);  
		
		$Data = 0;
		
		if ($BytesLeft = 3) $Data = xor32($Data, shl32($FinalBytes[2], 16));
		
		if ($BytesLeft >=2) $Data = xor32($Data, shl32($FinalBytes[1], 8));
		
		if ($BytesLeft >=1) $Data = xor32($Data, ($FinalBytes[0]        ));
		
		if ($BytesLeft > 0)
		{
			$Data = mul32($Data, $c1); 
			$Data = rol32($Data, 15); 
			$Data = mul32($Data, $c2); 
			$Hash = xor32($Hash, $Data);
		}
		
		$Hash = xor32($Hash, $Length);
		$Hash = $this->fmix32($Hash);
		
		$this->FHash = $Hash;
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('MurmurHash3', 'HasherMurmurHash3');


