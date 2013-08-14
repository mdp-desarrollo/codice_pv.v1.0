<?php
class	OpenXML_WordElementText extends OpenXML_WordElement {

	public function __construct(OpenXML_WordDocument $owner, $value = null) {
		parent::__construct($owner, 't');

		if(preg_match('@^\s+.*$|^.*\s+$@', $value)) {
			$this->setAttribute('xml:space', 'preserve');
		}
		$CDATA = new DOMCdataSection($value);
		$owner->adoptNode($CDATA);
		$this->appendChild($CDATA);
	}

}