<?php
/**
 * Class to represent a ContentTypes OpenXML_Document
 *
 */
class OpenXML_ContentType extends DOMDocument {

	/**
	 * Namespace URI to the ContentTypes schema
	 *
	 */
	const NS_URI = 'http://schemas.openxmlformats.org/package/2006/content-types';
	/**
	 * Mime-type for relationships
	 *
	 */
	const CT_RELS = 'application/vnd.openxmlformats-package.relationships+xml';
	/**
	 * XML mime-type
	 *
	 */
	const CT_XML = 'application/xml';
	/**
	 * Mime-type for the WordprocessingML (OpenXML_WordDocument) document
	 *
	 */
	const CT_WPML_DOCUMENT_MAIN = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document.main+xml';

	const CT_WPML_STYLES = 'application/vnd.openxmlformats-officedocument.wordprocessingml.styles+xml';

	/**
	 * Holds the root document of the ContentTypes document
	 *
	 * @var DOMElement
	 */
	protected $_DocumentRoot = null;

	public function __construct() {
		parent::__construct('1.0', 'UTF-8');
		$this->_DocumentRoot = $this->createElementNS(self::NS_URI , 'Types');
		$this->appendChild($this->_DocumentRoot);
	}

	/**
	 * Method to add a new ContentType Element
	 *
	 * @param DOMElement $element
	 */
	public function AddContentTypeElement(DOMElement $element) {
		$this->_DocumentRoot->appendChild($element);
	}

	/**
	 * Shortcut-method to create a <Default> element
	 *
	 * @return DOMElement
	 */
	public function CreateDefaultTypeElement() {
		return $this->createElement('Default');
	}

	/**
	 * Shortcut-method to create a <Override> element
	 *
	 * @return DOMElement
	 */
	public function CreateOverrideTypeElement() {
		return $this->createElement('Override');
	}



}