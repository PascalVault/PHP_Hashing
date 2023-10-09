<?php
//CRC-16 PROFIBUS
//Author: domasz
//Version: 0.1 (2022-11-19)
//Licence: MIT

require_once 'HasherBase.php';

class HasherCRC16_PROFIBUS extends HasherBase
{
	protected $FHash = 0;

    protected $Table = array(		
		0x0000, 0x1DCF, 0x3B9E, 0x2651, 0x773C, 0x6AF3, 0x4CA2, 0x516D,
		0xEE78, 0xF3B7, 0xD5E6, 0xC829, 0x9944, 0x848B, 0xA2DA, 0xBF15,
		0xC13F, 0xDCF0, 0xFAA1, 0xE76E, 0xB603, 0xABCC, 0x8D9D, 0x9052,
		0x2F47, 0x3288, 0x14D9, 0x0916, 0x587B, 0x45B4, 0x63E5, 0x7E2A,
		0x9FB1, 0x827E, 0xA42F, 0xB9E0, 0xE88D, 0xF542, 0xD313, 0xCEDC,
		0x71C9, 0x6C06, 0x4A57, 0x5798, 0x06F5, 0x1B3A, 0x3D6B, 0x20A4,
		0x5E8E, 0x4341, 0x6510, 0x78DF, 0x29B2, 0x347D, 0x122C, 0x0FE3,
		0xB0F6, 0xAD39, 0x8B68, 0x96A7, 0xC7CA, 0xDA05, 0xFC54, 0xE19B,
		0x22AD, 0x3F62, 0x1933, 0x04FC, 0x5591, 0x485E, 0x6E0F, 0x73C0,
		0xCCD5, 0xD11A, 0xF74B, 0xEA84, 0xBBE9, 0xA626, 0x8077, 0x9DB8,
		0xE392, 0xFE5D, 0xD80C, 0xC5C3, 0x94AE, 0x8961, 0xAF30, 0xB2FF,
		0x0DEA, 0x1025, 0x3674, 0x2BBB, 0x7AD6, 0x6719, 0x4148, 0x5C87,
		0xBD1C, 0xA0D3, 0x8682, 0x9B4D, 0xCA20, 0xD7EF, 0xF1BE, 0xEC71,
		0x5364, 0x4EAB, 0x68FA, 0x7535, 0x2458, 0x3997, 0x1FC6, 0x0209,
		0x7C23, 0x61EC, 0x47BD, 0x5A72, 0x0B1F, 0x16D0, 0x3081, 0x2D4E,
		0x925B, 0x8F94, 0xA9C5, 0xB40A, 0xE567, 0xF8A8, 0xDEF9, 0xC336,
		0x455A, 0x5895, 0x7EC4, 0x630B, 0x3266, 0x2FA9, 0x09F8, 0x1437,
		0xAB22, 0xB6ED, 0x90BC, 0x8D73, 0xDC1E, 0xC1D1, 0xE780, 0xFA4F,
		0x8465, 0x99AA, 0xBFFB, 0xA234, 0xF359, 0xEE96, 0xC8C7, 0xD508,
		0x6A1D, 0x77D2, 0x5183, 0x4C4C, 0x1D21, 0x00EE, 0x26BF, 0x3B70,
		0xDAEB, 0xC724, 0xE175, 0xFCBA, 0xADD7, 0xB018, 0x9649, 0x8B86,
		0x3493, 0x295C, 0x0F0D, 0x12C2, 0x43AF, 0x5E60, 0x7831, 0x65FE,
		0x1BD4, 0x061B, 0x204A, 0x3D85, 0x6CE8, 0x7127, 0x5776, 0x4AB9,
		0xF5AC, 0xE863, 0xCE32, 0xD3FD, 0x8290, 0x9F5F, 0xB90E, 0xA4C1,
		0x67F7, 0x7A38, 0x5C69, 0x41A6, 0x10CB, 0x0D04, 0x2B55, 0x369A,
		0x898F, 0x9440, 0xB211, 0xAFDE, 0xFEB3, 0xE37C, 0xC52D, 0xD8E2,
		0xA6C8, 0xBB07, 0x9D56, 0x8099, 0xD1F4, 0xCC3B, 0xEA6A, 0xF7A5,
		0x48B0, 0x557F, 0x732E, 0x6EE1, 0x3F8C, 0x2243, 0x0412, 0x19DD,
		0xF846, 0xE589, 0xC3D8, 0xDE17, 0x8F7A, 0x92B5, 0xB4E4, 0xA92B,
		0x163E, 0x0BF1, 0x2DA0, 0x306F, 0x6102, 0x7CCD, 0x5A9C, 0x4753,
		0x3979, 0x24B6, 0x02E7, 0x1F28, 0x4E45, 0x538A, 0x75DB, 0x6814,
		0xD701, 0xCACE, 0xEC9F, 0xF150, 0xA03D, 0xBDF2, 0x9BA3, 0x866C
	);


	public function __construct() 
	{
		$this->FHash =  0xFFFF;
		$this->Check = 'A819';
	}

	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = (($this->FHash << 8) & 0xFFFF) ^ $this->Table[(ord($Msg[$i]) ^ ($this->FHash >> 8)) & 0xFF];
		}
	}

	public function Finish()
	{		
		$this->FHash = $this->FHash ^ 0xFFFF;		
		return sprintf('%04X', $this->FHash);
	}
}

$HasherList->RegisterHasher('CRC-16 PROFIBUS', 'HasherCRC16_PROFIBUS');