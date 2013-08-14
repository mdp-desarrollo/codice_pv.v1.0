<?php

class OpenXML_WordElementGridColumn extends OpenXML_WordElement {

	public function __construct(OpenXML_WordElementTableGrid $parent) {
		parent::__construct($parent->ownerDocument, 'gridCol');
	}

	public function SetWidth($width) {
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:width', $width);
	}

	public function GetWidth() {
		return $this->getAttributeNS(OpenXML_Document::OXML_WPML, 'w:width');
	}

}