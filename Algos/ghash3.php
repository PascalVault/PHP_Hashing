<?php
//GHash3
//Author: domasz
//Last Update: 2022-11-20
//Licence: MIT

require_once 'HasherBase.php';

class HasherGHash3 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{	
		$this->Check = '8DCCB81D';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash << 3) + $this->FHash + ord($Msg[$i]);
		}   
	}
	
	public function Finish()
	{	
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('GHash3', 'HasherGHash3');


