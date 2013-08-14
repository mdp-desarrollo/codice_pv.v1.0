<?php
class OpenXML_WordPropertyElementJustification extends OpenXML_WordElementSimplePropertyBase {

	const JUSTIFY_LEFT = 'left';
	const JUSTIFY_RIGHT = 'right';
	const JUSTIFY_CENTER = 'center';
	const JUSTIFY_BLOCK = 'both';

	public function __construct(OpenXML_WordElementPropertiesBase $parent, $justify = self::JUSTIFY_LEFT) {
		parent::__construct($parent, 'jc', $justify);
	}

	protected function _SetValue($justify) {
		$this->_SetDefaultAttribute($justify);
	}

}