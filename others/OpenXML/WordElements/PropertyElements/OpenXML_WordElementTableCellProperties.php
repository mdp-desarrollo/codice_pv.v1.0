<?php

class OpenXML_WordElementTableCellProperties extends OpenXML_WordElementTablePropertiesBase {

	const PROP_SHADING = 'shading';

	public function __construct(OpenXML_WordElementTableCell $parent) {
		parent::__construct($parent->ownerDocument, 'tc');
	}

	public function SetShade($value, $fill, $color = 'auto') {
		if(!$this->_PropertyExists(self::PROP_SHADING)) {
			$this->_SetComplexProperty(self::PROP_SHADING, new OpenXML_WordPropertyElementShade($this));
		}
		$this->_SetComplexProperty(self::PROP_SHADING, 'SetShade', $value, $fill, $color);
		return $this;
	}

}