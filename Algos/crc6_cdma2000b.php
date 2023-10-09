<?php
//CRC-6/CDMA2000-B
//Author: domasz
//Last Update: 2022-11-29
//Licence: MIT  

require_once 'HasherBase.php';

class HasherCRC6_CDMA2000B extends HasherBase
{
	protected $FHash;

	protected $Table = array(
	0x00, 0x1C, 0x38, 0x24, 0x70, 0x6C, 0x48, 0x54, 0xE0, 0xFC, 0xD8, 0xC4, 0x90, 0x8C, 0xA8, 0xB4, 
	0xDC, 0xC0, 0xE4, 0xF8, 0xAC, 0xB0, 0x94, 0x88, 0x3C, 0x20, 0x04, 0x18, 0x4C, 0x50, 0x74, 0x68, 
	0xA4, 0xB8, 0x9C, 0x80, 0xD4, 0xC8, 0xEC, 0xF0, 0x44, 0x58, 0x7C, 0x60, 0x34, 0x28, 0x0C, 0x10, 
	0x78, 0x64, 0x40, 0x5C, 0x08, 0x14, 0x30, 0x2C, 0x98, 0x84, 0xA0, 0xBC, 0xE8, 0xF4, 0xD0, 0xCC, 
	0x54, 0x48, 0x6C, 0x70, 0x24, 0x38, 0x1C, 0x00, 0xB4, 0xA8, 0x8C, 0x90, 0xC4, 0xD8, 0xFC, 0xE0, 
	0x88, 0x94, 0xB0, 0xAC, 0xF8, 0xE4, 0xC0, 0xDC, 0x68, 0x74, 0x50, 0x4C, 0x18, 0x04, 0x20, 0x3C, 
	0xF0, 0xEC, 0xC8, 0xD4, 0x80, 0x9C, 0xB8, 0xA4, 0x10, 0x0C, 0x28, 0x34, 0x60, 0x7C, 0x58, 0x44, 
	0x2C, 0x30, 0x14, 0x08, 0x5C, 0x40, 0x64, 0x78, 0xCC, 0xD0, 0xF4, 0xE8, 0xBC, 0xA0, 0x84, 0x98, 
	0xA8, 0xB4, 0x90, 0x8C, 0xD8, 0xC4, 0xE0, 0xFC, 0x48, 0x54, 0x70, 0x6C, 0x38, 0x24, 0x00, 0x1C, 
	0x74, 0x68, 0x4C, 0x50, 0x04, 0x18, 0x3C, 0x20, 0x94, 0x88, 0xAC, 0xB0, 0xE4, 0xF8, 0xDC, 0xC0, 
	0x0C, 0x10, 0x34, 0x28, 0x7C, 0x60, 0x44, 0x58, 0xEC, 0xF0, 0xD4, 0xC8, 0x9C, 0x80, 0xA4, 0xB8, 
	0xD0, 0xCC, 0xE8, 0xF4, 0xA0, 0xBC, 0x98, 0x84, 0x30, 0x2C, 0x08, 0x14, 0x40, 0x5C, 0x78, 0x64, 
	0xFC, 0xE0, 0xC4, 0xD8, 0x8C, 0x90, 0xB4, 0xA8, 0x1C, 0x00, 0x24, 0x38, 0x6C, 0x70, 0x54, 0x48, 
	0x20, 0x3C, 0x18, 0x04, 0x50, 0x4C, 0x68, 0x74, 0xC0, 0xDC, 0xF8, 0xE4, 0xB0, 0xAC, 0x88, 0x94, 
	0x58, 0x44, 0x60, 0x7C, 0x28, 0x34, 0x10, 0x0C, 0xB8, 0xA4, 0x80, 0x9C, 0xC8, 0xD4, 0xF0, 0xEC, 
	0x84, 0x98, 0xBC, 0xA0, 0xF4, 0xE8, 0xCC, 0xD0, 0x64, 0x78, 0x5C, 0x40, 0x14, 0x08, 0x2C, 0x30
	);
	
	public function __construct()
	{	
		$this->FHash = 0x3F;
		$this->Check = '3B';
		
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

$HasherList->RegisterHasher('CRC-6/CDMA2000-B', 'HasherCRC6_CDMA2000B');

