<?php
abstract class OpenXML_WordElementPropertiesBase extends OpenXML_WordElement {

	const PROP_FONTS = 'fonts';
	const PROP_FONT_SIZE = 'font-size';
	const PROP_JUSTIFICATION = 'justification';
	const PROP_SPACING = 'spacing';
	const PROP_LETTER_SPACING = 'letter-spacing';

	private $_PropertiesType = '';
	private $_Properties = array();

	public function __construct($owner, $name) {
		parent::__construct($owner, $name.'Pr');
		$this->_PropertiesType = $name;
	}

	public function GetPropertiesType() {
		return $this->_PropertiesType;
	}

	public function GetProperty($id) {
		$this->_GetProperty($id);
	}
	public function SetFont($codeBase, $font) {
		if(!$this->_PropertyExists(self::PROP_FONTS)) {
			$this->_SetComplexProperty(self::PROP_FONTS, new OpenXML_WordPropertyElementFonts($this));
		}
		$this->_SetComplexProperty(self::PROP_FONTS, 'SetFont', $codeBase, $font);
		return $this;
	}
	public function SetFontSize($size) {
		$this->_SetSimpleProperty(self::PROP_FONT_SIZE, 'OpenXML_WordPropertyElementFontSize', $size);
		return $this;
	}
	public function SetJustification($justification = OpenXML_WordPropertyElementJustification::JUSTIFY_LEFT) {
		$this->_SetSimpleProperty(self::PROP_JUSTIFICATION, 'OpenXML_WordPropertyElementJustification', $justification);
		return $this;
	}
  public function SetLetterSpacing($spacing) {
    $this->_SetSimpleProperty(self::PROP_LETTER_SPACING, 'OpenXML_WordPropetyElementLetterSpacing', $spacing);
    return $this;
  }
  public function SetSpacing($spacing) {
    $this->_SetSimpleProperty(self::PROP_SPACING, 'OpenXML_WordPropertyElementSpacing', $spacing);
    return $this;
  }

	protected function _SetComplexProperty($id) {
		$arguments = func_get_args();
		if(!$this->_PropertyExists($id) && $arguments[1] instanceof OpenXML_WordElementPropertyBase) {
			$this->_AddProperty($id, $arguments[1]);

		} else {
			$ReflectionMethod = new ReflectionMethod($this->_Properties[$id], $arguments[1]);
			array_shift($arguments);
			array_shift($arguments);
			$ReflectionMethod->invokeArgs($this->_Properties[$id], $arguments);
		}
	}
	protected function _SetSimpleProperty($id, $type, $value) {
		$prop = null;
		if(!$this->_PropertyExists($id)) {
			$obj = new ReflectionClass($type);
			$prop = $obj->newInstance($this, $value);
			$this->_AddProperty($id, $prop);
		} else {
			$this->_GetProperty($id)->_SetValue($value);
		}
	}
	protected function _PropertyExists($id) {
		return key_exists($id, $this->_Properties);
	}
	protected function _RemoveProperty($id) {
		if(key_exists($id, $this->_Properties)) {
			$this->removeChild($this->_Properties[$id]);
		}
	}
	protected function _GetProperty($id) {
		if($this->_PropertyExists($id)) {
			return $this->_Properties[$id];
		}
	}

	private function _AddProperty($id, OpenXML_WordElementPropertyBase $property) {
		$this->_Properties[$id] = $property;
		$this->AppendElement($property);
	}
}