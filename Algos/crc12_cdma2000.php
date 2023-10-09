<?php
//CRC-12 cdma2000
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherCRC12_cdma2000 extends HasherBase
{
	protected $FHash;

	protected $Table = array(
	0x0000, 0x0F13, 0x0135, 0x0E26, 0x026A, 0x0D79, 0x035F, 0x0C4C,
	0x04D4, 0x0BC7, 0x05E1, 0x0AF2, 0x06BE, 0x09AD, 0x078B, 0x0898,
	0x09A8, 0x06BB, 0x089D, 0x078E, 0x0BC2, 0x04D1, 0x0AF7, 0x05E4,
	0x0D7C, 0x026F, 0x0C49, 0x035A, 0x0F16, 0x0005, 0x0E23, 0x0130,
	0x0C43, 0x0350, 0x0D76, 0x0265, 0x0E29, 0x013A, 0x0F1C, 0x000F,
	0x0897, 0x0784, 0x09A2, 0x06B1, 0x0AFD, 0x05EE, 0x0BC8, 0x04DB,
	0x05EB, 0x0AF8, 0x04DE, 0x0BCD, 0x0781, 0x0892, 0x06B4, 0x09A7,
	0x013F, 0x0E2C, 0x000A, 0x0F19, 0x0355, 0x0C46, 0x0260, 0x0D73,
	0x0795, 0x0886, 0x06A0, 0x09B3, 0x05FF, 0x0AEC, 0x04CA, 0x0BD9,
	0x0341, 0x0C52, 0x0274, 0x0D67, 0x012B, 0x0E38, 0x001E, 0x0F0D,
	0x0E3D, 0x012E, 0x0F08, 0x001B, 0x0C57, 0x0344, 0x0D62, 0x0271,
	0x0AE9, 0x05FA, 0x0BDC, 0x04CF, 0x0883, 0x0790, 0x09B6, 0x06A5,
	0x0BD6, 0x04C5, 0x0AE3, 0x05F0, 0x09BC, 0x06AF, 0x0889, 0x079A,
	0x0F02, 0x0011, 0x0E37, 0x0124, 0x0D68, 0x027B, 0x0C5D, 0x034E,
	0x027E, 0x0D6D, 0x034B, 0x0C58, 0x0014, 0x0F07, 0x0121, 0x0E32,
	0x06AA, 0x09B9, 0x079F, 0x088C, 0x04C0, 0x0BD3, 0x05F5, 0x0AE6,
	0x0F2A, 0x0039, 0x0E1F, 0x010C, 0x0D40, 0x0253, 0x0C75, 0x0366,
	0x0BFE, 0x04ED, 0x0ACB, 0x05D8, 0x0994, 0x0687, 0x08A1, 0x07B2,
	0x0682, 0x0991, 0x07B7, 0x08A4, 0x04E8, 0x0BFB, 0x05DD, 0x0ACE,
	0x0256, 0x0D45, 0x0363, 0x0C70, 0x003C, 0x0F2F, 0x0109, 0x0E1A,
	0x0369, 0x0C7A, 0x025C, 0x0D4F, 0x0103, 0x0E10, 0x0036, 0x0F25,
	0x07BD, 0x08AE, 0x0688, 0x099B, 0x05D7, 0x0AC4, 0x04E2, 0x0BF1,
	0x0AC1, 0x05D2, 0x0BF4, 0x04E7, 0x08AB, 0x07B8, 0x099E, 0x068D,
	0x0E15, 0x0106, 0x0F20, 0x0033, 0x0C7F, 0x036C, 0x0D4A, 0x0259,
	0x08BF, 0x07AC, 0x098A, 0x0699, 0x0AD5, 0x05C6, 0x0BE0, 0x04F3,
	0x0C6B, 0x0378, 0x0D5E, 0x024D, 0x0E01, 0x0112, 0x0F34, 0x0027,
	0x0117, 0x0E04, 0x0022, 0x0F31, 0x037D, 0x0C6E, 0x0248, 0x0D5B,
	0x05C3, 0x0AD0, 0x04F6, 0x0BE5, 0x07A9, 0x08BA, 0x069C, 0x098F,
	0x04FC, 0x0BEF, 0x05C9, 0x0ADA, 0x0696, 0x0985, 0x07A3, 0x08B0,
	0x0028, 0x0F3B, 0x011D, 0x0E0E, 0x0242, 0x0D51, 0x0377, 0x0C64,
	0x0D54, 0x0247, 0x0C61, 0x0372, 0x0F3E, 0x002D, 0x0E0B, 0x0118,
	0x0980, 0x0693, 0x08B5, 0x07A6, 0x0BEA, 0x04F9, 0x0ADF, 0x05CC
	);

	public function __construct()
	{	
		$this->FHash = 0xfff;
		$this->Check = 'D4D';
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash << 8) ^ $this->Table[(ord($Msg[$i]) ^ ($this->FHash >> 4)) & 0xFF];		
		}   
	}
	
	public function Finish()
	{
		$this->FHash = $this->FHash & 0xFFF;
		
		return sprintf('%03X', $this->FHash);
	}
}

$HasherList->RegisterHasher('CRC-12 cdma2000', 'HasherCRC12_cdma2000');


