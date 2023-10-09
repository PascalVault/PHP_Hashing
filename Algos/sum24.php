<?php
//SUM24
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherSUM24 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{
		$this->Check = '0001DD';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = $this->FHash + ord($Msg[$i]);
		}   
	}
	
	public function Finish()
	{
		$this->FHash = $this->FHash & 0xFFFFFF;
		return sprintf('%06X', $this->FHash);
	}
}

$HasherList->RegisterHasher('SUM24', 'HasherSUM24');


