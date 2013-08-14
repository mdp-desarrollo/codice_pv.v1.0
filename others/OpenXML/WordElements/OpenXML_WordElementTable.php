<?php

class OpenXML_WordElementTable extends OpenXML_WordElement {

	private $_TableGrid = null;
	private $_Rows = array();

	public function __construct(OpenXML_WordDocument $owner) {
		parent::__construct($owner, 'tbl');
		$this->_TableGrid = new OpenXML_WordElementTableGrid($this);
		$this->AppendElement($this->_TableGrid);
	}

	public function AddRow($id, OpenXML_WordElementTableRow $row) {
		$this->_Rows[$id] = $row;
		$this->AppendElement($row);
		$this->_CheckColumns();
		return $this;
	}

	protected function _CheckColumns() {
		while(($key = key($this->_Rows)!== null)) {
			$row = current($this->_Rows);
			$columns = $row->GetColumns();
			$i = 0;
			while( key($columns) !== null ) {
				$column = current($columns);
				$width = $column->GetProperties()->GetWidth();

				if($gridCol = $this->_TableGrid->GetGridColumn($i)) {
					/*@var $gridCol OpenXML_WordElementGridColumn*/
					if($gridCol->GetWidth() != $width) {
						$gridCol->SetWidth($width);
					}
				} else {
					$this->_TableGrid->AddGridColumn($width);
				}
				next($columns);
				$i++;
			}
			next($this->_Rows);
		}
	}
}