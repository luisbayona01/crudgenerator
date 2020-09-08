<?php
define ('ROOT',dirname(__FILE__));
 /* cabezeras  encaso de acceder de manera externa*/
/*header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');*/
use app\Controllers\UsuarioController;
$route->get('/',function(){

include_once ROOT."/app/views/usuario.php"; 
}); 

 
$route->post('/funcionarios',function(){
 
     
 });

$route->post('/items',function(){

});


?>