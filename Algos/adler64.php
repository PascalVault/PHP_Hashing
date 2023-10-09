<?php
//Adler-64
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherAdler64 extends HasherBase
{
	protected $FHash, $FHash2;

	public function __construct()
	{  
		$this->Check = '0000091E000001DE';
		$this->FHash = 1;
		$this->FHash2 = 0;
	}
	
	public function Update($Msg, $Length)
	{
		$MOD_ADLER = 4294967291;
		for ($i=0; $i<$Length; $i++)
		{
	    	$this->FHash = ($this->FHash + ord($Msg[$i]))  %  $MOD_ADLER;
		    $this->FHash2 = ($this->FHash2 + $this->FHash)  %  $MOD_ADLER;
	    
		}   
	}
	
	public function Finish()
	{
		$this->FHash = ($this->FHash2 << 32) | $this->FHash;
		return sprintf('%016X', $this->FHash);
	}
}

$HasherList->RegisterHasher('Adler-64', 'HasherAdler64');


