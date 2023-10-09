<?php
//CRC-82 DARC
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

//CRC82-DARC algorithm by Mark Adler, published on 17 June 2017, public domain.

require_once 'HasherBase.php';

class HasherCRC82_darc extends HasherBase
{
	protected $FHash, $FHash2;

	public function __construct()
	{
		$this->FHash =  0;
		$this->FHash2 =  0;
		$this->Check = '09EA83F625023801FD612';
	}
		
	public function Update($Msg, $Length)
	{
		$POLYHIGH = '0x22080';
		$POLYLOW = '0x8a00a2022200c430';
				
		$CLow = $this->FHash;
		$CHigh = and64($this->FHash2, 0x3FFFF);
		
		for ($i=0; $i<$Length; $i++)
		{
			$CLow = xor64($CLow, ord($Msg[$i]));
			
			for ($k=0; $k<8; $k++)
			{
				$Low = and64($CLow, 1);
				$CLow = or64(shr64($CLow, 1), shl64($CHigh, 63));
				$CHigh = shr64($CHigh, 1);
				
				$Str = 1*gmp_strval($Low);
				
				if ($Str !== 0)
				{
					$CLow = xor64($CLow, $POLYLOW);
					$CHigh = xor64($CHigh, $POLYHIGH);
				}
			}		
		}
		
		$this->FHash = $CLow;
		$this->FHash2 = $CHigh;
	}
	
	public function Finish()
	{
		return tohex($this->FHash2, 5) . tohex($this->FHash, 16);
	}
}

$HasherList->RegisterHasher('CRC-82 DARC', 'HasherCRC82_darc');