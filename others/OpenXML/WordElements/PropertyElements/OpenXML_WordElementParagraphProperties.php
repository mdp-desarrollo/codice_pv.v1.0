<?php
class OpenXML_WordElementParagraphProperties extends OpenXML_WordElementPropertiesBase {

	const PROP_BORDER = 'border';
	const PROP_INDENTATION = 'indent';

	public function __construct(OpenXML_WordElement $parent) {
		parent::__construct($parent->ownerDocument, 'p');
	}

	public function SetBorder($pos, $type, $color = 'auto') {
		if(!$this->_PropertyExists(self::PROP_BORDER )) {
			$this->_SetComplexProperty(self::PROP_BORDER, new OpenXML_WordPropertyElementBorder($this));
		}
		$this->_SetComplexProperty(self::PROP_BORDER, 'SetBorder', $pos, $type, $color);
		return $this;
	}

	public function SetIndentation($pos, $size) {
		if(!$this->_PropertyExists(self::PROP_INDENTATION)) {
			$this->_SetComplexProperty(self::PROP_INDENTATION, new OpenXML_WordPropertyElementIndentation($this));
		}
		$this->_SetComplexProperty(self::PROP_INDENTATION, 'SetIndentation', $pos, $size);
		return $this;
	}

}