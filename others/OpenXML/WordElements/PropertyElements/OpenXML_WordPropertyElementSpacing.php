<?php

class OpenXML_WordPropertyElementSpacing extends OpenXML_WordElementSimplePropertyBase {
  public function __construct(OpenXML_WordElementPropertiesBase $parent, $spacing) {
		parent::__construct($parent, 'spacing', $spacing, 'after');
	}

	public function SetSpacing($spacing) {
		$this->_SetDefaultAttribute($spacing, 'after');
	}

	protected function _SetValue($value) {
		$this->SetSpacing($value);
	}
}