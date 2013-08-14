<?php

class OpenXML_WordElementRunProperties extends OpenXML_WordElementPropertiesBase {

	public function __construct(OpenXML_WordElement $parent) {
		parent::__construct($parent->ownerDocument, 'r');
	}

}