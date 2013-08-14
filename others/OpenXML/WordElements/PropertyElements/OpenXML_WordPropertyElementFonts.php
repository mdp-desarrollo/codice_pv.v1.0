<?php

class OpenXML_WordPropertyElementFonts extends OpenXML_WordElementPropertyBase {

	private $_Fonts = array();

	public function __construct(OpenXML_WordElementPropertiesBase $parent) {
		parent::__construct($parent->ownerDocument, $parent->GetPropertiesType().'Fonts');
	}

	public function SetFont($codeBase, $font) {
		$this->_SetFont($codeBase, $font);
	}

	protected function _SetFont($id, $value) {
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, "w:$id", $value);
	}

}