<?php
//SIZE64
//Author: domasz
//Version: 0.1 (2022-11-17)
//Licence: MIT

require_once 'HasherBase.php';

class HasherSIZE64 extends HasherBase
{
	protected $FHash;

	public function __construct()
	{
		$this->Check = '0000000000000009';
		$this->FHash = 0;
	}
	
	public function Update($Msg, $Length)
	{
		$this->FHash = $this->FHash + $Length;
	}
	
	public function Finish()
	{
		return sprintf('%016X', $this->FHash);
	}
}

$HasherList->RegisterHasher('SIZE64', 'HasherSIZE64');


