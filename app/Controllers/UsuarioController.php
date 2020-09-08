<?php 
                      namespace app\Controllers;
                      use app\Models\Usuario;
                      class UsuarioController {
                       Public   static function addUsuario(){
           $ModeloUsuario=new Usuario();
            $nombre=$nombre['nombre'];$ModeloUsuario->setNombre($nombre);$edad=$edad['edad'];$ModeloUsuario->setEdad($edad);$color=$color['color'];$ModeloUsuario->setColor($color);$respuesta;
            
           if($ModeloUsuario->addUsuario()== '1'){
                  $respuesta='operacion exitosa';
                 }   

           $Response=array('respuesta'=>$respuesta);
           $json=json_encode($Response);
          return $json;
                 }public  static  function deleteUsuario(){  $ModeloUsuario=new Usuario();} public  static function  mostrarUsuario(){  $ModeloUsuario=new Usuario();
                  echo json_encode($ModeloUsuario->Listar_Usuario());}public  static function  editUsuario(){ $ModeloUsuario=new Usuario();}public  static function  updateUsuario(){  $ModeloUsuario=new Usuario();$nombre=$nombre['nombre'];$ModeloUsuario->setNombre($nombre);$edad=$edad['edad'];$ModeloUsuario->setEdad($edad);$color=$color['color'];$ModeloUsuario->setColor($color);$ModeloUsuario->setid($id);$ModeloUsuario->updateUsuario();}}