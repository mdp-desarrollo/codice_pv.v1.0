<?php

class OpenXML_WordElementTableGrid extends OpenXML_WordElement {

	private $_Grid = array();

	public function __construct(OpenXML_WordElementTable $parent) {
		parent::__construct($parent->ownerDocument, 'tblGrid');
	}

	public function AddGridColumn($width) {
		$GridColumn = new OpenXML_WordElementGridColumn($this);
		$GridColumn->SetWidth($width);
		$this->AppendElement($GridColumn);
		$this->_Grid[] = $GridColumn;
	}

	public function GetGridColumn($index) {
		return (key_exists($index, $this->_Grid)) ? $this->_Grid[$index] : null;
	}

}