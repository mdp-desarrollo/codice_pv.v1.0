<?php

class OpenXML_WordElementTableRow extends OpenXML_WordElement {

	private $_Columns = array();

	public function __construct(OpenXML_WordElementTable $parent) {
		parent::__construct($parent->ownerDocument, 'tr');
	}

	public function AddColumn($id, OpenXML_WordElementTableCell $column) {
		$this->_Columns[$id] = $column;
		$this->AppendElement($column);
		return $this;
	}

	public function &GetColumns() {
		return $this->_Columns;
	}

}