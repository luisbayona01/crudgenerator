<?php
include_once dirname(__FILE__) . '/Main.php';
/**
 * 
 */

/**
 * 
 */


class Crudgenerador 
{


public function  escribirdirectorio($directorio,$contenido){

 $fp=fopen($directorio, "a+");	
//exit();
  fwrite($fp,$contenido);	
fclose($fp);;
}


public  function lecturatabla($table){
$Main  = new Main();
$table = "empresa";
$sql   = "describe " . $table;
$query = $Main->abredatabase($sql);

$camposupdate = "";
$camposinsert = "";
while ($resultado = $Main->dregistro($query)) {

    //print_r($resultado);
    if ($resultado['Extra'] == "") {
        $camposinsert .= $resultado["Field"] . ",";
    }

    $camposupdate .= $resultado["Field"] . ",";

}
$this->modelos($table,$camposupdate);
$this->listarvista($table, $camposupdate);
$this->insertvista($table, $camposinsert);
$this->updatevista($table, $camposupdate);
}


 public function insertvista($table, $camposinsert)
{   $directoriovinser="Viewinsert".$table.".php";

//$directorioin=$this->abrirdirectorio($directoriovinser);
     $html = '<html lang="en">
		<head>
		  <title>Bootstrap Example</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		</head>
		<body>

		<div class="container">
		  <h2> insert' . $table . '</h2><form>';
//$this->escribirdirectorio($directoriovinser,$html);
    $campos = explode(",", substr($camposinsert, 0, -1));
    $formbody="";
    foreach ($campos as $insert) {

        $formbody.= '<div class="form-group">
		      <label for="'.$insert.'">' . $insert . ':</label>
		      <input type="text" class="form-control" id="'.$insert.'" placeholder="Enter '.$insert.'" name="'.$insert.'">
		    </div>';
//$this->escribirdirectorio($directorioin,$formbody);
         
    }

     $htmlf = '
		<button type="button" class="btn btn-default">Submit</button>
		 </form>
		</div>
		</body>
		</html>';
$contenido=$html.$formbody.$htmlf;
$this->escribirdirectorio($directoriovinser,$contenido);
//$this->cerrardrectorio($directorioin);
}



public function updatevista($table, $camposupdate)
{  $directorioupdate="Viewupdate".$table.".php";
    $html = '<html lang="en">
		<head>
		  <title>Bootstrap Example</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		</head>
		<body>

		<div class="container">
		  <h2> update'.$table.'</h2><form>';

    $campos = explode(",", substr($camposupdate, 0, -1));
     $formbody="";
    foreach ($campos as $update) {

        $formbody.= '<div class="form-group">
		      <label for="email">' . $update . ':</label>
		      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
		    </div>';

       
    }

    $htmlf = '
		<button type="button" class="btn btn-default">Submit</button>
		 </form>
		</div>
		</body>
		</html>';

	$contenido=$html.$formbody.$htmlf;
$this->escribirdirectorio($directorioupdate,$contenido);

}
public function  listarvista($table,$camposupdate){
 $html = '<html lang="en">
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

  $tableresponsiveini='<div class="container">
		  <h2>listar '.$table.'</h2><form><div class="table-responsive">
  <table class="table">';
  $cabezerastable='<thead><tr>';
   $thini="";
   foreach ($campos as $e) {

    $thini.='<th> '.$e.'</th>';
   }
   $cabezerastablefin='</tr></thead>';  
 $tbodyini='<tbody><tr> ';
 $cuerpo='';
foreach ($campos as $e) { 
  $cuerpo.='<td>'.$e.'</td>';
}
  $tbodyfin="</tr></tbody>"; 


  $fntable='</table>
</div>';

 $htmlf = '</div>
		</body>
		</html>';

$contenido=$html.$tableresponsiveini.$cabezerastable.$thini.$cabezerastablefin.$tbodyini.$cuerpo.$tbodyfin.$fntable.$htmlf;
$directoriolist="Viewlist".$table.".php";
$this->escribirdirectorio($directoriolist,$contenido);
}
public  function  modelos($table,$camposupdate){
$include="include_once dirname(__FILE__) .'/Main.php';";

$datos="";
$inserts="";
$update="";
$select="";
$varspost="";
 $camposM = explode(",", substr($camposupdate, 0, -1));
   
   foreach ($camposM as $update){ 
	
 $name=$update;
 
$posts="_POST['".$name."']"; 
$iguales='=';
$vars=$update;
$simbolo='$';
$cmilla=',';
$ptcma=';';

$varspost.= $simbolo.$vars.$iguales.$simbolo.$posts.$ptcma;
$campos='/".'.$simbolo.$name.'."/'.$cmilla;	
$datos.=$campos;	
$inserts.= $update.',';

$update.=$update.'='.'/".'.$simbolo.$name.'."/'.$cmilla;
$select.='[/'.$update.'/]';	
	
	}
   $replaceselect=str_replace("/","'",$select);
 $updte= substr($update,0,-1);
 $dateinserts= substr($inserts,0,-1); 
 $campillos= substr($datos,0,-1);
 $camposdate=str_replace("/","'",$campillos); 
 $replaceupdte=str_replace("/","'",$updte); 

$metodo_insert='"insert into '.$table.' ('.$dateinserts.') values ('.$camposdate.')"';

$metodo_actulaisar='"update '.$table.' set '.$replaceupdte.'"  ';
$metodo_elminar='"delete   from  '.$table.' where "';

$namearchivo="Modelo".$table.".php";


 $var="sql=";
 $simB='$';

 
  $dt=$table."\Modelo".$table.";"; 
 
$contenido='
<?php 

'.$include.'
class Modelo'.$table.' extends Main{  

public  function Insert_'.$table.'(){
	'.$varspost.'
	
'.$simB.$var.$metodo_insert.';	
	
} 

public function Actualisar_'.$table.'(){
'.$varspost.'
'.$simB.$var.$metodo_actulaisar.';	
	
	
	
	}

public  function Eliminar_'.$table.'(){
	'.$varspost.'
'.$simB.$var.$metodo_elminar.';	
	
	
	
	} 
	



	
	} 
   


?>
'; 

$directoriomodelo='Modelo'.$table.'.php';

$this->escribirdirectorio($directoriomodelo,$contenido);
}

	
}



$Crudgenerador=new Crudgenerador();

$table="";
$Crudgenerador->lecturatabla($table);