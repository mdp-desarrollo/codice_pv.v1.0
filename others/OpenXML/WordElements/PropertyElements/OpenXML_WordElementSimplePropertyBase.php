<?php

abstract class OpenXML_WordElementSimplePropertyBase extends OpenXML_WordElementPropertyBase {
	protected abstract function _SetValue($value);

	protected function _SetDefaultAttribute($value, $attName = 'val') {
		$this->setAttributeNS(OpenXML_Document::OXML_WPML, "w:$attName", $value);
	}

	public function __construct(OpenXML_WordElementPropertiesBase $parent, $name, $value, $attr = 'val') {
		parent::__construct($parent->ownerDocument, $name);
		$this->_SetDefaultAttribute($value, $attr);
	}
}