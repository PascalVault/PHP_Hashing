<?php
//MySQL 3 password()
//Author: domasz
//Last Update: 2022-11-22
//Licence: MIT  

require_once 'HasherBase.php';

class HasherMySQL3 extends HasherBase
{
	protected $FHash, $FHash2, $Add;

	public function __construct()
	{	
		$this->Check = '0C95234760AE5A28';
		
		$this->FHash = 1345345333;
		$this->FHash2 = 0x12345671;
		$this->Add = 7;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			if ($Msg[$i] == ' ' or $Msg[$i] == "\t") continue;
			
			$this->FHash = $this->FHash ^ ( ((($this->FHash & 63) + $this->Add) * ord($Msg[$i])) + ($this->FHash << 8) & 0xFFFFFFFF);
			$this->FHash2 = ($this->FHash2 + (($this->FHash2 << 8) ^ $this->FHash)) & 0xFFFFFFFF;
			$this->Add = ($this->Add + ord($Msg[$i])) & 0xFFFFFFFF;
		}   
	}
	
	public function Finish()
	{
		$this->FHash = $this->FHash & 0x7FFFFFFF;
		$this->FHash2 = $this->FHash2 & 0x7FFFFFFF;
		
		return sprintf('%08X', $this->FHash) . sprintf('%08X', $this->FHash2);
	}
}

$HasherList->RegisterHasher('MySQL 3', 'HasherMySQL3');


