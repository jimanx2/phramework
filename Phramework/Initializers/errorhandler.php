<?php namespace Phramework\Initializers;

class ErrorHandler {
  
  public function __construct($context = NULL){
    set_exception_handler(function($exception){
      header("Content-Type: text/plain");
      echo $exception->getMessage(); die;
    });
  }
}