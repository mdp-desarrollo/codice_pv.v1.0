<?php

class OpenXML_WordElementTableProperties extends OpenXML_WordElementTablePropertiesBase {

	function __construct(OpenXML_WordElementTable $parent) {
		parent::__construct($parent->ownerDocument, 'tbl');
	}

}