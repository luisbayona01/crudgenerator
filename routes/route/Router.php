<?php 

class Router 
{
  protected  $routes= ['GET'=>[],'POST'=>[]];	
  protected $url;
  protected $method;
  protected $matched_route;

 public function __construct(Request $r){

  $this->url= $r->getUrl();
  $this->method = $r->getMethod();
 }

public  function dispatch(){
if(is_callable($this->matched_route)){
 $callable=$this->matched_route;
 return  $callable();
}

 }
public  function match(){

 if(!array_key_exists($this->url,$this->routes[$this->method])){
  throw new Exception("Error 404 ruta no existe");
  }

 $this->matched_route= $this->routes[$this->method][$this->url];

 } 
public function get ($path,$handler){
   $path=trim($path,'/')?:'/';
   $this->routes['GET'][$path]=$handler;

}  
public function post ($path,$handler){
   $path=trim($path,'/')?:'/';
   $this->routes['POST'][$path]=$handler;

} 
  public   function loadRoutes($routesFile){
  $route=$this;
   require  $routesFile;
     //echo $routesFile;
     //die();
   return  $route; 
  } 

}