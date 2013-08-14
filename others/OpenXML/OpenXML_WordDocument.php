<?php
include_once 'Archive/Zip.php';

/**
 * Class to represent a WordproceessingML document
 * @uses PEAR Package Archive_ZIP
 *
 */
class OpenXML_WordDocument extends OpenXML_Document {

  /**
	 * Protected field holding the body element of the document
	 *
	 * @var OpenXML_WordElementBody
	 */
  protected $_Body = null;

  protected $_Styles = null;

  protected $_DocumentRelationships = null;

  public function __construct() {
    parent::__construct(parent::OXML_WPML, 'word/document.xml');
    $this->registerNodeClass('DOMElement', 'OpenXML_WordElement');
    $this->_Body = new OpenXML_WordElementBody($this);
    $this->_DocumentRoot->appendChild($this->_Body);
  }

  public function AddStyleDocument() {
    if(is_null($this->_Styles)) {
    $this->_Styles = new OpenXML_WordStyleDocument($this);
    $this->_DocumentRelationships = new OpenXML_Relationship();
    $this->_DocumentRelationships->CreateRelationship(OpenXML_Relationship::RT_WPML_STYLES, 'styles.xml');
    }
    return $this->_Styles;
  }

  public function GetStyleDocument() {
    return $this->_Styles;
  }

  /**
	 * SaveDocument implementation of OpenXML_Document
	 * This method saves the WordprocessingML document as a .docx archive file.
	 * Params:
	 * 	- $name: Filename
	 *  - $path: Path to where the document shall be saved
	 *
	 * @param string $name
	 * @param string $path
	 */
  public function SaveDocument($name, $path = '') {
    if(!is_dir('word')) {
      mkdir('word');
    }
    if(!is_dir('_rels')) {
      mkdir('_rels');
    }

    if(!is_null($this->_Styles)) {
      $this->_Styles->SaveDocument('document.xml', 'word');
      if(!is_dir('word/_rels')) {
        mkdir('word/_rels');
      }
      $DocRel = $this->_DocumentRelationships->saveXML();
    }

    $ContentTypes = $this->_ContentTypes->saveXML();
    $Document = $this->saveXML();
    $Rel = $this->_Relationships->saveXML();

    file_put_contents('word/document.xml', $Document);
    file_put_contents('[Content_Types].xml', $ContentTypes);

    file_put_contents('_rels/.rels', $Rel);

    if($path && $path[strlen($path)-1] != DIRECTORY_SEPARATOR) {
      $path.=DIRECTORY_SEPARATOR;
    }

    $obj = new Archive_Zip("$path$name.docx");
    $files = array('word/document.xml','[Content_Types].xml','_rels/.rels');
    if($this->_Styles) {
      $this->_Styles->SaveDocument('', 'word/');
      file_put_contents('word/_rels/document.xml.rels', $DocRel);
      $files[] = 'word/styles.xml';
      $files[] = 'word/_rels/document.xml.rels';
    }
    $obj->create($files);

    if($this->_Styles) {
      unlink('word/styles.xml');
      unlink('word/_rels/document.xml.rels');
      rmdir('word/_rels');
    }
    unlink('word/document.xml');
    unlink('[Content_Types].xml');
    unlink('_rels/.rels');
    rmdir('_rels');
    rmdir('word');
  }
  /**
	 * Private method to add content types in the ContentTypes document
	 *
	 */
  protected function _SetContentTypes() {
    $document = $this->_ContentTypes->CreateOverrideTypeElement();
    $document->setAttribute('PartName', '/word/document.xml');
    $document->setAttribute('ContentType', OpenXML_ContentType::CT_WPML_DOCUMENT_MAIN);
    $this->_ContentTypes->AddContentTypeElement($document);
  }
  /**
	 * Short-cut function to create an OpenXML_WordElement
	 * Params:
	 * 	- $name: Name of the element
	 *  - $value: Value of the element
	 *
	 * @param string $name
	 * @param string $value
	 * @return OpenXML_WordElement
	 */
  public function CreateWordElement($name, $value = null) {
    return new OpenXML_WordElement($this, $name, $value);
  }

  /**
	 * Returns the Body element of the document
	 *
	 * @return OpenXML_WordElementBody
	 */
  public function GetBody() {
    return $this->_Body;
  }

}
