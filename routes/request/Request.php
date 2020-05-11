<?php 
  
  class Request 
  {  
     public   function __construct(){
     
      $data=explode("/",$_SERVER['REQUEST_URI']);
       
       if(count($data)>2){
     
       $urls= (empty($data[3])) ? '/' : $data[3]; 
       $array= array($urls=>$urls);
       } else {
      $urls=parse_url(trim($_SERVER['REQUEST_URI'],'/'),PHP_URL_PATH)?:'/';
 
       }
      
   
     $this->url= $urls;
     $this->method=$_SERVER['REQUEST_METHOD'];
     $this->params=array_slice(explode("/",trim($_SERVER['REQUEST_URI'],'/')), 1) ?:null;
    
    }	
     

      public function getUrl() {
          return $this->url;
      }

      public function getMethod() {
          return $this->method;
      }

      public function getParams() {
          return $this->params;
      }

      public function setUrl($url) {
          $this->url = $url;
      }

      public function setMethod($method) {
          $this->method = $method;
      }

      public function setParams($params) {
          $this->params = $params;
      }

        	


  }



