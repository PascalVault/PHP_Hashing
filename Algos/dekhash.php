<?php
//DEK Hash

require_once 'HasherBase.php';

class HasherDEKHash extends HasherBase
{
	protected $FHash;	
	
	public function __construct()
	{	
		$this->Check = 'AB4ACBA5';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)
	{
		$this->FHash = $Length;
		
		for ($i=0; $i<$Length; $i++)
		{
			$this->FHash = (($this->FHash << 5) ^ ($this->FHash >> 27)) ^ ord($Msg[$i]);
			$this->FHash &= 0xFFFFFFFF; //limit to 32bit
		}   
	}
	
	public function Finish()
	{
		return sprintf('%08X', $this->FHash);
	}
}

$HasherList->RegisterHasher('DEK Hash', 'HasherDEKHash');


