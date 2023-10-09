<?php
//CRC-13 BBC
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class Hashercrc13_bbc extends HasherBase
{
	protected $FHash;
	
	protected $Table = array(
	0x0000, 0x1CF5, 0x051F, 0x19EA, 0x0A3E, 0x16CB, 0x0F21, 0x13D4, 
	0x147C, 0x0889, 0x1163, 0x0D96, 0x1E42, 0x02B7, 0x1B5D, 0x07A8, 
	0x140D, 0x08F8, 0x1112, 0x0DE7, 0x1E33, 0x02C6, 0x1B2C, 0x07D9, 
	0x0071, 0x1C84, 0x056E, 0x199B, 0x0A4F, 0x16BA, 0x0F50, 0x13A5, 
	0x14EF, 0x081A, 0x11F0, 0x0D05, 0x1ED1, 0x0224, 0x1BCE, 0x073B, 
	0x0093, 0x1C66, 0x058C, 0x1979, 0x0AAD, 0x1658, 0x0FB2, 0x1347, 
	0x00E2, 0x1C17, 0x05FD, 0x1908, 0x0ADC, 0x1629, 0x0FC3, 0x1336, 
	0x149E, 0x086B, 0x1181, 0x0D74, 0x1EA0, 0x0255, 0x1BBF, 0x074A, 
	0x152B, 0x09DE, 0x1034, 0x0CC1, 0x1F15, 0x03E0, 0x1A0A, 0x06FF, 
	0x0157, 0x1DA2, 0x0448, 0x18BD, 0x0B69, 0x179C, 0x0E76, 0x1283, 
	0x0126, 0x1DD3, 0x0439, 0x18CC, 0x0B18, 0x17ED, 0x0E07, 0x12F2, 
	0x155A, 0x09AF, 0x1045, 0x0CB0, 0x1F64, 0x0391, 0x1A7B, 0x068E, 
	0x01C4, 0x1D31, 0x04DB, 0x182E, 0x0BFA, 0x170F, 0x0EE5, 0x1210, 
	0x15B8, 0x094D, 0x10A7, 0x0C52, 0x1F86, 0x0373, 0x1A99, 0x066C, 
	0x15C9, 0x093C, 0x10D6, 0x0C23, 0x1FF7, 0x0302, 0x1AE8, 0x061D, 
	0x01B5, 0x1D40, 0x04AA, 0x185F, 0x0B8B, 0x177E, 0x0E94, 0x1261, 
	0x16A3, 0x0A56, 0x13BC, 0x0F49, 0x1C9D, 0x0068, 0x1982, 0x0577, 
	0x02DF, 0x1E2A, 0x07C0, 0x1B35, 0x08E1, 0x1414, 0x0DFE, 0x110B, 
	0x02AE, 0x1E5B, 0x07B1, 0x1B44, 0x0890, 0x1465, 0x0D8F, 0x117A, 
	0x16D2, 0x0A27, 0x13CD, 0x0F38, 0x1CEC, 0x0019, 0x19F3, 0x0506, 
	0x024C, 0x1EB9, 0x0753, 0x1BA6, 0x0872, 0x1487, 0x0D6D, 0x1198, 
	0x1630, 0x0AC5, 0x132F, 0x0FDA, 0x1C0E, 0x00FB, 0x1911, 0x05E4, 
	0x1641, 0x0AB4, 0x135E, 0x0FAB, 0x1C7F, 0x008A, 0x1960, 0x0595, 
	0x023D, 0x1EC8, 0x0722, 0x1BD7, 0x0803, 0x14F6, 0x0D1C, 0x11E9, 
	0x0388, 0x1F7D, 0x0697, 0x1A62, 0x09B6, 0x1543, 0x0CA9, 0x105C, 
	0x17F4, 0x0B01, 0x12EB, 0x0E1E, 0x1DCA, 0x013F, 0x18D5, 0x0420, 
	0x1785, 0x0B70, 0x129A, 0x0E6F, 0x1DBB, 0x014E, 0x18A4, 0x0451, 
	0x03F9, 0x1F0C, 0x06E6, 0x1A13, 0x09C7, 0x1532, 0x0CD8, 0x102D, 
	0x1767, 0x0B92, 0x1278, 0x0E8D, 0x1D59, 0x01AC, 0x1846, 0x04B3, 
	0x031B, 0x1FEE, 0x0604, 0x1AF1, 0x0925, 0x15D0, 0x0C3A, 0x10CF, 
	0x036A, 0x1F9F, 0x0675, 0x1A80, 0x0954, 0x15A1, 0x0C4B, 0x10BE, 
	0x1716, 0x0BE3, 0x1209, 0x0EFC, 0x1D28, 0x01DD, 0x1837, 0x04C2
	);
	
	public function __construct()
	{	
		$this->FHash = 0;
		$this->Check = '04FA';
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash << 8) ^ $this->Table[(ord($Msg[$i]) ^ ($this->FHash >> 5)) & 0xFF];
		}   
	}
	
	public function Finish()
	{
		$this->FHash = $this->FHash & 0x1FFF;		
		return sprintf('%04X', $this->FHash);
	}
}

$HasherList->RegisterHasher('CRC-13 BBC', 'Hashercrc13_bbc');

