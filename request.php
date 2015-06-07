<?php namespace Phramework;

class Request {
 
  var $params;
  public function __construct($context = NULL){
    $this->params = array_merge($_GET, $_POST);
    $context->request = $this;
  }
}