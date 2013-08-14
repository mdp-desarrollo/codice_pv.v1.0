<?php

//Declare variables for file names.
$xmlDataFile = "MyMovies.xml";
$xsltFile = "MyMovies.xslt";
$sourceTemplate = "MyMoviesTemplate.docx";
$outputDocument = "MyMovies.docx";

//Load the xml data and xslt and perform the transformation.
$xmlDocument = new DOMDocument();
$xmlDocument->load($xmlDataFile);

$xsltDocument = new DOMDocument();
$xsltDocument->load($xsltFile);

$xsltProcessor = new XSLTProcessor();
$xsltProcessor->importStylesheet($xsltDocument);

//After the transformation, $newContentNew contains 
//the XML data in the Open XML Wordprocessing format.
$newContent =  $xsltProcessor->transformToXML($xmlDocument);

//Copy the Word 2007 template document to the output file.
if (copy($sourceTemplate, $outputDocument)) {

  //Open XML files are packaged following the Open Packaging 
  //Conventions and can be treated as zip files when 
  //accessing their content.
  $zipArchive = new ZipArchive();
  $zipArchive->open($outputDocument);
  
  //Replace the content with the new content created above.
  //In the Open XML Wordprocessing format content is stored
  //in the document.xml file located in the word directory.
  $zipArchive->addFromString("word/document.xml", $newContent);
  $zipArchive->close();
  
  echo "Processing Complete";
}
?> 
