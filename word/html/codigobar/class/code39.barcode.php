<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

class code39 extends BarCode {
	protected $keys = array(), $code = array();
	private $starting, $ending;
	protected $text;
	protected $textfont;
	private $checksum;

	public function __construct($maxHeight,FColor $color1,FColor $color2,$res,$text,$textfont,$checksum=false) {
		BarCode::__construct($maxHeight,$color1,$color2,$res);
		$this->starting = $this->ending = 43;
		$this->keys = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','-','.',' ','$','/','+','%','*');
		$this->code = array(	
			'0001101000',	
			'1001000010',
			'0011000010',	
			'1011000000',	
			'0001100010',	
			'1001100000',	
			'0011100000',	
			'0001001010',	
			'1001001000',	
			'0011001000',	
			'1000010010',	
			'0010010010',	
			'1010010000',	
			'0000110010',	
			'1000110000',	
			'0010110000',	
			'0000011010',	
			'1000011000',	
			'0010011000',	
			'0000111000',	
			'1000000110',	
			'0010000110',	
			'1010000100',	
			'0000100110',	
			'1000100100',	
			'0010100100',	
			'0000001110',	
			'1000001100',	
			'0010001100',	
			'0000101100',	
			'1100000010',	
			'0110000010',	
			'1110000000',	
			'0100100010',	
			'1100100000',	
			'0110100000',	
			'0100001010',	
			'1100001000',	
			'0110001000',	
			'0101010000',	
			'0101000100',	
			'0100010100',	
			'0001010100',	
			'0100101000'	
		);
		$this->setText($text);
		$this->textfont = $textfont;
		$this->checksum = $checksum;
	}

	public function setText($text) {
		$this->text = strtoupper($text);	
	}

	public function draw($im) {
		$error_stop = false;

		for($i=0;$i<strlen($this->text);$i++) {
			if(!is_int(array_search($this->text[$i],$this->keys))) {
				$this->DrawError($im,'Char \''.$this->text[$i].'\' not allowed.');
				$error_stop = true;
			}
		}
		if($error_stop == false) {
			if(is_int(strpos($this->text,'*'))) {
				$this->DrawError($im,'Char \'*\' not allowed.');
				$error_stop = true;
			}
			if($error_stop == false) {
				$this->DrawChar($im,$this->code[$this->starting],1);
				for($i=0;$i<strlen($this->text);$i++)
					$this->DrawChar($im,$this->findCode($this->text[$i]),1);
				if($this->checksum == true) {
					$checksum = 0;
					for($i=0;$i<strlen($this->text);$i++)
						$checksum += $this->findIndex($this->text[$i]);
					$this->DrawChar($im,$this->code[$checksum % 43],1);
				}
				$this->DrawChar($im,$this->code[$this->ending],1);
				$this->lastX = $this->positionX;
				$this->lastY = $this->maxHeight;
				$this->DrawText($im);
			}
		}
	}
};
?>