<?php namespace Phramework;

use Phramework\Utils\Defaults;
use \Twig_Loader_Filesystem;
use \Twig_Environment;

class Response {
  var $headers, $context, $view_path, $cache_path, $layout;
  
  public function __construct($context){
    $context->response = $this;
    $this->context = $context;
    $this->headers = [];
    $this->cache_path = "";
    $this->layout = "application";
  }
  
  public function render($opts = NULL){
    global $var;
    
    foreach($this->headers as $header=>$value){
      header ("$header: $value");
    }
    
    if($opts == NOTHING) 
      return $this->render_blank();
    
    if(isset($opts["layout"]))
      $this->layout = $opts["layout"];
    
    if(!isset($var))
      $var = [];
    
    $loader = new Twig_Loader_Filesystem($this->context->defaults->view_path);
    $twig = new Twig_Environment($loader, array(
        'cache' => $this->cache_path,
    ));
    
    echo $twig->render(
      "layouts/$this->layout.php", 
      array(
        "action" => 'pages/'.$this->context->request->params['action'].'.php', 
        "variables" => $var
      )
    );
  }
  
  private function render_blank(){
    echo "";
  }
}