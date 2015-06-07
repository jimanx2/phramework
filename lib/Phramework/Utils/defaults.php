<?php namespace Phramework\Utils;

class Defaults {
  var $context, $root, $view_path;
  
  public function __construct($context = NULL){
    $context->defaults = $this;
    $this->root = dirname($_SERVER["DOCUMENT_ROOT"]);
    $this->view_path = $this->root . "/app/views/";
  }
  
  /*
  private static function get_controller($controller = ""){
    return strtolower(str_replace("App\\Controllers\\", "", $controller));
  }
  */
}

/* default constants definition */
define('NOTHING', 'NOTHING');