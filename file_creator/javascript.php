<?php

include("../model/ConexionBD.php");

include("../model/javascript/Create_javascript.php");

class Carpeta extends ConexionBD
{
    private $javascript = "admin/javascript";

    //colocar el primer valor mayuscala
    public function mayuscula($val)
    {
        return ucfirst($val);
    }

    public function create_javascript_code()
    {
        $javascript = new Create_javascript();
        //echo $javascript->start_javascript();
        //echo $javascript->end_javascript();
        

        $array_num_form = count($this->consulta_tablas());
        
        for($i = 0; $i < $array_num_form; ++$i)
        {
            $var_insert_javascript = array();
            $data_insert_javascript = array();
            //-----------------------lista-------------------------------------------
            $lista_javascript = array();
            //-----------------------Edit--------------------------------------------
            $editar_javascript = array();
            //------------------------Update-----------------------------------------
            $update_var_javascript = array();
            $update_codicion_javascript = array();
            $update_data_javascript = array();


            $table=$this->consulta_tablas()[$i];

            $var_javascript[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $data_javascript[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            //----------------------------lista-------------------------------------------
            $list_javascript[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            //----------------------------Edit--------------------------------------------
            $edit_javascript[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            //-----------------------------update-----------------------------------------
            $var_update_javascript[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $condicion_update_javascript[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $data_update_javascript[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');

            //$start_javascript = $javascript->start_javascript();

            $start_insert_javascript = $javascript->start_insert_javascript();
            while($row = $this->fetch_array($var_javascript[$i]))
            {
                $var_insert_javascript[] = $javascript->var_insert_javascript($row[Field]);
            }
            $ajax_insert_javascript = $javascript->ajax_insert_javascript();
            while($row = $this->fetch_array($data_javascript[$i]))
            {
                $data_insert_javascript[] = $javascript->data_insert_javascript($row[Field]);
            }
            $end_insert_javascript = $javascript->end_insert_javascript();

            //$end_javascript = $javascript->end_javascript();
            //---------------------------------------------------------
            //------------------lista--------------------------------
            $start_list = $javascript->start_list();
            while($row = $this->fetch_array($list_javascript[$i]))
            {
                $lista_javascript[] = $javascript->menu_list($row[Field]);
            }
            $end_list = $javascript->end_list();
            //---------------------------------------------------------
            //--------------------eliminar------------------------------
            $delete =  $javascript->delete();
            //---------------------------------------------------------
            //-----------------Edit------------------------------------
            $start_edit = $javascript->start_edit();
            while($row = $this->fetch_array($edit_javascript[$i]))
            {
                $editar_javascript[] = $javascript->menu_edit($row[Field]);
            }
            $end_edit = $javascript->end_edit();
            //---------------------------------------------------------
            //------------------Update----------------------------------
            $start_update = $javascript->start_update();
            while($row = $this->fetch_array($var_update_javascript[$i]))
            {
                $update_var_javascript[] = $javascript->var_update($row[Field]);
            }
            $start_condicion = $javascript->start_condicion();
            while($row = $this->fetch_array($condicion_update_javascript[$i]))
            {
                $update_codicion_javascript[] = $javascript->start_condicion_var($row[Field]);
            }
            $end_condicion_var = $javascript->end_condicion_var();
            while($row = $this->fetch_array($data_update_javascript[$i]))
            {
                $update_data_javascript[] = $javascript->data_update($row[Field]);
            }
            $end_update = $javascript->end_update();


            //-------------------------------------------------------
            $var = implode($var_insert_javascript);
            $data = implode($data_insert_javascript);
            //----------------lista-----------------------------
            $lista = implode($lista_javascript);
            //-----------------Editar-------------------
            $edit = implode($editar_javascript);
            //----------------update-------------------
            $var_update = implode($update_var_javascript);
            $condicion_update = implode($update_codicion_javascript);
            $data_update = implode($update_data_javascript);

            $union = "  
                        {$start_insert_javascript}
                        {$var}
                        {$ajax_insert_javascript}
                        {$data}
                        {$end_insert_javascript}

                        {$start_list}
                        {$lista}
                        {$end_list}

                        {$delete}

                        {$start_edit}
                        {$edit}
                        {$end_edit}

                        {$start_update}
                        {$var_update}
                        {$start_condicion}{$condicion_update}{$end_condicion_var}
                        {$data_update}
                        {$end_update}
                        ";
           
            $code = $union;
            $this->create_javascript($table, $code);

        }
       
    }

    public function create_javascript($table, $code_js)
    {
        $carpeta_url = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->javascript.'';
        if (file_exists($carpeta_url)){
            //mkdir($carpeta_url, 0777, true);
           
            $code_javascript = $code_js;

            $archive_javascript = fopen(''.$carpeta_url.'/'.$table.'.js', 'w') or die('error creando fichero!');            

            fputs($archive_javascript, $code_javascript);
            fclose($archive_javascript);
            echo '<p>Exito Archivo creada '.$table.'</p>';
        }else{
            echo "No se creo el Archivo";
        }
    }
}

$file_creator = new Carpeta();

$file_creator->create_javascript_code();
?>