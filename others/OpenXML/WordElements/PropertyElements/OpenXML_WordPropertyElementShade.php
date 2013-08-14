<?php

class OpenXML_WordPropertyElementShade extends OpenXML_WordElementPropertyBase {

	public function __construct(OpenXML_WordElementTableCellProperties $parent) {
		parent::__construct($parent->ownerDocument, 'shd');
	}

	public function SetShade($value, $fill, $color = 'auto') {
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:val', $value);
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:color', $color);
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:fill', $fill);
	}

}