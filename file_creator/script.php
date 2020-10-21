<?php

include("../model/ConexionBD.php");

include("../model/model/Create_model.php");

class Carpeta extends ConexionBD
{

    private $model = "admin/models";

    public function mayuscula($val)
    {
        return ucfirst($val);
    }

    public function create_model_table()
    {
        $Create_model = new Create_model();
        $array_num_form = count($this->consulta_tablas());
        
        for($i = 0; $i < $array_num_form; ++$i)
        {
            $table=$this->consulta_tablas()[$i];
            $star_class = $Create_model->start_class($table);
                $list = $Create_model->list($table);
                $delete = $Create_model->delete($table);
                $insert = $Create_model->insert($table);
                $optain = $Create_model->optener_datos($table);
                $update = $Create_model->update($table);
            $end_class = $Create_model->end_class();

            $model = "
            {$star_class}
                {$list}
                {$delete}
                {$insert}
                {$optain}
                {$update}
            {$end_class}
            ";
            $union = $model;
            
            $this->create_model_php($table, $union);
           
        }
       
    }

    public function create_model_php($table, $model)
    {
        $carpeta_url = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->model.'';
        if (file_exists($carpeta_url)){
            //mkdir($carpeta_url, 0777, true);
           
            $formulario_table = $model;

            $form_table = fopen(''.$carpeta_url.'/'.$this->mayuscula($table).'_model.php', 'w') or die('error creando fichero!');            

            fputs($form_table, $formulario_table);
            fclose($form_table);
            echo '<p>Exito Archivo creado Model '.$table.'</p>';
        }else{
            echo "No se creo el Archivo";
        }
    }
    
}

$file_creator = new Carpeta();

echo $file_creator->create_model_table();


?>