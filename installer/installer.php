<?php

define("Rootpath", $_SERVER["DOCUMENT_ROOT"] . "/crudgenerator");

use config\Main;

class Crudgenerador
{
    public function traertablas()
    { 
      $Main         = new Main(); 
      $sql          ="show TABLES";
      $query        = $Main->dbAbreDatabase($sql);
      $tablas       = array();
      while ($resultado = $Main->dbTrareGistro($query)) {
          $tablas[]=$resultado['Tables_in_prueba'];  //  colocar  aqui  si es  tables  in nombre de la bd  en mysql  
          
           
        }
     return $tablas;
     } 
    
    public function lecturatabla($table)
    {
        $Main         = new Main();
        //$table = "empresa";
        $sql          = "describe " . $table;
        $query        = $Main->dbAbreDatabase($sql);
        $primary      = "";
        $camposupdate = "";
        $camposinsert = "";
        while ($resultado = $Main->dbTrareGistro($query)) {
            
            //print_r($resultado);
            if ($resultado['Key'] !== 'PRI') {
                $camposinsert .= $resultado["Field"] . ",";
            }
            if ($resultado['Key'] == 'PRI') {
                $primary .= $resultado["Field"];
            }
            $camposupdate .= $resultado["Field"] . ",";
        }
        
        $this->modelos($table, $camposinsert, $primary);
        $this->listarvista($table, $camposupdate);
        $this->updatevista($table, $camposupdate);
    }
    public function escribirdirectorio($directorio, $contenido)
    {
        
        $fp = fopen($directorio, "w");
        //exit();
        fwrite($fp, $contenido);
        fclose($fp);
    }
    
    
    public function updatevista($table, $camposupdate)
    {   $tabla          = ucwords($table); 
        $directorioupdate = Rootpath . "/app/update" . $tabla . ".php";
        $html             = '

                        <div class="container">
                          <h2> update' . $table . '</h2><form>';
        
        $campos   = explode(",", substr($camposupdate, 0, -1));
        $formbody = "";
        foreach ($campos as $update) {
            
            $formbody .= '<div class="form-group">
                              <label for="email">' . $update . ':</label>
                              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                            </div>';
        }
        
        $htmlf = '<button type="button" class="btn btn-default">Submit</button>
                         </form>
                        </div>';
        
        $contenido = $html . $formbody . $htmlf;
        $this->escribirdirectorio($directorioupdate, $contenido);
    }
    
    public function listarvista($table, $camposupdate)
    {
        $tabla  = ucwords($table);
        $html   = '<html lang="en">
                        <head>
                          <title>Bootstrap Example</title>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1">
                          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
                        </head>
                        <body ng-app="myApp">';
        $campos = explode(",", substr($camposupdate, 0, -1));
        
        $tableresponsiveini = '<div class="container">
                           <h2>listar' . $tabla . '</h2>
                           <div class="table-responsive">
                            <table class="table">';
        $cabezerastable     = '<thead><tr>';
        $thini              = "";
        foreach ($campos as $e) {
            
            $thini .= '<th>' . $e . '</th>';
        }
        $cabezerastablefin = '</tr>
                         </thead>';
        $tbodyini          = '<tbody>
                  <tr>';
        $cuerpo            = '';
        foreach ($campos as $ex) {
            $cuerpo .= '<td>' . $ex . '</td>';
        }
        $tbodyfin = "</tr>
            </tbody>";
        
        
        $fntable = '</table>
                </div>';
        
        $htmlf = '<div id="myModalinsert" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">insert' . $tabla . ' </h4>
         </div>
       <div class="modal-body">
       <form>';
        //$this->escribirdirectorio($directoriovinser,$html);
        
        $formbody = "";
        foreach ($campos as $insert) {
            
            $formbody .= '<div class="form-group">
                           <label for="' . $insert . '">' . $insert . ':</label>
                <input type="text" class="form-control" id="' . $insert . '" placeholder="Enter ' . $insert . '" name="' . $insert . '">
                            </div>';
           
        }
        
        $formbody .= '</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>';
        
        
        
        $htmlfin = $formbody . '</div>
                        </body>
                        </html>';
        
        $contenido      = $html . $tableresponsiveini . $cabezerastable . $thini . $cabezerastablefin . $tbodyini . $cuerpo . $tbodyfin . $fntable . $htmlf . $htmlfin;
        $directoriolist = Rootpath . "/app/Views/" . $tabla . ".php";
        $this->escribirdirectorio($directoriolist, $contenido);
    }
    
    public function modelos($table, $camposinsert, $primary)
    {
        $tabla            = ucwords($table);
        $camposM          = explode(",", substr($camposinsert, 0, -1));
        $simbolo          = '$';
        $campoPOSt        = "";
        $campoThis        = "";
        $camposupdate     = "";
        $directoriomodelo = Rootpath . "/app/Models/" . $tabla . '.php';
      
        $phpM = "<?php 
         namespace app\Models;
         use config\Main;    
         class Modelo" . $tabla . "{  
         ";
        
        foreach ($camposM as $value) {
            
            
            $phpM .= "public " . $simbolo . $value . ";\n";
            $campo = ucwords($value);
            
            $phpM .= "public function  set" . $campo . "(" . $simbolo . $value . "){
          " . $simbolo . "this->" . $value . "=" . $simbolo . $value . ";

         }\n";
            $varthis = $simbolo . 'this->' . $value;
            $campoPOSt .= $value . ",";
            $campoThis .= '/".' . $varthis . '."/,';
            $camposupdate .= $value . "=" . '/".' . $varthis . '."/,';
        }
        
        $campothis    = substr($campoThis, 0, -1);
        $camposUpdate = substr($camposupdate, 0, -1);
        $campoP       = ucwords($primary);
        $varthisP     = $simbolo . 'this->' . $primary;
        $primaryKey   = '/".' . $varthisP . '."/';
        $sqlInsert    = $simbolo . 'sql="insert into'.$table.'(' . $campoPOSt . ') values(' . $campothis . ')"';
        $sqlUpdate    = $simbolo . 'sql="update set '.$camposUpdate.'where ' . $primary . '=' . $primaryKey . '"';
        $sqldelete    = $simbolo . 'sql=" delete  from '.$table.'where ' . $primary . '=' . $primaryKey . '"';
        $sqlbuscar    = $simbolo . 'sql=" select * from ' . $table . ' where ' . $primary . '=' . $primaryKey . '"';
        $phpM .= "protected " . $simbolo . $primary . "; 
         public function set" . $campoP . "(" . $simbolo . $primary . "){
         " . $simbolo . "this->" . $primary . "= " . $simbolo . $primary . ";
        }  
        public function add" . $tabla . "(){
            " . $simbolo . "Main=new main();
            " . $sqlInsert . "; 
            " . $simbolo . "Query= " . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql); 
             if(" . $simbolo . "Query){
               return 1;    
             } else{
               return 0;
             }
           }

        public function update" . $tabla . "(){
            " . $simbolo . "Main=new main();
            " . $sqlUpdate . "; 
            " . $simbolo . "Query= " . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql); 
             if(" . $simbolo . "Query){
               return 1;    
             } else{
               return 0;
             }
           }
           public function delete" . $tabla . "(){
            " . $simbolo . "Main=new main();
            " . $sqldelete . "; 
            " . $simbolo . "Query= " . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql); 
             if(" . $simbolo . "Query){
               return 1;    
             } else{
               return 0;
             }
           } 
           public function edit" . $tabla . "(){
            " . $simbolo . "Main=new main();
            " . $sqlbuscar . "; 
            " . $simbolo . "Query= " . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql); 
             " . $simbolo . "rows=" . $simbolo . "Main->dbTrareGistro(" . $simbolo . "Query);
             return" . $simbolo . "rows;  
           } 

           public  function Listar_" . $tabla . "(){
           " . $simbolo . "Main=new main();
           " . $simbolo . "sql='SELECT * FROM " . $table . "';
          " . $simbolo . "Query=" . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql);
           " . $simbolo . "data=array();
           while(" . $simbolo . "rows=" . $simbolo . "Main->dbTrareGistro(" . $simbolo . "Query)){
           " . $simbolo . "data[]=" . $simbolo . "rows;
          
           }
          
            return " . $simbolo . "data;
           }    


       }";
        
        
        $phpM = str_replace("/", "'", $phpM);
       
        
        $this->escribirdirectorio($directoriomodelo, $phpM);
    }
      public   function   Controladores($table, $camposinsert, $primary){
        $simbolo          = '$';
        $tabla            = ucwords($table);
        $camposM          = explode(",", substr($camposinsert, 0, -1));
        $namespaces='app\Models\Modelo'.$tabla;
        $eliminadoespacio= trim($namespaces);
        $modelo=$simbolo."Modelo".$tabla."="."new Modelo".$tabla."();"; 

          $phpController="<?php 
                      namespace app\Controllers;
                      use ".$eliminadoespacio.";
                      class ".$tabla."Controller {
                       ";

          $phpController.="Public   static function add".$tabla."(){
           ".$modelo."
            ";
           

          foreach ($camposM as $post) {
                $campo = ucwords($post);
                $phpController.=$simbolo.$post."=".$simbolo.$post."["."'".$post."'"."];"; 
                $phpController.=$simbolo."Modelo".$tabla."->set".$campo."(".$simbolo.$post.");";  
             }
           $phpController.=$simbolo."Modelo".$tabla."->add".$tabla ."();";

          $phpController.="}";              
          $phpController.= "public  static  function delete".$tabla."(){  ".$modelo."";
               
          $phpController.="}";   
          $phpController.=" public  static function  mostrar".$tabla."(){  ".$modelo."";
          $phpController.=$simbolo."Modelo".$tabla."->Listar_".$tabla ."();";
          $phpController.="}";   
          $phpController="public  static function  edit".$tabla."(){ ".$modelo.""; 
                        
          $phpController.="}";   

          $phpController= "public  static function  update".$tabla."(){  ".$modelo."";
              foreach ($camposM as $post) {
                $campo = ucwords($post);
                $phpController.=$simbolo.$post."=".$simbolo.$post."["."'".$post."'"."];"; 
                $phpController.=$simbolo."Modelo".$tabla."->set".$campo."(".$simbolo.$post.");";  
             }  
             $phpController.=$simbolo."Modelo".$tabla."->set".$primary."($primary)";
             $phpController.=$simbolo."Modelo".$tabla."->update".$tabla ."();";   

          $phpController.="}";         
                      
          $phpController.="}";    
                                
      }
    
}