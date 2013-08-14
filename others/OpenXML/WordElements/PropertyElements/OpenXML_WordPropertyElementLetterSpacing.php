<?php

class OpenXML_WordPropertyElementLetterSpacing extends OpenXML_WordElementSimplePropertyBase {

	public function __construct(OpenXML_WordElementPropertiesBase $parent, $spacing) {
		parent::__construct($parent, 'spacing', $spacing);
	}

	public function SetSpacing($spacing) {
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:val', $spacing);
	}

	protected function _SetValue($value) {
		$this->SetSpacing($value);
	}

}