<?php
class ConexionBD 
{
	private $conexion;
	private $total_consulta;
	private $name_bd= "db_mini_interal_1";
	protected $name_folder = "generador";

	
	
	public function __construct()
	{		
		if(!isset($this->conexion)){
			$this->conexion = mysqli_connect("localhost", "root", "12345678", $this->name_bd);
			if($this->conexion){
				return true;
			}else{
				if (mysqli_connect_errno()) {
				    printf("Conexión fallida: %s\n", mysqli_connect_error());
				    exit();
				}
			}
		}	
				
	}
	
	
	
	public function consulta($consulta){
		$this->total_consulta++;
		$resultado = mysqli_query($this->conexion, $consulta);
		if(!$resultado){
			echo 'MySQL Error: '.mysqli_connect_errno();
			exit;
		}
		return $resultado;
	}
	public function fetch_array($consulta)
	{
		return mysqli_fetch_array($consulta);
	}
	public function num_rows($consulta)
	{
		return mysqli_num_rows($consulta);
	}
	public function getTotalConsultas(){
		return $this->total_consulta;
	}
	public function getArraySQL($sql){

	    if(!$result = mysqli_query($this->conexion, $sql)) die(); //si la conexión cancelar programa
	    $rawdata = array();     
	    $i=0;
	    while($row = mysqli_fetch_array($result))
	    {
	        $rawdata[$i] = $row;
	        $i++;
	    }
	    //disconnectDB($conexion); 
	    return $rawdata; //devolvemos el array
	    //$myArray = getArraySQL($sql);
	    //echo json_encode($myArray);
	}

	

	public function consulta_tablas()
	{
		
		$configura = 'SHOW FULL TABLES FROM '.$this->name_bd.'';

		$table = "Tables_in_".$this->name_bd;

		$consulta = $this->consulta($configura);
		$rawdata = array();
		$i=0;
		if($this->num_rows($consulta)){
			while($row = mysqli_fetch_array($consulta)){
				$rawdata[$i] = $row[$table];
				$i++;
			}
		}
		/*else{
			return "Error de la Conulta";
		}*/
		//return $rawdata;
		return $rawdata;
		
	}



}



?>