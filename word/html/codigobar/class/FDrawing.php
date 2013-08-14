<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');
class FDrawing {
	private $w, $h;		
	private $color;		
	private $filename;	
	private $im;		
	private $barcode = array();

	public function __construct($w,$h,$filename,Fcolor $color) {
		$this->w = $w;
		$this->h = $h;
		$this->filename = $filename;
		$this->color = $color;
	}

	public function __destruct() {
		$this->destroy();
	}

	public function init(){
		$this->im = imagecreate($this->w, $this->h)
		or die('Can\'t Initialize the GD Libraty');
		imagecolorallocate($this->im,$this->color->r(),$this->color->g(),$this->color->b());
	}

	public function get_im() {
		return $this->im;
	}
	public function set_im($im) {
		$this->im = $im;
	}

	public function add_barcode(BarCode $barcode) {
		$this->barcode[] = $barcode;
	}

	public function draw_all() {
		for($i=0;$i<count($this->barcode);$i++)
			$this->barcode[$i]->draw($this->im);
	}

	public function finish($image_style=IMG_FORMAT_PNG,$quality=100) {
		if($image_style==constant('IMG_FORMAT_PNG')){
			if(empty($this->filename))
				imagepng($this->im);
			else
				imagepng($this->im,$this->filename);
		}
		elseif($image_style==constant('IMG_FORMAT_JPEG'))
			imagejpeg($this->im,$this->filename,$quality);
	}

	public function destroy() {
		imagedestroy($this->im);
	}
};
?>