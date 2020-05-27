<?php 
                      namespace app\Controllers;
                      use app\Models\ModeloUsuario;
                      class UsuarioController {
                       Public   static function addUsuario(){
           $ModeloUsuario=new ModeloUsuario();
            $nombre=$nombre['nombre'];$ModeloUsuario->setNombre($nombre);$edad=$edad['edad'];$ModeloUsuario->setEdad($edad);$color=$color['color'];$ModeloUsuario->setColor($color);$respuesta;
            
           if($ModeloUsuario->addUsuario()== '1'){
                  $respuesta='operacion exitosa';
                 }   

           $Response=array('respuesta'=>$respuesta);
           $json=json_encode($Response)
          return $json;
                 }public  static  function deleteUsuario(){  $ModeloUsuario=new ModeloUsuario();} public  static function  mostrarUsuario(){  $ModeloUsuario=new ModeloUsuario();$ModeloUsuario->Listar_Usuario();}public  static function  editUsuario(){ $ModeloUsuario=new ModeloUsuario();}public  static function  updateUsuario(){  $ModeloUsuario=new ModeloUsuario();$nombre=$nombre['nombre'];$ModeloUsuario->setNombre($nombre);$edad=$edad['edad'];$ModeloUsuario->setEdad($edad);$color=$color['color'];$ModeloUsuario->setColor($color);$ModeloUsuario->setid(id)$ModeloUsuario->updateUsuario();}}