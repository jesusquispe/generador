<?php
include("../model/ConexionBD.php");

include("../datatable_model/controller/Create_controller.php");

class Carpeta extends ConexionBD
{
    private $controller = "datatable_admin/controllers";

    //colocar el primer valor mayuscala
    public function mayuscula($val)
    {
        return ucfirst($val);
    }

    public function ultimo_caracter_delete($caracter)
    {
        return substr($caracter, 0, -1);
    }
    
    public function create_controller_table()
    {
        $Create_controller = new Create_controller();
        $array_num_form = count($this->consulta_tablas());
        
        for($i = 0; $i < $array_num_form; ++$i)
        {
            //$start_list_type = array();
            //$start_update_input_start = array();
            //$start_update_input_end = array();
            $table = $this->ultimo_caracter_delete($this->consulta_tablas()[$i]);

            //$list_type[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');

            $basepath = $Create_controller->basepath();
            $class_start = $Create_controller->class_start($table);
            $construct = $Create_controller->construct($table);
            $index = $Create_controller->index($table);

            //start list
            $ajax_list_start = $Create_controller->ajax_list_start($table);
               
                //while($row = $this->fetch_array($list_type[$i]))
                //{
                    //$start_list_type[] = $Create_controller->ajax_list_body($table, $row[Field], $row[Type]);
                //}        
            $ajax_list_end = $Create_controller->ajax_list_end($table);
            //end start

            $class_end = $Create_controller->class_end();
            
           // $list_datatable = implode($start_list_type);

            $union = "<?php
{$basepath}
{$class_start}
{$construct}
{$index}
{$ajax_list_start}


{$ajax_list_end}

{$class_end}";
            $code = $union;

            $this->create_controller($table, $code);
        }
       
    }
    public function create_controller($table, $controller)
    {
        //$table = $this->ultimo_caracter_delete($table_controller);
        $carpeta_url = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->controller.'';
        if (file_exists($carpeta_url)){
            //mkdir($carpeta_url, 0777, true);
           
            $code_controller = $controller;

            $archive_controller = fopen(''.$carpeta_url.'/'.$this->mayuscula($table).'.php', 'w') or die('error creando fichero!');            

            fputs($archive_controller, $code_controller);
            fclose($archive_controller);
            echo '<p>Exito Archivo creado '.$table.'</p>';
        }else{
            echo "No se creo el Archivo";
        }

    }

}

$file_creator = new Carpeta();

$file_creator->create_controller_table();

?>