<?php 
         namespace app\Models;
         use config\Main;    
         class ModeloUsuario{  
         protected $id;
public $nombre;
public $edad;
public $color;
public function  setNombre($nombre){
          $this->nombre=$nombre;

         }
public function  setEdad($edad){
          $this->edad=$edad;

         }
public function  setColor($color){
          $this->color=$color;

         }

         public function setId($id){
         $this->id= $id;
        }  
        public function addUsuario(){
            $Main=new main();
            $sql="insert intousuario(nombre,edad,color,) values('".$this->nombre."','".$this->edad."','".$this->color."')"; 
            $Query= $Main->dbAbreDatabase($sql); 
             if($Query){
               return true;    
             } else{
               return false;
             }
           }

        public function updateUsuario(){
            $Main=new main();
            $sql="update set nombre='".$this->nombre."',edad='".$this->edad."',color='".$this->color."'where id='".$this->id."'"; 
            $Query= $Main->dbAbreDatabase($sql); 
             if($Query){
               return 1;    
             } else{
               return 0;
             }
           }
           public function deleteUsuario(){
            $Main=new main();
            $sql=" delete  from usuariowhere id='".$this->id."'"; 
            $Query= $Main->dbAbreDatabase($sql); 
             if($Query){
               return 1;    
             } else{
               return 0;
             }
           } 
           public function editUsuario(){
            $Main=new main();
            $sql=" select * from usuario where id='".$this->id."'"; 
            $Query= $Main->dbAbreDatabase($sql); 
             $rows=$Main->dbTrareGistro($Query);
             return$rows;  
           } 

           public  function Listar_Usuario(){
           $Main=new main();
           $sql='SELECT * FROM usuario';
          $Query=$Main->dbAbreDatabase($sql);
           $data=array();
           while($rows=$Main->dbTrareGistro($Query)){
           $data[]=$rows;
          
           }
          
            return $data;
           }    


       }