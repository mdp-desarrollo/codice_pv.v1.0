<?php
class OpenXML_WordPropertyElementIndentation extends OpenXML_WordElementPropertyBase {

	const INDENT_LEFT = 1;
	const INDENT_RIGHT = 2;

	private $_Left = null;
	private $_Right = null;

	public function __construct(OpenXML_WordElementPropertiesBase $parent) {
		parent::__construct($parent->ownerDocument, 'ind');
	}

	public function SetIndentation($pos, $size) {
		$values = array(self::INDENT_LEFT, self::INDENT_RIGHT );
		$min = min($values);
		$max = max($values);
		for ($i = $min; $i <= $max; $i = $i << 1) {
			if (OpenXML_WordElement::IsPartOf($pos, $i)) {
				$indentation = $this->_GetIndentation($i);
				$indentation->value =  $size;
			}
		}
	}
	public function RemoveIndentation($pos) {
		$values = array(self::INDENT_LEFT, self::INDENT_RIGHT );
		$min = min($values);
		$max = max($values);
		for ($i = $min; $i <= $max; $i = $i << 1) {
			if (OpenXML_WordElement::IsPartOf($pos, $i)) {
				$indentation = $this->_GetIndentation($pos, true);
				if(!is_null($indentation)) {
					$this->removeChild($indentation);
					$obj = null;
				}
			}
		}
	}

	protected function _GetIndentation($pos, $returnNull = false) {
		$obj = null;
		$type = null;
		switch ($pos) {
			case self::INDENT_LEFT:
				$obj =& $this->_Left;
				$type = 'left';
			break;
			case self::INDENT_RIGHT:
				$obj =& $this->_Right;
				$type = 'right';
			break;
		}
		if(is_null($obj) && !$returnNull) {
			//$obj = $this->createAttributeNS(OpenXML_Document::OXML_WPML, "w:$type");
			$obj = new DOMAttr("w:$type");
			$this->setAttributeNodeNS($obj);
		}
		return $obj;
	}
}