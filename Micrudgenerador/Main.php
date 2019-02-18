  <?php    
				 include_once(dirname(__FILE__).'/conf.cnf');
                   
                  class Main{ 
						public $_servidor=DB_HOST;
						protected $_pass=DB_PASS;
						protected $_bd=DB_NAME;
						public  $_user=DB_USER;             
				
				 protected $_db; 
			
				public function __construct() 
				{
				
		     $this->_db = new mysqli($this->_servidor,$this->_user,$this->_pass,$this->_bd); 
				   if ( $this->_db->connect_errno ) 
					{ 
				 echo "Fallo al conectar a MySQL: ".$this->_db->connect_error; 
						return;     
			   } 
				$this->_db->set_charset('utf-8'); 
				} 
				
				public  function abredatabase($sql){
					$resultado=$this->_db->query($sql)or die($this->_db->error); ; 	
					return $resultado;	
				}
				public function dregistro($resultado) 
				{ 
				  return  mysqli_fetch_array($resultado, MYSQLI_ASSOC);
				  $this->_db->set_charset('utf-8');
			   }
				public   function numfield($res){
					return mysqli_num_fields($res);	
					}
				public  function numerodefilas($res){
				return mysqli_num_rows($res);	
					}
				public function dnombrecampo($res){
				 return	mysqli_fetch_field($res);	
				}
				
				public function escpcart($var){
					return mysqli_real_escape_string($var);
					
					}
				public  function  __destructor(){
				mysqli_close($this->_db);  
				
				//return; 
					}
			
		public  function mostrartbl($data){
	     
			$ejecutar="SHOW FULL TABLES FROM"." ".$this->_bd.$data."";		
			
			return $ejecutar;
			
			}

			
	}

 ?>