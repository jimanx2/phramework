<?php namespace Phramework\ActiveRecord;

use Phramework\Utils\DbFactory;

class ActiveRecord {
  
  var $connection;
  
  public static function __callStatic($name, $arguments){
    $allowed_names = ["find_by"];
    
    if(!in_array($name,$allowed_names)){ 
      throw new \Exception("Undefined function $name!");
    }
    
    $func_to_call = $_name;
    
    $cls = get_called_class();
    $cls::$func_to_call($arguments);
  }
  
  public static function find_by($where){
    $dbf = new DbFactory(get_called_class());
    $query = $dbf->translate("where", $where);
    
  }
}