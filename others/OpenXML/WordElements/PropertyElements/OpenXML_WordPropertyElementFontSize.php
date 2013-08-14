<?php

class OpenXML_WordPropertyElementFontSize extends OpenXML_WordElementSimplePropertyBase {

	public function __construct(OpenXML_WordElementPropertiesBase $parent, $size) {
		parent::__construct($parent, 'sz', $size);
	}

	public function SetSize($size) {
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:val', $size);
	}

	protected function _SetValue($value) {
		$this->SetSize($value);
	}
}