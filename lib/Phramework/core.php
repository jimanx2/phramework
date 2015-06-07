<?php namespace Phramework;
  
use Phramework\Utils\Inireader;
use Phramework\Utils\Defaults;
use Phramework\Request;
use Phramework\Response;
use Phramework\Router;
use Phramework\Initializers\ErrorHandler;

class Core {
  var $config, $router, $response, $request, $defaults;
  
  public function __construct(){
    global $routes, $__loadtime;
    
    $__loadtime = microtime();
    new Defaults($this);
    
    # load defined routes
    require $this->defaults->root . "/config/routes.php";
    
    new ErrorHandler($this);
    new Inireader($this);
    new Router($this);
    new Request($this);
    new Response($this);
  }
  
  public function run(){
    global $__loadtime;
    
    $route_info = $this->router->parse($_SERVER['PHP_SELF']);
    $controller = $route_info["controller"];
    $action = $route_info["action"];
    $this->request->params["controller"] = $controller;
    $this->request->params["action"] = $action;
    $controller = "\\$controller";
    $controller = new $controller($this);
    $controller->$action();
    $this->response->render();
    
    $__loadtime = microtime() - $__loadtime;
  }
  
}