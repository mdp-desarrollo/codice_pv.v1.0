<?php

class OpenXML_WordPropertyElementBorder extends OpenXML_WordElementPropertyBase {

	private $_Bottom = null;
	private $_Top = null;
	private $_Right = null;
	private $_Left = null;

	const BORDER_TOP = 1;
	const BORDER_RIGHT = 2;
	const BORDER_BOTTOM = 4;
	const BORDER_LEFT = 8;

	const BORDER_STYLE_SINGLE = 'single';

	public function __construct(OpenXML_WordElementPropertiesBase $parent) {
		parent::__construct($parent->ownerDocument, $parent->GetPropertiesType().'Bdr');
	}

	public function SetBorder($pos, $type, $size, $color = 'auto') {
		$values = array(self::BORDER_BOTTOM , self::BORDER_LEFT , self::BORDER_RIGHT , self::BORDER_TOP);
		$min = min($values);
		$max = max($values);
		for ($i = $min; $i <= $max; $i = $i << 1) {
			if (OpenXML_WordElement::IsPartOf($pos, $i)) {
				$border = $this->_GetBorder($i);
				$border->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:val', $type);
				$border->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:sz', $size);
				$border->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:color', $color);
			}
		}
	}

	public function RemoveBorder($pos) {
		$values = array(self::BORDER_BOTTOM , self::BORDER_LEFT , self::BORDER_RIGHT , self::BORDER_TOP);
		$min = min($values);
		$max = max($values);
		for ($i = $min; $i <= $max; $i = $i << 1) {
			$border = $this->_GetBorder($i, true);
			if(!is_null($border)) {
				$this->removeChild($border);
				$obj = null;
			}
		}
	}

	private function _GetBorder($pos, $returnNull = false) {
		$obj = null;
		$type = null;
		switch ($pos) {
			case self::BORDER_TOP:
				$obj =& $this->_Top;
				$type = 'top';
				break;
			case self::BORDER_RIGHT:
				$obj =& $this->_Right;
				$type = 'right';
				break;
			case self::BORDER_BOTTOM:
				$obj =& $this->_Bottom;
				$type = 'bottom';
				break;
			case self::BORDER_LEFT:
				$obj =& $this->_Left;
				$type = 'left';
				break;
			default:
				return null;
				break;
		}
		if(is_null($obj) && !$returnNull) {
			$obj = new OpenXML_WordElement($this->ownerDocument, $type);
			$this->AppendElement($obj);
		}
		return $obj;
	}

}