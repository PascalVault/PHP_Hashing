<?php
//CRC-5 USB
//Author: domasz
//Last Update: 2022-11-21
//Licence: MIT  

require_once 'HasherBase.php';

class HasherCRC5_USB extends HasherBase
{
	protected $FHash;
	
	protected $Table = array(
	0x01, 0x0F, 0x1D, 0x13, 0x10, 0x1E, 0x0C, 0x02, 
	0x0A, 0x04, 0x16, 0x18, 0x1B, 0x15, 0x07, 0x09, 
	0x17, 0x19, 0x0B, 0x05, 0x06, 0x08, 0x1A, 0x14, 
	0x1C, 0x12, 0x00, 0x0E, 0x0D, 0x03, 0x11, 0x1F, 
	0x04, 0x0A, 0x18, 0x16, 0x15, 0x1B, 0x09, 0x07, 
	0x0F, 0x01, 0x13, 0x1D, 0x1E, 0x10, 0x02, 0x0C, 
	0x12, 0x1C, 0x0E, 0x00, 0x03, 0x0D, 0x1F, 0x11, 
	0x19, 0x17, 0x05, 0x0B, 0x08, 0x06, 0x14, 0x1A, 
	0x0B, 0x05, 0x17, 0x19, 0x1A, 0x14, 0x06, 0x08, 
	0x00, 0x0E, 0x1C, 0x12, 0x11, 0x1F, 0x0D, 0x03, 
	0x1D, 0x13, 0x01, 0x0F, 0x0C, 0x02, 0x10, 0x1E, 
	0x16, 0x18, 0x0A, 0x04, 0x07, 0x09, 0x1B, 0x15, 
	0x0E, 0x00, 0x12, 0x1C, 0x1F, 0x11, 0x03, 0x0D, 
	0x05, 0x0B, 0x19, 0x17, 0x14, 0x1A, 0x08, 0x06, 
	0x18, 0x16, 0x04, 0x0A, 0x09, 0x07, 0x15, 0x1B, 
	0x13, 0x1D, 0x0F, 0x01, 0x02, 0x0C, 0x1E, 0x10, 
	0x15, 0x1B, 0x09, 0x07, 0x04, 0x0A, 0x18, 0x16, 
	0x1E, 0x10, 0x02, 0x0C, 0x0F, 0x01, 0x13, 0x1D, 
	0x03, 0x0D, 0x1F, 0x11, 0x12, 0x1C, 0x0E, 0x00, 
	0x08, 0x06, 0x14, 0x1A, 0x19, 0x17, 0x05, 0x0B, 
	0x10, 0x1E, 0x0C, 0x02, 0x01, 0x0F, 0x1D, 0x13, 
	0x1B, 0x15, 0x07, 0x09, 0x0A, 0x04, 0x16, 0x18, 
	0x06, 0x08, 0x1A, 0x14, 0x17, 0x19, 0x0B, 0x05, 
	0x0D, 0x03, 0x11, 0x1F, 0x1C, 0x12, 0x00, 0x0E, 
	0x1F, 0x11, 0x03, 0x0D, 0x0E, 0x00, 0x12, 0x1C, 
	0x14, 0x1A, 0x08, 0x06, 0x05, 0x0B, 0x19, 0x17, 
	0x09, 0x07, 0x15, 0x1B, 0x18, 0x16, 0x04, 0x0A, 
	0x02, 0x0C, 0x1E, 0x10, 0x13, 0x1D, 0x0F, 0x01, 
	0x1A, 0x14, 0x06, 0x08, 0x0B, 0x05, 0x17, 0x19, 
	0x11, 0x1F, 0x0D, 0x03, 0x00, 0x0E, 0x1C, 0x12, 
	0x0C, 0x02, 0x10, 0x1E, 0x1D, 0x13, 0x01, 0x0F, 
	0x07, 0x09, 0x1B, 0x15, 0x16, 0x18, 0x0A, 0x04
	);
	
	public function __construct()
	{	
		$this->FHash = 0x00;
		$this->Check = '19';
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

$HasherList->RegisterHasher('CRC-5 USB', 'HasherCRC5_USB');

