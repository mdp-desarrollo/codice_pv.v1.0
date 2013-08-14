<?php
/**
 * Class to represent a .rel document
 *
 */
class OpenXML_Relationship extends DOMDocument {

	/**
	 * Namespace URI for the Relationships schema
	 *
	 */
	const NS_URI = 'http://schemas.openxmlformats.org/package/2006/relationships';
	/**
	 * Namespace URI to the office documents schems
	 *
	 */
	const RT_OFFICE_DOCUMENT = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument';

	const RT_WPML_STYLES = 'http://schemas.openxmlformats.org/wordprocessingml/2006/styles';

	/**
	 * Protected field holding the root element
	 *
	 * @var DOMElement
	 */
	protected $_DocumentRoot = null;
	/**
	 * Private array holding all Relationships added to this document
	 *
	 * @var array
	 */
	private $_Relationships = array();

	public function __construct() {
		parent::__construct('1.0', 'UTF-8');
		$this->_DocumentRoot = $this->createElementNS(self::NS_URI , 'Relationships');
		$this->appendChild($this->_DocumentRoot);
	}

	/**
	 * Public method to create new Relationships
	 * Params:
	 * 	- $type: Namespace URI to the type of relationship
	 *  - $target: Target of the relationship (e.g. document.xml)
	 *
	 * @param string $type
	 * @param string $target
	 */
	public function CreateRelationship($type = self::RT_OFFICE_DOCUMENT, $target = 'document.xml') {
		$el = $this->createElement('Relationship');
		$this->_Relationships[] = $el;
		$el->setAttribute('Id', "rId".count($this->_Relationships));
		$el->setIdAttribute('Id', true);
		$el->setAttribute('Type', $type);
		$el->setAttribute('Target', $target);
		$this->_DocumentRoot->appendChild($el);
	}

	public static function TranslateTypeToRelationship($type) {
		switch ($type) {
			case OpenXML_Document::OXML_WPML:
				return self::RT_OFFICE_DOCUMENT;
				break;
			default:
				return null;
				break;
		}
	}
}