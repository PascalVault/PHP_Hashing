<?php
//XXHash32, based on MIT code in C# by Melnik Alexander
//Author: domasz
//Last Update: 2022-11-26
//Licence: MIT

require_once 'HasherBase.php';

class HasherXXHash32 extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{	
		$this->Check = '937BAD67';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)
	{
		$Seed = 0;
		$XXH_PRIME32_1 = 2654435761;
		$XXH_PRIME32_2 = 2246822519;
		$XXH_PRIME32_3 = 3266489917;
		$XXH_PRIME32_4 = 668265263;
		$XXH_PRIME32_5 = 374761393;
		$Val = array();
		
		$Offset = 0;
				
		if ($Length >= 16)
		{		
			$TotalBlocks = intdiv($Length, 16);
			
			$Val[0] = ($Seed + $XXH_PRIME32_1 + $XXH_PRIME32_2) & 0xFFFFFFFF;			
			$Val[1] = ($Seed + $XXH_PRIME32_2) & 0xFFFFFFFF;						
			$Val[2] = $Seed + 0;						
			$Val[3] = ($Seed - $XXH_PRIME32_1) & 0xFFFFFFFF;			

			for ($i=0; $i<$TotalBlocks; $i++)
			{
				for ($j=0; $j<4; $j++)
				{
					$Data[$j] = unpack('V', substr($Msg, $Offset, 4))[1];
					$Offset += 4;
				}
				
				// XXH32 round
				for ($j=0; $j<4; $j++)
				{
					$Val[$j] = ($Val[$j] + ($Data[$j] * $XXH_PRIME32_2)) & 0xFFFFFFFF;								
					$Val[$j] = (($Val[$j] << 13) | ($Val[$j] >> (32 - 13))) & 0xFFFFFFFF;					
					$Val[$j] = ($Val[$j] * $XXH_PRIME32_1) & 0xFFFFFFFF;				
				}
				
			}
			
			$h32 = (($Val[0] <<  1) | ($Val[0] >> (32 -  1))) +
					(($Val[1] <<  7) | ($Val[1] >> (32 -  7))) +
					(($Val[2] << 12) | ($Val[2] >> (32 - 12))) +
					(($Val[3] << 18) | ($Val[3] >> (32 - 18)));
		}
		else 
		{
			$h32 = ($Seed + $XXH_PRIME32_5) & 0xFFFFFFFF;			
		}
		
		$h32 = $h32 + $Length;
		$h32 &= 0xFFFFFFFF;		

		//last bytes
		$Length = $Length & 15;
		
		while ($Length >= 4) 
		{
			$Tmp = unpack('V', substr($Msg, $Offset, 4))[1];
	
			$h32 = ($h32 + ($Tmp * $XXH_PRIME32_3)) & 0xFFFFFFFF;
							  				
			$Offset += 4;
			
			$h1 = ($h32 << 17) & 0xFFFFFFFF;
			$h2 = ($h32 >> (32 - 17)) & 0xFFFFFFFF;
			$h32 = (($h1 | $h2) * $XXH_PRIME32_4) & 0xFFFFFFFF;
		
			$Length -= 4;
		}
		
		while ($Length > 0)
		{
			$h32 = ($h32 + (ord($Msg[$Offset]) * $XXH_PRIME32_5)) & 0xFFFFFFFF;
						
			$Offset++;
			
			$h1 = ($h32 << 11) & 0xFFFFFFFF;
			$h2 = ($h32 >> (32 - 11)) & 0xFFFFFFFF;			 			
			$h32 = (($h1 | $h2) * $XXH_PRIME32_1) & 0xFFFFFFFF;
						
			$Length--;
		}
		
		//finalize
		$h32 = ($h32 ^ ($h32 >> 15)) & 0xFFFFFFFF;				
		$h32 = ($h32 * $XXH_PRIME32_2) & 0xFFFFFFFF;					
		$h32 = ($h32 ^ ($h32 >> 13)) & 0xFFFFFFFF;				
		$h32 = ($h32 * $XXH_PRIME32_3) & 0xFFFFFFFF;				
		$h32 = ($h32 ^ ($h32 >> 16)) & 0xFFFFFFFF;
				
		$this->FHash = $h32;
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}


$HasherList->RegisterHasher('XXHash32', 'HasherXXHash32');


