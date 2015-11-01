<?php namespace Phramework;

class Router {
  
  var $__routes, $params;
  var $context;
  public function __construct($context){
    global $routes;
    
    require $context->defaults->root."/config/routes.php";
    
    $this->__routes = $routes;
    $this->params = [];
    $context->router = $this;
    $this->context = $context;
  }
  
  public function getParams(){
    return $this->params;
  }
  
  public function parse($path){
    global $__file, $__dir;
    $handler = NULL;
    $__ext = pathinfo($path, PATHINFO_EXTENSION);
    $__file = pathinfo($path, PATHINFO_FILENAME);
    $__dir = pathinfo($path, PATHINFO_DIRNAME);
    $__file = ( $__dir == "/" || $__dir == "\\" ? "/" : $__dir . "/" ) . $__file;
    
    $dynamic = [];
    $indexes = [];
    foreach($this->__routes as $def => $route){
      $re = "/(\\:([^\\W]+))/";
      $found = preg_replace_callback($re, function($matches) use (&$indexes){
        array_push($indexes, $matches[2]);
        return '([^\/]+)';
      }, $def);  
      if( $found != $def ){
        array_push($dynamic,["rgx" => $found, "pattern" => $def, "idx" => $indexes]);
      }
    }
    
    $matched_routes = array_filter($dynamic, function($def) use ($__file){
      $regex = $def["rgx"];
      $regex = str_replace("/", "\/", $regex);
      $regex = str_replace("\\\\", "\\", $regex);
      $regex = "/${regex}/";
      
      preg_match($regex, $__file, $matches);
      foreach($def['idx'] as $i => $v){
        $this->params[$v] = $matches[$i+1];
      }
      return $matches;
    });
    
    if( !empty($matched_routes) ){
      $__file = $matched_routes[0]["pattern"];
    } else if( !isset($this->__routes[$__file]) ) {
      throw new \Exception("Unknown route $__file.");
    }
    
    list($controller, $action) = explode("#", $this->__routes[$__file]);
    $controller = "App\\Controllers\\".ucfirst($controller);
    
    return ["controller" => $controller, "action" => $action];
  }
}
