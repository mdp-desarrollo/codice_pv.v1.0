<?php

class OpenXML_WordElementParagraph extends OpenXML_WordElement {
	public function __construct(OpenXML_WordDocument $owner) {
		parent::__construct($owner, 'p');
	}

	private $_Runs = array();

	public function AppendRun($id) {
		$this->_Runs[$id] = $this->appendChild(new OpenXML_WordElementRun($this->ownerDocument));
		return $this->_Runs[$id];
	}

	public function GetRun($id) {
		return $this->_Runs[$id];
	}
}