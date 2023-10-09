<?php
//Fletcher-64
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherFletcher64 extends HasherBase
{
	protected $FHash, $FHash2;
	
	public function __construct()
	{	
		$this->Check = '00000915000001DD';
		$this->FHash = 0;
		$this->FHash2 = 0;
	}
	
	public function Update($Msg, $Length)	
	{
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = ($this->FHash + ord($Msg[$i]))  %  4294967295;
			$this->FHash2 = ($this->FHash2 + $this->FHash)  %  4294967295;
		}   
	}
	
	public function Finish()
	{
		$this->FHash = ($this->FHash2 << 32) | $this->FHash;
		return sprintf('%016X', $this->FHash);
	}
}

$HasherList->RegisterHasher('Fletcher-64', 'HasherFletcher64');


