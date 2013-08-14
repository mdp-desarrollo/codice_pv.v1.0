<?php

class OpenXML_WordPropertyElementBorders extends OpenXML_WordElementPropertyBase {

	private $_Bottom = null;
	private $_Top = null;
	private $_Right = null;
	private $_Left = null;
	private $_Horizontal = null;
	private $_Vertial = null;
	private $_Tl2br = null;
	private $_Tr2bl = null;

	const BORDER_TOP = 1;
	const BORDER_RIGHT = 2;
	const BORDER_BOTTOM = 4;
	const BORDER_LEFT = 8;
	const BORDER_HORIZONTAL = 16;
	const BORDER_VERTICAL = 32;
	const BORDER_TL2BR = 64;
	const BORDER_TR2BL = 128;

	const BORDER_OUTSIDE = 15;
	const BORDER_INSIDE = 48;

	const BORDER_STYLE_SINGLE = 'single';
	const BORDER_STYLE_NIL = 'nil';

	public function __construct(OpenXML_WordElementPropertiesBase $parent) {
		parent::__construct($parent->ownerDocument, $parent->GetPropertiesType().'Borders');
	}

	public function SetBorder($pos, $type, $size, $color = 'auto', $space = 0) {
		$values = array(
			self::BORDER_BOTTOM
			, self::BORDER_LEFT
			, self::BORDER_RIGHT
			, self::BORDER_TOP
			, self::BORDER_HORIZONTAL
			, self::BORDER_TL2BR
			, self::BORDER_TR2BL
			, self::BORDER_VERTICAL
		);
		$min = min($values);
		$max = max($values);
		for ($i = $min; $i <= $max; $i = $i << 1) {
			if (OpenXML_WordElement::IsPartOf($pos, $i)) {
				$border = $this->_GetBorder($i);
				$border->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:val', $type);
				$border->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:sz', $size);
				$border->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:color', $color);
				$border->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:space', $space);
			}
		}
	}

	public function RemoveBorder($pos) {
		$values = array(
			self::BORDER_BOTTOM
			, self::BORDER_LEFT
			, self::BORDER_RIGHT
			, self::BORDER_TOP
			, self::BORDER_HORIZONTAL
			, self::BORDER_TL2BR
			, self::BORDER_TR2BL
			, self::BORDER_VERTICAL
		);
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
			case self::BORDER_HORIZONTAL:
				$obj =& $this->_Horizontal;
				$type = 'insideH';
				break;
			case self::BORDER_TL2BR:
				$obj =& $this->_Tl2br;
				$type = 'tl2br';
				break;
			case self::BORDER_TR2BL:
				$obj =& $this->_Tr2bl;
				$type = 'tr2bl';
				break;
			case self::BORDER_VERTICAL:
				$obj =& $this->_Vertial;
				$type = 'insideV';
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