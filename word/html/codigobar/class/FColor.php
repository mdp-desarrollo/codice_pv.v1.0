<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

class FColor {
	protected $r,$g,$b;	

	public function __construct($r,$g,$b){
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
	}

	public function r(){
		return $this->r;
	}

	public function g(){
		return $this->g;
	}

	public function b(){
		return $this->b;
	}

	public function allocate($im) {
		return imagecolorallocate($im,$this->r,$this->g,$this->b);
	}
};
?>