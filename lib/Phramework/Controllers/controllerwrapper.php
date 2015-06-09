<?php namespace Phramework\Controllers;

class ControllerWrapper {
  private $controller, $klass, $context;
  function __construct($controller, &$context) { 
    $this->klass = $controller;
    $this->controller = new $controller($context); 
    $this->context = $context;
  }
  function __call($method, $args) {
    $func = new \ReflectionMethod($this->klass, $method);
    $filename = $func->getFileName();
    $start_line = $func->getStartLine() - 1; // it's actually - 1, otherwise you wont get the function() block
    $end_line = $func->getEndLine();
    $length = $end_line - $start_line;

    $source = file($filename);
    $body = array_slice($source, $start_line, $length);
    
    array_pop($body); array_shift($body);
    $body = implode("\n", $body);
    
    $func = create_function('&$params, &$var, &$request, &$response', $body);
    return $func(
      $this->context->request->params,
      $this->context->response->vars,
      $this->context->request,
      $this->context->response
    );
  }
}