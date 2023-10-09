<?php
//SUM64
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherSUM64 extends HasherBase
{
	protected $FHash;
	
	public function __construct()
	{
		$this->Check = '00000000000001DD';
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
		return sprintf('%016X', $this->FHash);
	}
}

$HasherList->RegisterHasher('SUM64', 'HasherSUM64');


