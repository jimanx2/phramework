<?php namespace Phramework\Controllers;

class Application {

  var $context;
  var $controller;
  var $action;
  
  public function __construct($context = NULL){
    $this->context = $context;
  }
  
  protected function render($opts){
    $template = isset($options['template']) ? $options['template'] : $context->request->params['action'];
    $status   = isset($options['status']) ? $options['status'] : 200;
    
    $context->response->render(
      $opts, 
      $context->request->params['controller'], 
      $context->request->params['action']
    );
  }
}