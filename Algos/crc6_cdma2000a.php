<?php
//CRC-6/CDMA2000-A
//Author: domasz
//Last Update: 2022-11-29
//Licence: MIT  

require_once 'HasherBase.php';

class HasherCRC6_CDMA2000A extends HasherBase
{
	protected $FHash;

	protected $Table = array(
	0x00, 0x9C, 0xA4, 0x38, 0xD4, 0x48, 0x70, 0xEC, 0x34, 0xA8, 0x90, 0x0C, 0xE0, 0x7C, 0x44, 0xD8,
	0x68, 0xF4, 0xCC, 0x50, 0xBC, 0x20, 0x18, 0x84, 0x5C, 0xC0, 0xF8, 0x64, 0x88, 0x14, 0x2C, 0xB0,
	0xD0, 0x4C, 0x74, 0xE8, 0x04, 0x98, 0xA0, 0x3C, 0xE4, 0x78, 0x40, 0xDC, 0x30, 0xAC, 0x94, 0x08,
	0xB8, 0x24, 0x1C, 0x80, 0x6C, 0xF0, 0xC8, 0x54, 0x8C, 0x10, 0x28, 0xB4, 0x58, 0xC4, 0xFC, 0x60,
	0x3C, 0xA0, 0x98, 0x04, 0xE8, 0x74, 0x4C, 0xD0, 0x08, 0x94, 0xAC, 0x30, 0xDC, 0x40, 0x78, 0xE4,
	0x54, 0xC8, 0xF0, 0x6C, 0x80, 0x1C, 0x24, 0xB8, 0x60, 0xFC, 0xC4, 0x58, 0xB4, 0x28, 0x10, 0x8C,
	0xEC, 0x70, 0x48, 0xD4, 0x38, 0xA4, 0x9C, 0x00, 0xD8, 0x44, 0x7C, 0xE0, 0x0C, 0x90, 0xA8, 0x34,
	0x84, 0x18, 0x20, 0xBC, 0x50, 0xCC, 0xF4, 0x68, 0xB0, 0x2C, 0x14, 0x88, 0x64, 0xF8, 0xC0, 0x5C,
	0x78, 0xE4, 0xDC, 0x40, 0xAC, 0x30, 0x08, 0x94, 0x4C, 0xD0, 0xE8, 0x74, 0x98, 0x04, 0x3C, 0xA0,
	0x10, 0x8C, 0xB4, 0x28, 0xC4, 0x58, 0x60, 0xFC, 0x24, 0xB8, 0x80, 0x1C, 0xF0, 0x6C, 0x54, 0xC8,
	0xA8, 0x34, 0x0C, 0x90, 0x7C, 0xE0, 0xD8, 0x44, 0x9C, 0x00, 0x38, 0xA4, 0x48, 0xD4, 0xEC, 0x70,
	0xC0, 0x5C, 0x64, 0xF8, 0x14, 0x88, 0xB0, 0x2C, 0xF4, 0x68, 0x50, 0xCC, 0x20, 0xBC, 0x84, 0x18,
	0x44, 0xD8, 0xE0, 0x7C, 0x90, 0x0C, 0x34, 0xA8, 0x70, 0xEC, 0xD4, 0x48, 0xA4, 0x38, 0x00, 0x9C,
	0x2C, 0xB0, 0x88, 0x14, 0xF8, 0x64, 0x5C, 0xC0, 0x18, 0x84, 0xBC, 0x20, 0xCC, 0x50, 0x68, 0xF4,
	0x94, 0x08, 0x30, 0xAC, 0x40, 0xDC, 0xE4, 0x78, 0xA0, 0x3C, 0x04, 0x98, 0x74, 0xE8, 0xD0, 0x4C,
	0xFC, 0x60, 0x58, 0xC4, 0x28, 0xB4, 0x8C, 0x10, 0xC8, 0x54, 0x6C, 0xF0, 0x1C, 0x80, 0xB8, 0x24
	);

	public function __construct()
	{	
		$this->FHash = 0x3F;
		$this->Check = '0D';
		
		$this->FHash = $this->FHash << 2;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{    	
			$this->FHash = $this->Table[$this->FHash ^ ord($Msg[$i])] ;
		}   
	}
	
	public function Finish()
	{
		$this->FHash = $this->FHash >> 2;
		return sprintf('%02X', $this->FHash); 
	}
}

$HasherList->RegisterHasher('CRC-6/CDMA2000-A', 'HasherCRC6_CDMA2000A');


