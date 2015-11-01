<?php namespace Phramework;
  
use Phramework\Utils\Inireader;
use Phramework\Utils\Defaults;
use Phramework\Request;
use Phramework\Response;
use Phramework\Router;
use Phramework\Controllers\ControllerWrapper;
use Phramework\Initializers\ErrorHandler;

class Core {
  var $config, $router, $response, $request, $defaults;
  
  public function __construct(){
    global $routes;
    new Defaults($this);
    
    # load defined routes
    require $this->defaults->root . "/config/routes.php";
    
    new ErrorHandler($this);
    new Inireader($this);
    new Router($this);
    new Request($this);
    new Response($this);
  }
  
  public function getEnvironment(){
    $route_info = $this->router->parse($_SERVER['PHP_SELF']);
    $this->request->params = 
      array_merge($this->request->params, $this->router->params);
    $controller = $route_info["controller"];
    $action = $route_info["action"];
    $this->request->params["controller"] = $controller;
    $this->request->params["action"] = $action;
    return ["controller" => "\\$controller", "action" => $action];
  }
  
  public function run(){
    $env = $this->getEnvironment();
    $controller = $env['controller'];
    $action = $env['action'];
    $controller = new ControllerWrapper($controller, $this);
    $controller->$action();
    $this->response->render();
  }
  
}