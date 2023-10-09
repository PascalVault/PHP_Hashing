<?php
//CRC-24 BLE
//Author: domasz
//Last Update: 2022-11-22
//Licence: MIT  

require_once 'HasherBase.php';

class HasherCRC24_BLE extends HasherBase
{
	protected $FHash;

	protected $Table = array(
	0x00000000, 0x0001B4C0, 0x00036980, 0x0002DD40, 0x0006D300, 0x000767C0, 0x0005BA80, 0x00040E40, 
	0x000DA600, 0x000C12C0, 0x000ECF80, 0x000F7B40, 0x000B7500, 0x000AC1C0, 0x00081C80, 0x0009A840, 
	0x001B4C00, 0x001AF8C0, 0x00182580, 0x00199140, 0x001D9F00, 0x001C2BC0, 0x001EF680, 0x001F4240, 
	0x0016EA00, 0x00175EC0, 0x00158380, 0x00143740, 0x00103900, 0x00118DC0, 0x00135080, 0x0012E440, 
	0x00369800, 0x00372CC0, 0x0035F180, 0x00344540, 0x00304B00, 0x0031FFC0, 0x00332280, 0x00329640, 
	0x003B3E00, 0x003A8AC0, 0x00385780, 0x0039E340, 0x003DED00, 0x003C59C0, 0x003E8480, 0x003F3040, 
	0x002DD400, 0x002C60C0, 0x002EBD80, 0x002F0940, 0x002B0700, 0x002AB3C0, 0x00286E80, 0x0029DA40, 
	0x00207200, 0x0021C6C0, 0x00231B80, 0x0022AF40, 0x0026A100, 0x002715C0, 0x0025C880, 0x00247C40, 
	0x006D3000, 0x006C84C0, 0x006E5980, 0x006FED40, 0x006BE300, 0x006A57C0, 0x00688A80, 0x00693E40, 
	0x00609600, 0x006122C0, 0x0063FF80, 0x00624B40, 0x00664500, 0x0067F1C0, 0x00652C80, 0x00649840, 
	0x00767C00, 0x0077C8C0, 0x00751580, 0x0074A140, 0x0070AF00, 0x00711BC0, 0x0073C680, 0x00727240, 
	0x007BDA00, 0x007A6EC0, 0x0078B380, 0x00790740, 0x007D0900, 0x007CBDC0, 0x007E6080, 0x007FD440, 
	0x005BA800, 0x005A1CC0, 0x0058C180, 0x00597540, 0x005D7B00, 0x005CCFC0, 0x005E1280, 0x005FA640, 
	0x00560E00, 0x0057BAC0, 0x00556780, 0x0054D340, 0x0050DD00, 0x005169C0, 0x0053B480, 0x00520040, 
	0x0040E400, 0x004150C0, 0x00438D80, 0x00423940, 0x00463700, 0x004783C0, 0x00455E80, 0x0044EA40, 
	0x004D4200, 0x004CF6C0, 0x004E2B80, 0x004F9F40, 0x004B9100, 0x004A25C0, 0x0048F880, 0x00494C40, 
	0x00DA6000, 0x00DBD4C0, 0x00D90980, 0x00D8BD40, 0x00DCB300, 0x00DD07C0, 0x00DFDA80, 0x00DE6E40, 
	0x00D7C600, 0x00D672C0, 0x00D4AF80, 0x00D51B40, 0x00D11500, 0x00D0A1C0, 0x00D27C80, 0x00D3C840, 
	0x00C12C00, 0x00C098C0, 0x00C24580, 0x00C3F140, 0x00C7FF00, 0x00C64BC0, 0x00C49680, 0x00C52240, 
	0x00CC8A00, 0x00CD3EC0, 0x00CFE380, 0x00CE5740, 0x00CA5900, 0x00CBEDC0, 0x00C93080, 0x00C88440, 
	0x00ECF800, 0x00ED4CC0, 0x00EF9180, 0x00EE2540, 0x00EA2B00, 0x00EB9FC0, 0x00E94280, 0x00E8F640, 
	0x00E15E00, 0x00E0EAC0, 0x00E23780, 0x00E38340, 0x00E78D00, 0x00E639C0, 0x00E4E480, 0x00E55040, 
	0x00F7B400, 0x00F600C0, 0x00F4DD80, 0x00F56940, 0x00F16700, 0x00F0D3C0, 0x00F20E80, 0x00F3BA40, 
	0x00FA1200, 0x00FBA6C0, 0x00F97B80, 0x00F8CF40, 0x00FCC100, 0x00FD75C0, 0x00FFA880, 0x00FE1C40, 
	0x00B75000, 0x00B6E4C0, 0x00B43980, 0x00B58D40, 0x00B18300, 0x00B037C0, 0x00B2EA80, 0x00B35E40, 
	0x00BAF600, 0x00BB42C0, 0x00B99F80, 0x00B82B40, 0x00BC2500, 0x00BD91C0, 0x00BF4C80, 0x00BEF840, 
	0x00AC1C00, 0x00ADA8C0, 0x00AF7580, 0x00AEC140, 0x00AACF00, 0x00AB7BC0, 0x00A9A680, 0x00A81240, 
	0x00A1BA00, 0x00A00EC0, 0x00A2D380, 0x00A36740, 0x00A76900, 0x00A6DDC0, 0x00A40080, 0x00A5B440, 
	0x0081C800, 0x00807CC0, 0x0082A180, 0x00831540, 0x00871B00, 0x0086AFC0, 0x00847280, 0x0085C640, 
	0x008C6E00, 0x008DDAC0, 0x008F0780, 0x008EB340, 0x008ABD00, 0x008B09C0, 0x0089D480, 0x00886040, 
	0x009A8400, 0x009B30C0, 0x0099ED80, 0x00985940, 0x009C5700, 0x009DE3C0, 0x009F3E80, 0x009E8A40, 
	0x00972200, 0x009696C0, 0x00944B80, 0x0095FF40, 0x0091F100, 0x009045C0, 0x00929880, 0x00932C40
	);
	
	public function __construct()
	{		
		$this->Check = 'C25A56';
		$this->FHash = 0xAAAAAA;
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash >> 8) ^ $this->Table[($this->FHash ^ ord($Msg[$i])) & 0xFF];
		}   
	}
	
	public function Finish()
	{
		$this->FHash = $this->FHash & 0xFFFFFF;
		return sprintf('%06X', $this->FHash);
	}
}

$HasherList->RegisterHasher('CRC-24 BLE', 'HasherCRC24_BLE');


