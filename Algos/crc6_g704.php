<?php
//CRC-6 G-704
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT  

require_once 'HasherBase.php';

class HasherCRC6_G704 extends HasherBase
{
	protected $FHash;

	protected $Table = array(
	0x00, 0x14, 0x28, 0x3C, 0x31, 0x25, 0x19, 0x0D, 
	0x03, 0x17, 0x2B, 0x3F, 0x32, 0x26, 0x1A, 0x0E, 
	0x06, 0x12, 0x2E, 0x3A, 0x37, 0x23, 0x1F, 0x0B, 
	0x05, 0x11, 0x2D, 0x39, 0x34, 0x20, 0x1C, 0x08, 
	0x0C, 0x18, 0x24, 0x30, 0x3D, 0x29, 0x15, 0x01, 
	0x0F, 0x1B, 0x27, 0x33, 0x3E, 0x2A, 0x16, 0x02, 
	0x0A, 0x1E, 0x22, 0x36, 0x3B, 0x2F, 0x13, 0x07, 
	0x09, 0x1D, 0x21, 0x35, 0x38, 0x2C, 0x10, 0x04, 
	0x18, 0x0C, 0x30, 0x24, 0x29, 0x3D, 0x01, 0x15, 
	0x1B, 0x0F, 0x33, 0x27, 0x2A, 0x3E, 0x02, 0x16, 
	0x1E, 0x0A, 0x36, 0x22, 0x2F, 0x3B, 0x07, 0x13, 
	0x1D, 0x09, 0x35, 0x21, 0x2C, 0x38, 0x04, 0x10, 
	0x14, 0x00, 0x3C, 0x28, 0x25, 0x31, 0x0D, 0x19, 
	0x17, 0x03, 0x3F, 0x2B, 0x26, 0x32, 0x0E, 0x1A, 
	0x12, 0x06, 0x3A, 0x2E, 0x23, 0x37, 0x0B, 0x1F, 
	0x11, 0x05, 0x39, 0x2D, 0x20, 0x34, 0x08, 0x1C, 
	0x30, 0x24, 0x18, 0x0C, 0x01, 0x15, 0x29, 0x3D, 
	0x33, 0x27, 0x1B, 0x0F, 0x02, 0x16, 0x2A, 0x3E, 
	0x36, 0x22, 0x1E, 0x0A, 0x07, 0x13, 0x2F, 0x3B, 
	0x35, 0x21, 0x1D, 0x09, 0x04, 0x10, 0x2C, 0x38, 
	0x3C, 0x28, 0x14, 0x00, 0x0D, 0x19, 0x25, 0x31, 
	0x3F, 0x2B, 0x17, 0x03, 0x0E, 0x1A, 0x26, 0x32, 
	0x3A, 0x2E, 0x12, 0x06, 0x0B, 0x1F, 0x23, 0x37, 
	0x39, 0x2D, 0x11, 0x05, 0x08, 0x1C, 0x20, 0x34, 
	0x28, 0x3C, 0x00, 0x14, 0x19, 0x0D, 0x31, 0x25, 
	0x2B, 0x3F, 0x03, 0x17, 0x1A, 0x0E, 0x32, 0x26, 
	0x2E, 0x3A, 0x06, 0x12, 0x1F, 0x0B, 0x37, 0x23, 
	0x2D, 0x39, 0x05, 0x11, 0x1C, 0x08, 0x34, 0x20, 
	0x24, 0x30, 0x0C, 0x18, 0x15, 0x01, 0x3D, 0x29, 
	0x27, 0x33, 0x0F, 0x1B, 0x16, 0x02, 0x3E, 0x2A, 
	0x22, 0x36, 0x0A, 0x1E, 0x13, 0x07, 0x3B, 0x2F, 
	0x21, 0x35, 0x09, 0x1D, 0x10, 0x04, 0x38, 0x2C
	);

	public function __construct()
	{
		$this->FHash = 0x00;
		$this->Check = '06';
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{    	
			$this->FHash = $this->Table[(0xFF & ($this->FHash ^ ord($Msg[$i])))];		
		}   
	}
	
	public function Finish()
	{
		return sprintf('%02X', $this->FHash); 
	}
}

$HasherList->RegisterHasher('CRC-6 G-704', 'HasherCRC6_G704');

