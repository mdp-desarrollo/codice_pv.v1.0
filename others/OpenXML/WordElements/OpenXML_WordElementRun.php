<?php
class OpenXML_WordElementRun extends OpenXML_WordElement {

	public function __construct(OpenXML_WordDocument $owner) {
		parent::__construct($owner, 'r');
	}

	public function AppendText($text) {
		return $this->appendChild(new OpenXML_WordElementText($this->ownerDocument, $text));
	}

	public function AppendCR() {
		return $this->AppendElement(new OpenXML_WordElement($this->ownerDocument, 'cr'));
	}
	public function AppendBR($page = false) {
		$br = new OpenXML_WordElement($this->ownerDocument, 'br');
		if($page) {
			$br->setAttributeNS(OpenXML_Document::OXML_WPML, 'w:type', 'page');
		}
		return $this->AppendElement($br);
	}
}