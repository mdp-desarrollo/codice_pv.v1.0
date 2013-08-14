<?php

class OpenXML_WordStyleElementDocDefault extends OpenXML_WordElement {

  protected $_RunDefaults = null;
  protected $_ParagraphDefaults = null;

  private $_RunContainer = null;
  private $_ParagraphContainer = null;

  public function __construct(OpenXML_WordStyleDocument $owner) {
    parent::__construct($owner, 'docDefaults');

    $this->_RunDefaults = new OpenXML_WordElementRunProperties($this);
    $this->_ParagraphDefaults = new OpenXML_WordElementParagraphProperties($this);

    $this->_RunContainer = new OpenXML_WordElement($owner, 'rPrDefault');
    $this->_ParagraphContainer = new OpenXML_WordElement($owner, 'pPrDefault');

    $this->_RunContainer->AppendElement($this->_RunDefaults);
    $this->_ParagraphContainer->AppendElement($this->_ParagraphDefaults);

    $this->AppendElement($this->_RunContainer);
    $this->AppendElement($this->_ParagraphContainer);
  }

  public function GetParagraphDefaults() {
    return $this->_ParagraphDefaults;
  }
  public function GetRunDefaults() {
    return $this->_RunDefaults;
  }

}