<?php
//CRC-4 interlaken
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherCRC4_interlaken extends HasherBase
{
	protected $FHash;

	protected $Table = array(
	0x60, 0x50, 0x00, 0x30, 0xA0, 0x90, 0xC0, 0xF0, 0xD0, 0xE0, 0xB0, 0x80, 0x10, 0x20, 0x70, 0x40,
	0x30, 0x00, 0x50, 0x60, 0xF0, 0xC0, 0x90, 0xA0, 0x80, 0xB0, 0xE0, 0xD0, 0x40, 0x70, 0x20, 0x10,
	0xC0, 0xF0, 0xA0, 0x90, 0x00, 0x30, 0x60, 0x50, 0x70, 0x40, 0x10, 0x20, 0xB0, 0x80, 0xD0, 0xE0,
	0x90, 0xA0, 0xF0, 0xC0, 0x50, 0x60, 0x30, 0x00, 0x20, 0x10, 0x40, 0x70, 0xE0, 0xD0, 0x80, 0xB0,
	0x10, 0x20, 0x70, 0x40, 0xD0, 0xE0, 0xB0, 0x80, 0xA0, 0x90, 0xC0, 0xF0, 0x60, 0x50, 0x00, 0x30,
	0x40, 0x70, 0x20, 0x10, 0x80, 0xB0, 0xE0, 0xD0, 0xF0, 0xC0, 0x90, 0xA0, 0x30, 0x00, 0x50, 0x60,
	0xB0, 0x80, 0xD0, 0xE0, 0x70, 0x40, 0x10, 0x20, 0x00, 0x30, 0x60, 0x50, 0xC0, 0xF0, 0xA0, 0x90,
	0xE0, 0xD0, 0x80, 0xB0, 0x20, 0x10, 0x40, 0x70, 0x50, 0x60, 0x30, 0x00, 0x90, 0xA0, 0xF0, 0xC0,
	0x80, 0xB0, 0xE0, 0xD0, 0x40, 0x70, 0x20, 0x10, 0x30, 0x00, 0x50, 0x60, 0xF0, 0xC0, 0x90, 0xA0,
	0xD0, 0xE0, 0xB0, 0x80, 0x10, 0x20, 0x70, 0x40, 0x60, 0x50, 0x00, 0x30, 0xA0, 0x90, 0xC0, 0xF0,
	0x20, 0x10, 0x40, 0x70, 0xE0, 0xD0, 0x80, 0xB0, 0x90, 0xA0, 0xF0, 0xC0, 0x50, 0x60, 0x30, 0x00,
	0x70, 0x40, 0x10, 0x20, 0xB0, 0x80, 0xD0, 0xE0, 0xC0, 0xF0, 0xA0, 0x90, 0x00, 0x30, 0x60, 0x50,
	0xF0, 0xC0, 0x90, 0xA0, 0x30, 0x00, 0x50, 0x60, 0x40, 0x70, 0x20, 0x10, 0x80, 0xB0, 0xE0, 0xD0,
	0xA0, 0x90, 0xC0, 0xF0, 0x60, 0x50, 0x00, 0x30, 0x10, 0x20, 0x70, 0x40, 0xD0, 0xE0, 0xB0, 0x80,
	0x50, 0x60, 0x30, 0x00, 0x90, 0xA0, 0xF0, 0xC0, 0xE0, 0xD0, 0x80, 0xB0, 0x20, 0x10, 0x40, 0x70,
	0x00, 0x30, 0x60, 0x50, 0xC0, 0xF0, 0xA0, 0x90, 0xB0, 0x80, 0xD0, 0xE0, 0x70, 0x40, 0x10, 0x20
	);

	public function __construct()
	{  
		$this->FHash = 0x00;
		$this->Check = '7';
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->Table[$this->FHash ^ ord($Msg[$i])];
		}   
	}
	
	public function Finish()
	{
		$this->FHash = ($this->FHash >> 4) ;		
		return sprintf('%01X', $this->FHash);
	}
}

$HasherList->RegisterHasher('CRC-4 Interlaken', 'HasherCRC4_interlaken');



