<?php

abstract class OpenXML_WordElementTablePropertiesBase extends OpenXML_WordElementPropertiesBase {

	const PROP_WIDTH = 'width';
	const PROP_BORDER = 'border';

	public function SetWidth($width, $type = 'auto') {
		if(!$this->_PropertyExists(self::PROP_WIDTH)) {
			$this->_SetComplexProperty(self::PROP_WIDTH, new OpenXML_WordPropertyElementWidth($this, $width, $type));
		}
		$this->_SetComplexProperty(self::PROP_WIDTH, 'SetWidth', $width, $type);
		return $this;
	}

	public function GetWidth() {
		/*@var $prop OpenXML_WordPropertyElementWidth	*/
		$prop = $this->_GetProperty(self::PROP_WIDTH);
		return ($prop) ? $prop->GetWidth() : null;
	}

	public function SetBorder($pos, $type, $size, $color = 'auto', $space = 0) {
		if(!$this->_PropertyExists(self::PROP_BORDER )) {
			$this->_SetComplexProperty(self::PROP_BORDER, new OpenXML_WordPropertyElementBorders($this));
		}
		$this->_SetComplexProperty('border', 'SetBorder', $pos, $type, $size, $color, $space);
		return $this;
	}

}