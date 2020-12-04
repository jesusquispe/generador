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
            $tupla = array();
            $edit_date = array();
            $add = array();
            $ajax_add = array();
            $ajax_update =array();
            $ajax_remove = array();
            $ajax_update_photo = array();
            $ajax_delete =array();
            $ajax_upload = array();
            $ajax_validate_tupla =array();


            $table = $this->consulta_tablas()[$i];

            $lista_tupla[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $edit_tupla[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $add_tupla[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $update_tupla[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $delete_tupla[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $upload[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');


            $tables = $this->ultimo_caracter_delete($table);


            $basepath = $Create_controller->basepath();
            $class_start = $Create_controller->class_start($tables);
            $construct = $Create_controller->construct($tables);
            $index = $Create_controller->index($tables);

            //start list
            $ajax_list_start = $Create_controller->ajax_list_start($tables);
               
                while($row = $this->fetch_array($lista_tupla[$i]))
                {
                    $tupla[] = $Create_controller->ajax_list_body($tables, $row[Field], $row[Type],$row[Key]);
                }        
            $ajax_list_end = $Create_controller->ajax_list_end($tables);
            //end start

                $ajax_edit_start = $Create_controller->ajax_edit_start($tables);
                    while($row = $this->fetch_array($edit_tupla[$i])){
                        $edit_date[] = $Create_controller->ajax_edit_body($row[Type], $row[Field]);
                    }
                $ajax_edit_end = $Create_controller->ajax_edit_end();

                $ajax_add_start = $Create_controller->ajax_add_start();
                    while($row = $this->fetch_array($add_tupla[$i])){
                        $add[] = $Create_controller->ajax_add_body_start($row[Field],$row[Type],$row[Key]);
                        $ajax_add[] = $Create_controller->ajax_add_photo($row[Field],$row[Type]);
                    }
                    $ajax_add_body_end = $Create_controller->ajax_add_body_end();
                    
                $ajax_add_end = $Create_controller->ajax_add_end($tables);

                $ajax_update_start = $Create_controller->ajax_update_start();
                    while($row = $this->fetch_array($update_tupla[$i]))
                    {
                        $ajax_update[] = $Create_controller->ajax_update_body($row[Field], $row[Type],$row[Key]);
                        $ajax_remove[] = $Create_controller->ajax_update_remove_photo($row[Field], $row[Type]);
                        $ajax_update_photo[] = $Create_controller->ajax_update_photo($tables,$row[Field], $row[Type]);
                    }
                    
                $ajax_update_body_end = $Create_controller->ajax_update_body_end();

                $ajax_update_end = $Create_controller->ajax_update_end($tables);

                $ajax_delete_start = $Create_controller->ajax_delete_start($tables);
                    while($row = $this->fetch_array($delete_tupla[$i]))
                    {
                        $ajax_delete[] = $Create_controller->ajax_delete_body($tables,$row[Field], $row[Type]);
                    }
                $ajax_delete_end = $Create_controller->ajax_delete_end($tables);
                // run to load image
                //$ajax__do_upload = $Create_controller->ajax__do_upload();

                $ajax__validate_start = $Create_controller->ajax__validate_start();
                while($row = $this->fetch_array($upload[$i]))
                {
                    $ajax_upload[] = $Create_controller->ajax__do_upload($row[Type]);
                    $ajax_validate_tupla[] = $Create_controller->ajax__validate_body($row[Field], $row[Type],$row[Key]);
                }
                $ajax__validate_end = $Create_controller->ajax__validate_end();


                    
            $class_end = $Create_controller->class_end();
            
            $list_datatable = implode($tupla);
            $edit_datatable = implode($edit_date);
            $add_datatable = implode($add);
            $ajax_add_phot = implode($ajax_add);
            $ajax_update_phot = implode($ajax_update);
            $ajax_remove_phot = implode($ajax_remove);
            $ajax_update_photos = implode($ajax_update_photo);
            $ajax_delete_photo = implode($ajax_delete);
            $ajax__do_upload =implode($ajax_upload);
            $ajax__validate_body = implode($ajax_validate_tupla);

            $union = "<?php
{$basepath}
{$class_start}
    {$construct}
    {$index}
    {$ajax_list_start}
    {$list_datatable}
    {$ajax_list_end}
    {$ajax_edit_start}
        {$edit_datatable}
    {$ajax_edit_end}
    {$ajax_add_start}
        {$add_datatable}
        {$ajax_add_body_end}
        {$ajax_add_phot}
    {$ajax_add_end}
    {$ajax_update_start}
        {$ajax_update_phot}
        
        {$ajax_update_body_end}
        {$ajax_remove_phot}  
        {$ajax_update_photos}
    {$ajax_update_end}
    {$ajax_delete_start}
        {$ajax_delete_photo}
    {$ajax_delete_end}
    {$ajax__do_upload}
    {$ajax__validate_start}
        {$ajax__validate_body}
    {$ajax__validate_end}

{$class_end}";
            $code = $union;

            $this->create_controller($table, $code);
        }
       
    }
    public function create_controller($table, $controller)
    {
        //$table = $this->ultimo_caracter_delete($table_controller);
        $carpeta_url = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->controller.'';
        $tables = $this->ultimo_caracter_delete($table);
        if (file_exists($carpeta_url)){
            //mkdir($carpeta_url, 0777, true);
           
            $code_controller = $controller;

            $archive_controller = fopen(''.$carpeta_url.'/'.$this->mayuscula($tables).'.php', 'w') or die('error creando fichero!');            

            fputs($archive_controller, $code_controller);
            fclose($archive_controller);
            echo '<p>Exito Archivo creado '.$tables.'</p>';
        }else{
            echo "No se creo el Archivo";
        }

    }

}

$file_creator = new Carpeta();

$file_creator->create_controller_table();

?>