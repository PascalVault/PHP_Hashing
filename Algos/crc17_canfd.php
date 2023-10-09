<?php
//CRC-17 CAN-FD
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class Hashercrc17_canfd extends HasherBase
{
	protected $FHash;

	protected $Table = array(
	0x00000000, 0x0001685B, 0x0001B8ED, 0x0000D0B6, 0x00001981, 0x000171DA, 0x0001A16C, 0x0000C937,
	0x00003302, 0x00015B59, 0x00018BEF, 0x0000E3B4, 0x00002A83, 0x000142D8, 0x0001926E, 0x0000FA35,
	0x00006604, 0x00010E5F, 0x0001DEE9, 0x0000B6B2, 0x00007F85, 0x000117DE, 0x0001C768, 0x0000AF33,
	0x00005506, 0x00013D5D, 0x0001EDEB, 0x000085B0, 0x00004C87, 0x000124DC, 0x0001F46A, 0x00009C31,
	0x0000CC08, 0x0001A453, 0x000174E5, 0x00001CBE, 0x0000D589, 0x0001BDD2, 0x00016D64, 0x0000053F,
	0x0000FF0A, 0x00019751, 0x000147E7, 0x00002FBC, 0x0000E68B, 0x00018ED0, 0x00015E66, 0x0000363D,
	0x0000AA0C, 0x0001C257, 0x000112E1, 0x00007ABA, 0x0000B38D, 0x0001DBD6, 0x00010B60, 0x0000633B,
	0x0000990E, 0x0001F155, 0x000121E3, 0x000049B8, 0x0000808F, 0x0001E8D4, 0x00013862, 0x00005039,
	0x00019810, 0x0000F04B, 0x000020FD, 0x000148A6, 0x00018191, 0x0000E9CA, 0x0000397C, 0x00015127,
	0x0001AB12, 0x0000C349, 0x000013FF, 0x00017BA4, 0x0001B293, 0x0000DAC8, 0x00000A7E, 0x00016225,
	0x0001FE14, 0x0000964F, 0x000046F9, 0x00012EA2, 0x0001E795, 0x00008FCE, 0x00005F78, 0x00013723,
	0x0001CD16, 0x0000A54D, 0x000075FB, 0x00011DA0, 0x0001D497, 0x0000BCCC, 0x00006C7A, 0x00010421,
	0x00015418, 0x00003C43, 0x0000ECF5, 0x000184AE, 0x00014D99, 0x000025C2, 0x0000F574, 0x00019D2F,
	0x0001671A, 0x00000F41, 0x0000DFF7, 0x0001B7AC, 0x00017E9B, 0x000016C0, 0x0000C676, 0x0001AE2D,
	0x0001321C, 0x00005A47, 0x00008AF1, 0x0001E2AA, 0x00012B9D, 0x000043C6, 0x00009370, 0x0001FB2B,
	0x0001011E, 0x00006945, 0x0000B9F3, 0x0001D1A8, 0x0001189F, 0x000070C4, 0x0000A072, 0x0001C829,
	0x0000587B, 0x00013020, 0x0001E096, 0x000088CD, 0x000041FA, 0x000129A1, 0x0001F917, 0x0000914C,
	0x00006B79, 0x00010322, 0x0001D394, 0x0000BBCF, 0x000072F8, 0x00011AA3, 0x0001CA15, 0x0000A24E,
	0x00003E7F, 0x00015624, 0x00018692, 0x0000EEC9, 0x000027FE, 0x00014FA5, 0x00019F13, 0x0000F748,
	0x00000D7D, 0x00016526, 0x0001B590, 0x0000DDCB, 0x000014FC, 0x00017CA7, 0x0001AC11, 0x0000C44A,
	0x00009473, 0x0001FC28, 0x00012C9E, 0x000044C5, 0x00008DF2, 0x0001E5A9, 0x0001351F, 0x00005D44,
	0x0000A771, 0x0001CF2A, 0x00011F9C, 0x000077C7, 0x0000BEF0, 0x0001D6AB, 0x0001061D, 0x00006E46,
	0x0000F277, 0x00019A2C, 0x00014A9A, 0x000022C1, 0x0000EBF6, 0x000183AD, 0x0001531B, 0x00003B40,
	0x0000C175, 0x0001A92E, 0x00017998, 0x000011C3, 0x0000D8F4, 0x0001B0AF, 0x00016019, 0x00000842,
	0x0001C06B, 0x0000A830, 0x00007886, 0x000110DD, 0x0001D9EA, 0x0000B1B1, 0x00006107, 0x0001095C,
	0x0001F369, 0x00009B32, 0x00004B84, 0x000123DF, 0x0001EAE8, 0x000082B3, 0x00005205, 0x00013A5E,
	0x0001A66F, 0x0000CE34, 0x00001E82, 0x000176D9, 0x0001BFEE, 0x0000D7B5, 0x00000703, 0x00016F58,
	0x0001956D, 0x0000FD36, 0x00002D80, 0x000145DB, 0x00018CEC, 0x0000E4B7, 0x00003401, 0x00015C5A,
	0x00010C63, 0x00006438, 0x0000B48E, 0x0001DCD5, 0x000115E2, 0x00007DB9, 0x0000AD0F, 0x0001C554,
	0x00013F61, 0x0000573A, 0x0000878C, 0x0001EFD7, 0x000126E0, 0x00004EBB, 0x00009E0D, 0x0001F656,
	0x00016A67, 0x0000023C, 0x0000D28A, 0x0001BAD1, 0x000173E6, 0x00001BBD, 0x0000CB0B, 0x0001A350,
	0x00015965, 0x0000313E, 0x0000E188, 0x000189D3, 0x000140E4, 0x000028BF, 0x0000F809, 0x00019052
	);
	
	public function __construct()
	{	
		$this->FHash = 0;
		$this->Check = '04F03';
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash << 8) ^ $this->Table[(ord($Msg[$i]) ^ ($this->FHash >> 9)) & 0xFF];
		}   
	}
	
	public function Finish()
	{
		$this->FHash = $this->FHash & 0x1FFFF;
		return sprintf('%05X', $this->FHash);
	}
}


$HasherList->RegisterHasher('CRC-17 CAN-FD', 'Hashercrc17_canfd');


