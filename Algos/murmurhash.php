<?php
//MurmurHash
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherMurmurHash extends HasherBase
{
	protected $FHash, $M, $R;
	
	public function __construct()
	{	
		$this->Check = 'E9B7BC47';
		$this->FHash = 0;
		
		$this->M = 0xc6a4a793;
		$this->R = 16;
	}
		
	public function Update($Msg, $Length)
	{
		$Seed = 0;
		$Tmp = 0;
		
		$f1 = mul32($Length, $this->M);
		$this->FHash = xor32($Seed, $f1); 

		$Offset = 0;
		
		while ($Length >= 4)
		{
			$Tmp = unpack('V', substr($Msg, $Offset, 4))[1];
			
			$this->FHash = add32($this->FHash, $Tmp);		
			$this->FHash = mul32($this->FHash, $this->M);		
			$this->FHash = xor32($this->FHash, shr32($this->FHash, $this->R));
			
			$Offset += 4;
			$Length -= 4;
		}  
		
		$Tmp2 = array(0,0,0,0);

		if ($Length > 0)
		$Tmp2[0] = ord($Msg[$Offset++]);
		
		if ($Length > 1)  
		$Tmp2[1] = ord($Msg[$Offset++]);
		
		if ($Length > 2)  
		$Tmp2[2] = ord($Msg[$Offset++]);
		
		if ($Length > 3)  
		$Tmp2[3] = ord($Msg[$Offset++]);      
		
		switch ($Length)
		{
			case 3: $this->FHash = add32($this->FHash, shl32($Tmp2[2], 16));
					break;
			case 2: $this->FHash = add32($this->FHash + shl32($Tmp2[1], 8));    
					break;    
			case 1: $this->FHash = add32($this->FHash, $Tmp2[0]);
					$this->FHash = mul32($this->FHash, $this->M);
					$this->FHash = xor32($this->FHash, shr32($this->FHash, $this->R));										   	    
		}
		
		$this->FHash = mul32($this->FHash, $this->M);	
		$this->FHash = xor32($this->FHash, shr32($this->FHash, 10));			
		
		$this->FHash = mul32($this->FHash, $this->M);				
		$this->FHash = xor32($this->FHash, shr32($this->FHash, 17));		
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}


$HasherList->RegisterHasher('MurmurHash', 'HasherMurmurHash');


