<?php namespace Phramework\Utils;

class Inireader {
  var $configs;
  
  public function __construct($context = NULL) {
    $ini_file = $context->defaults->root . "/config/application.ini";
    $context->config = parse_ini_file($ini_file, true); 
  }
}