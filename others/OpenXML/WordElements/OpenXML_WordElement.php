<?php
class OpenXML_WordElement extends DOMElement {

	private $_Properties = null;

	public function __construct(OpenXML_Document $owner, $name, $value = null) {
		parent::__construct($name, $value, OpenXML_Document::OXML_WPML);
		$owner->adoptNode($this);
	}

	public function GetProperties() {
		if(is_null($this->_Properties)) {
			$this->_Properties = OpenXML_WordPropertiesFactory::CreateProperties($this);
			$this->PrependElement($this->_Properties);
		}
		return $this->_Properties;
	}

	/* Helpers */
	public function AppendElement(DOMElement $element) {
		$this->appendChild($element);
		$c = func_num_args();
		if($c > 1) {
			$args = func_get_args();
			for($i = 1; $i < $c; $i++) {
				if($args[$i] instanceof DOMElement) {
					$this->appendChild($args[$i]);
				}
			}
		}
	}
	public function PrependElement(DOMElement $element) {
		if($this->hasChildNodes()) {
			$this->insertBefore($element, $this->firstChild);
		} else {
			$this->appendChild($element);
		}
	}

	public static function IsPartOf($haystack, $needle) {
		return (($needle & $haystack) == $needle);
	}

}