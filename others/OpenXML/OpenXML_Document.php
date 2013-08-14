<?php
/**
 * Abstract class to derive other OpenXML documents (e.g. OpenXML_WordDocument)
 *
 */
abstract class OpenXML_Document extends DOMDocument {

	const OXML_WPML = 'http://schemas.openxmlformats.org/wordprocessingml/2006/main';

	/**
	 * Private field holding the root node of the document.
	 * In case of WordprocessingML it is the <w:document> node
	 *
	 * @var DOMElement
	 */
	protected $_DocumentRoot = null;
	/**
	 * Private field holding the ContentTypes document
	 *
	 * @var OpenXML_ContentType
	 */
	protected $_ContentTypes = null;
	/**
	 * Private field holding the Relationships document
	 *
	 * @var OpenXML_Relatioship
	 */
	protected $_Relationships = null;

	protected $_DocumentRelationships = null;

	/**
	 * Constructor of the OpenXML_Document.
	 * Params:
	 *  - $type: Gives information on the schema this document will run on. e.g. WordprocessingML schema
	 *
	 * @param string $type
	 */
	public function __construct($type, $target, $rootElement = 'document', $isMain = true) {
		parent::__construct('1.0', 'UTF-8');
		$this->xmlStandalone = true;
		$this->_DocumentRoot = $this->CreateOpenXMLElement($rootElement, $type);
		$this->appendChild($this->_DocumentRoot);
		if($isMain) {
			$this->_ContentTypes = new OpenXML_ContentType();
			$this->_Relationships = new OpenXML_Relationship();
			$this->_Relationships->CreateRelationship(OpenXML_Relationship::TranslateTypeToRelationship($type), $target);
			$this->_DocumentRelationships = new OpenXML_Relationship();
			$this->_SetDetaultContentTypes();
		}
	}

	protected function _SetDetaultContentTypes() {
		$rels = $this->_ContentTypes->CreateDefaultTypeElement();
		$rels->setAttribute('Extension', 'rels');
		$rels->setAttribute('ContentType', OpenXML_ContentType::CT_RELS);
		$this->_ContentTypes->AddContentTypeElement($rels);

		$xml = $this->_ContentTypes->CreateDefaultTypeElement();
		$xml->setAttribute('Extension', 'xml');
		$xml->setAttribute('ContentType', OpenXML_ContentType::CT_XML);
		$this->_ContentTypes->AddContentTypeElement($xml);

		$this->_SetContentTypes();
	}

	protected abstract function _SetContentTypes();

	/**
	 * Function to easily create a DOMElement in form of an OpenXML_Element.
	 * Params:
	 *  - $name: Name of the element
	 *  - $type: Gives information on the schema this document will run on. e.g. WordprocessingML schema
	 *  - $value: Content of the element
	 *
	 * @param string $name
	 * @param string $type
	 * @param string $value
	 * @return DOMElement
	 */
	public function CreateOpenXMLElement($name, $type, $value = null) {
		$prefix = '';
		switch ($type) {
			case self::OXML_WPML:
				$prefix ='w:';
				break;
		}
		return $this->createElementNS($type, $prefix.$name, $value);
	}

	/**
	 * Abstract function to save the document in a specific way.
	 * Params:
	 *  - $name: Document's (file)name
	 *  - $path: Path where the document shall be saved
	 *
	 * @param string $name
	 * @param string $path
	 */
	public abstract function SaveDocument($name, $path = '');

	/**
	 * Overidden from parent DOMDocument to associate DOMNodes with the document.
	 * Params:
	 *  - $node: DOMNode to be associated to the OpenXML_Document
	 *
	 * @param DOMNode $node
	 */
	public function adoptNode(DOMNode $node) {
		$this->appendChild($node);
		$this->removeChild($node);
	}

}