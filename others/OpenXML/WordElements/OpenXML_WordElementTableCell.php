<?php

class OpenXML_WordElementTableCell extends OpenXML_WordElementBody {

	public function __construct(OpenXML_WordElementTableRow $parent, $width = '0', $type = 'auto') {
		parent::__construct($parent->ownerDocument, 'tc');
		$this->GetProperties()->SetWidth($width, $type);
	}

}