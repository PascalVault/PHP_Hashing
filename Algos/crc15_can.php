<?php
//CRC-15 CAN
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class Hashercrc15_can extends HasherBase
{
	protected $FHash;	
	
	protected $Table = array(
	0x0000, 0x4599, 0x4EAB, 0x0B32, 0x58CF, 0x1D56, 0x1664, 0x53FD,
	0x7407, 0x319E, 0x3AAC, 0x7F35, 0x2CC8, 0x6951, 0x6263, 0x27FA,
	0x2D97, 0x680E, 0x633C, 0x26A5, 0x7558, 0x30C1, 0x3BF3, 0x7E6A,
	0x5990, 0x1C09, 0x173B, 0x52A2, 0x015F, 0x44C6, 0x4FF4, 0x0A6D,
	0x5B2E, 0x1EB7, 0x1585, 0x501C, 0x03E1, 0x4678, 0x4D4A, 0x08D3,
	0x2F29, 0x6AB0, 0x6182, 0x241B, 0x77E6, 0x327F, 0x394D, 0x7CD4,
	0x76B9, 0x3320, 0x3812, 0x7D8B, 0x2E76, 0x6BEF, 0x60DD, 0x2544,
	0x02BE, 0x4727, 0x4C15, 0x098C, 0x5A71, 0x1FE8, 0x14DA, 0x5143,
	0x73C5, 0x365C, 0x3D6E, 0x78F7, 0x2B0A, 0x6E93, 0x65A1, 0x2038,
	0x07C2, 0x425B, 0x4969, 0x0CF0, 0x5F0D, 0x1A94, 0x11A6, 0x543F,
	0x5E52, 0x1BCB, 0x10F9, 0x5560, 0x069D, 0x4304, 0x4836, 0x0DAF,
	0x2A55, 0x6FCC, 0x64FE, 0x2167, 0x729A, 0x3703, 0x3C31, 0x79A8,
	0x28EB, 0x6D72, 0x6640, 0x23D9, 0x7024, 0x35BD, 0x3E8F, 0x7B16,
	0x5CEC, 0x1975, 0x1247, 0x57DE, 0x0423, 0x41BA, 0x4A88, 0x0F11,
	0x057C, 0x40E5, 0x4BD7, 0x0E4E, 0x5DB3, 0x182A, 0x1318, 0x5681,
	0x717B, 0x34E2, 0x3FD0, 0x7A49, 0x29B4, 0x6C2D, 0x671F, 0x2286,
	0x2213, 0x678A, 0x6CB8, 0x2921, 0x7ADC, 0x3F45, 0x3477, 0x71EE,
	0x5614, 0x138D, 0x18BF, 0x5D26, 0x0EDB, 0x4B42, 0x4070, 0x05E9,
	0x0F84, 0x4A1D, 0x412F, 0x04B6, 0x574B, 0x12D2, 0x19E0, 0x5C79,
	0x7B83, 0x3E1A, 0x3528, 0x70B1, 0x234C, 0x66D5, 0x6DE7, 0x287E,
	0x793D, 0x3CA4, 0x3796, 0x720F, 0x21F2, 0x646B, 0x6F59, 0x2AC0,
	0x0D3A, 0x48A3, 0x4391, 0x0608, 0x55F5, 0x106C, 0x1B5E, 0x5EC7,
	0x54AA, 0x1133, 0x1A01, 0x5F98, 0x0C65, 0x49FC, 0x42CE, 0x0757,
	0x20AD, 0x6534, 0x6E06, 0x2B9F, 0x7862, 0x3DFB, 0x36C9, 0x7350,
	0x51D6, 0x144F, 0x1F7D, 0x5AE4, 0x0919, 0x4C80, 0x47B2, 0x022B,
	0x25D1, 0x6048, 0x6B7A, 0x2EE3, 0x7D1E, 0x3887, 0x33B5, 0x762C,
	0x7C41, 0x39D8, 0x32EA, 0x7773, 0x248E, 0x6117, 0x6A25, 0x2FBC,
	0x0846, 0x4DDF, 0x46ED, 0x0374, 0x5089, 0x1510, 0x1E22, 0x5BBB,
	0x0AF8, 0x4F61, 0x4453, 0x01CA, 0x5237, 0x17AE, 0x1C9C, 0x5905,
	0x7EFF, 0x3B66, 0x3054, 0x75CD, 0x2630, 0x63A9, 0x689B, 0x2D02,
	0x276F, 0x62F6, 0x69C4, 0x2C5D, 0x7FA0, 0x3A39, 0x310B, 0x7492,
	0x5368, 0x16F1, 0x1DC3, 0x585A, 0x0BA7, 0x4E3E, 0x450C, 0x0095
	);

	public function __construct()
	{	
		$this->FHash = 0;
		$this->Check = '059E';
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash << 8) ^ $this->Table[(ord($Msg[$i]) ^ ($this->FHash >> 7)) & 0xFF];
		}   
	}
	
	public function Finish()
	{
		$this->FHash = $this->FHash & 0x7FFF;
		
		return sprintf('%04X', $this->FHash);
	}
}

$HasherList->RegisterHasher('CRC-15 CAN', 'Hashercrc15_can');

