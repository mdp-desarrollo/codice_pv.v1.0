<?php
class OpenXML_WordElementBody extends OpenXML_WordElement {
	protected $_Paragraphs = array();

	public function __construct($owner, $name = 'body') {
		parent::__construct($owner, $name);
	}
	public function AppendParagraph($id) {
		$this->_Paragraphs[$id] = $this->appendChild(new OpenXML_WordElementParagraph($this->ownerDocument));
		return $this->_Paragraphs[$id];
	}
	public function GetParagraph($id) {
		return $this->_Paragraphs[$id];
	}
}