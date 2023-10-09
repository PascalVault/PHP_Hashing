<?php
//SUM16
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherSUM16 extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{
		$this->Check = '01DD';
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
		return sprintf('%04X', $this->FHash);
	}
}

$HasherList->RegisterHasher('SUM16', 'HasherSUM16');


