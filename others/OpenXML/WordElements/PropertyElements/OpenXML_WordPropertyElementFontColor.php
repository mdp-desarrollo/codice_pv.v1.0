<?php

class OpenXML_WordPropertyElementFontColor extends OpenXML_WordElementSimplePropertyBase {

	public function __construct(OpenXML_WordElementPropertiesBase $parent, $color) {
		parent::__construct($parent, 'color');
	}

	public function SetColor($color) {
		$this->_SetDefaultAttribute($color);
	}

	protected function _SetValue($value) {
		$this->SetColor($value);
	}

}