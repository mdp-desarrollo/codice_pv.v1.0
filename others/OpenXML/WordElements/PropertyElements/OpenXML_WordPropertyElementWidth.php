<?php

class OpenXML_WordPropertyElementWidth extends OpenXML_WordElementPropertyBase {

	public function __construct(OpenXML_WordElementPropertiesBase $parent, $width=0, $type = 'auto') {
		parent::__construct($parent->ownerDocument, $parent->GetPropertiesType()."W");
		$this->SetWidth($width, $type);
	}

	public function SetWidth($width, $type = 'auto') {
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, "w:w", $width);
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, "w:type", $type);
	}

	public function GetWidth() {
		return $this->getAttributeNS(OpenXML_Document::OXML_WPML, 'w:w');
	}

}