<?php

class OpenXML_WordStyleDocument extends OpenXML_Document {

	protected $_OwnerDocument = null;

	protected $_DocDefaults = null;

	public function __construct(OpenXML_WordDocument $owner) {
		parent::__construct(parent::OXML_WPML, null, 'styles', false);
		$this->_OwnerDocument = $owner;
		$this->_DocDefaults = new OpenXML_WordStyleElementDocDefault($this);
		$this->_DocumentRoot->appendChild($this->_DocDefaults);
	}

	public function GetDefaults() {
    return $this->_DocDefaults;
	}

	protected function _SetContentTypes() {
		/* nothing to do here	*/
	}

  public function SaveDocument($name, $path = '') {
		if($path && $path[strlen($path)-1] != DIRECTORY_SEPARATOR) {
			$path.=DIRECTORY_SEPARATOR;
		}

		$override = $this->_OwnerDocument->_ContentTypes->CreateOverrideTypeElement();
		$override->setAttribute('PartName', '/'.str_replace(DIRECTORY_SEPARATOR, '/',$path).'styles.xml');
		$override->setAttribute('ContentType', OpenXML_ContentType::CT_WPML_STYLES);
		$this->_OwnerDocument->_ContentTypes->AddContentTypeElement($override);

		$content = $this->saveXML();

		file_put_contents($path.'styles.xml', $content);
	}

}