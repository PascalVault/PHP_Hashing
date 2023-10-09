<?php
//CRC-5 G-704
//Author: domasz
//Last Update: 2022-11-21
//Licence: MIT  

require_once 'HasherBase.php';

class HasherCRC5_G704 extends HasherBase
{
	protected $FHash;

	protected $Table = array(
	0x00, 0x07, 0x0E, 0x09, 0x1C, 0x1B, 0x12, 0x15, 
	0x13, 0x14, 0x1D, 0x1A, 0x0F, 0x08, 0x01, 0x06, 
	0x0D, 0x0A, 0x03, 0x04, 0x11, 0x16, 0x1F, 0x18, 
	0x1E, 0x19, 0x10, 0x17, 0x02, 0x05, 0x0C, 0x0B, 
	0x1A, 0x1D, 0x14, 0x13, 0x06, 0x01, 0x08, 0x0F, 
	0x09, 0x0E, 0x07, 0x00, 0x15, 0x12, 0x1B, 0x1C, 
	0x17, 0x10, 0x19, 0x1E, 0x0B, 0x0C, 0x05, 0x02, 
	0x04, 0x03, 0x0A, 0x0D, 0x18, 0x1F, 0x16, 0x11, 
	0x1F, 0x18, 0x11, 0x16, 0x03, 0x04, 0x0D, 0x0A, 
	0x0C, 0x0B, 0x02, 0x05, 0x10, 0x17, 0x1E, 0x19, 
	0x12, 0x15, 0x1C, 0x1B, 0x0E, 0x09, 0x00, 0x07, 
	0x01, 0x06, 0x0F, 0x08, 0x1D, 0x1A, 0x13, 0x14, 
	0x05, 0x02, 0x0B, 0x0C, 0x19, 0x1E, 0x17, 0x10, 
	0x16, 0x11, 0x18, 0x1F, 0x0A, 0x0D, 0x04, 0x03, 
	0x08, 0x0F, 0x06, 0x01, 0x14, 0x13, 0x1A, 0x1D, 
	0x1B, 0x1C, 0x15, 0x12, 0x07, 0x00, 0x09, 0x0E, 
	0x15, 0x12, 0x1B, 0x1C, 0x09, 0x0E, 0x07, 0x00, 
	0x06, 0x01, 0x08, 0x0F, 0x1A, 0x1D, 0x14, 0x13, 
	0x18, 0x1F, 0x16, 0x11, 0x04, 0x03, 0x0A, 0x0D, 
	0x0B, 0x0C, 0x05, 0x02, 0x17, 0x10, 0x19, 0x1E, 
	0x0F, 0x08, 0x01, 0x06, 0x13, 0x14, 0x1D, 0x1A, 
	0x1C, 0x1B, 0x12, 0x15, 0x00, 0x07, 0x0E, 0x09, 
	0x02, 0x05, 0x0C, 0x0B, 0x1E, 0x19, 0x10, 0x17, 
	0x11, 0x16, 0x1F, 0x18, 0x0D, 0x0A, 0x03, 0x04, 
	0x0A, 0x0D, 0x04, 0x03, 0x16, 0x11, 0x18, 0x1F, 
	0x19, 0x1E, 0x17, 0x10, 0x05, 0x02, 0x0B, 0x0C, 
	0x07, 0x00, 0x09, 0x0E, 0x1B, 0x1C, 0x15, 0x12, 
	0x14, 0x13, 0x1A, 0x1D, 0x08, 0x0F, 0x06, 0x01, 
	0x10, 0x17, 0x1E, 0x19, 0x0C, 0x0B, 0x02, 0x05, 
	0x03, 0x04, 0x0D, 0x0A, 0x1F, 0x18, 0x11, 0x16, 
	0x1D, 0x1A, 0x13, 0x14, 0x01, 0x06, 0x0F, 0x08, 
	0x0E, 0x09, 0x00, 0x07, 0x12, 0x15, 0x1C, 0x1B
	);
	
	public function __construct()
	{	
		$this->FHash = 0x00;
		$this->Check = '07';
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

$HasherList->RegisterHasher('CRC-5 G-704', 'HasherCRC5_G704');

