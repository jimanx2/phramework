<?php namespace Phramework\Utils;

use ICanBoogie\Inflector;

class DbFactory {
  var $table_name, $class_name;
  public function __construct($cls = ""){
    $klass = new \ReflectionClass($cls);
    $inflector = Inflector::get('en');
    $this->class_name = $klass->getShortName();
    $this->table_name = $inflector->pluralize(
      strtolower($this->class_name)
    );
  }
  
  public function translate($type, $args){
    
  }
  
}