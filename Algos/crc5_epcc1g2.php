<?php
//CRC-5 EPC-C1G2
//Author: domasz
//Last Update: 2022-11-22
//Licence: MIT

require_once 'HasherBase.php';

class HasherCRC5_EPCC1G2 extends HasherBase
{
	protected $FHash;

	protected $Table = array(
	0x15, 0x1C, 0x07, 0x0E, 0x18, 0x11, 0x0A, 0x03, 
	0x0F, 0x06, 0x1D, 0x14, 0x02, 0x0B, 0x10, 0x19, 
	0x08, 0x01, 0x1A, 0x13, 0x05, 0x0C, 0x17, 0x1E, 
	0x12, 0x1B, 0x00, 0x09, 0x1F, 0x16, 0x0D, 0x04, 
	0x06, 0x0F, 0x14, 0x1D, 0x0B, 0x02, 0x19, 0x10, 
	0x1C, 0x15, 0x0E, 0x07, 0x11, 0x18, 0x03, 0x0A, 
	0x1B, 0x12, 0x09, 0x00, 0x16, 0x1F, 0x04, 0x0D, 
	0x01, 0x08, 0x13, 0x1A, 0x0C, 0x05, 0x1E, 0x17, 
	0x1A, 0x13, 0x08, 0x01, 0x17, 0x1E, 0x05, 0x0C, 
	0x00, 0x09, 0x12, 0x1B, 0x0D, 0x04, 0x1F, 0x16, 
	0x07, 0x0E, 0x15, 0x1C, 0x0A, 0x03, 0x18, 0x11, 
	0x1D, 0x14, 0x0F, 0x06, 0x10, 0x19, 0x02, 0x0B, 
	0x09, 0x00, 0x1B, 0x12, 0x04, 0x0D, 0x16, 0x1F, 
	0x13, 0x1A, 0x01, 0x08, 0x1E, 0x17, 0x0C, 0x05, 
	0x14, 0x1D, 0x06, 0x0F, 0x19, 0x10, 0x0B, 0x02, 
	0x0E, 0x07, 0x1C, 0x15, 0x03, 0x0A, 0x11, 0x18, 
	0x0B, 0x02, 0x19, 0x10, 0x06, 0x0F, 0x14, 0x1D, 
	0x11, 0x18, 0x03, 0x0A, 0x1C, 0x15, 0x0E, 0x07, 
	0x16, 0x1F, 0x04, 0x0D, 0x1B, 0x12, 0x09, 0x00, 
	0x0C, 0x05, 0x1E, 0x17, 0x01, 0x08, 0x13, 0x1A, 
	0x18, 0x11, 0x0A, 0x03, 0x15, 0x1C, 0x07, 0x0E, 
	0x02, 0x0B, 0x10, 0x19, 0x0F, 0x06, 0x1D, 0x14, 
	0x05, 0x0C, 0x17, 0x1E, 0x08, 0x01, 0x1A, 0x13, 
	0x1F, 0x16, 0x0D, 0x04, 0x12, 0x1B, 0x00, 0x09, 
	0x04, 0x0D, 0x16, 0x1F, 0x09, 0x00, 0x1B, 0x12, 
	0x1E, 0x17, 0x0C, 0x05, 0x13, 0x1A, 0x01, 0x08, 
	0x19, 0x10, 0x0B, 0x02, 0x14, 0x1D, 0x06, 0x0F, 
	0x03, 0x0A, 0x11, 0x18, 0x0E, 0x07, 0x1C, 0x15, 
	0x17, 0x1E, 0x05, 0x0C, 0x1A, 0x13, 0x08, 0x01, 
	0x0D, 0x04, 0x1F, 0x16, 0x00, 0x09, 0x12, 0x1B, 
	0x0A, 0x03, 0x18, 0x11, 0x07, 0x0E, 0x15, 0x1C, 
	0x10, 0x19, 0x02, 0x0B, 0x1D, 0x14, 0x0F, 0x06
	);

	public function __construct()	
	{
		$this->FHash = 0x09;
		$this->Check = '00';
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->Table[($this->FHash << 3) ^ ord($Msg[$i]) ] ;
		}   
	}
	
	public function Finish()
	{
		$this->FHash = ($this->FHash >> 3) ;
		return sprintf('%02X', $this->FHash);
	}
}

$HasherList->RegisterHasher('CRC-5 EPC-C1G2', 'HasherCRC5_EPCC1G2');


