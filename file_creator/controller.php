<?php
include("../model/ConexionBD.php");
include("../model/controller/Create_controller.php");

class Carpeta extends ConexionBD
{
    private $controller = "admin/controllers";

    //colocar el primer valor mayuscala
    public function mayuscula($val)
    {
        return ucfirst($val);
    }

    public function create_controller_code()
    {
        $Create_controller = new Create_controller();
        $array_num_form = count($this->consulta_tablas());
        
        for($i = 0; $i < $array_num_form; ++$i)
        {
            $start_insert_input = array();
            $start_update_input_start = array();
            $start_update_input_end = array();

            $table=$this->consulta_tablas()[$i];
            $controller_input_insert[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $controller_input_update[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $controller_input_update_data[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');


            $start_controller = $Create_controller->start_controller($table);
            $home_construct = $Create_controller->home_construct();
            $vista_index = $Create_controller->vista_index($table);
            $start_insert = $Create_controller->start_insert();
            while($row = $this->fetch_array($controller_input_insert[$i])){
                $start_insert_input[] = $Create_controller->start_insert_input($row[Field]);
            }
            $end_insert = $Create_controller->end_insert($table);
            $list = $Create_controller->list($table);
            $delete = $Create_controller->delete($table);
            $edit = $Create_controller->edit($table);

            $start_update = $Create_controller->start_update();
            while($row = $this->fetch_array($controller_input_update[$i]))
            {
                $start_update_input_start[] = $Create_controller->start_update_input_start($row[Field]);
            }
            $start_update_input_main = $Create_controller->start_update_input_main();
           while($row = $this->fetch_array($controller_input_update_data[$i]))
            {
               $start_update_input_end[] = $Create_controller->start_update_input_end($row[Field]);
            }

            $end_update = $Create_controller->end_update($table);

            $end_controller = $Create_controller->end_controller();

            $insert_input = implode($start_insert_input);
            $update_input= implode($start_update_input_start);
            $update_input_data = implode($start_update_input_end);

            $union = "
                        {$start_controller}
                        {$home_construct}
                        {$vista_index}
                        {$start_insert}
                        {$insert_input}//while
                        {$end_insert}
                        {$list}
                        {$delete}
                        {$edit}
                        {$start_update}
                        {$update_input}//while
                        {$start_update_input_main}
                        {$update_input_data}//while
                        {$end_update}
                        {$end_controller}
                        ";
            $code = $union;

            $this->create_controller($table, $code);
        }
    }

    public function create_controller($table, $controller)
    {
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

echo $file_creator->create_controller_code();


?>