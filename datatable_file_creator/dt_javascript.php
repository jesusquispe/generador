<?php
include("../model/ConexionBD.php");

include("../datatable_model/javascript/Create_javascript.php");

class Carpeta extends ConexionBD
{
    private $javascript = "datatable_admin/javascript";

    //colocar el primer valor mayuscala
    public function mayuscula($val)
    {
        return ucfirst($val);
    }

    public function ultimo_caracter_delete($caracter)
    {
        return substr($caracter, 0, -1);
    }
    public function create_javascript_table()
    {
        $create_javascript = new Create_javascript();
        $array_num_form = count($this->consulta_tablas());

        for($i = 0; $i < $array_num_form; ++$i)
        {
            $tupla =array();
            $photo =array();

            $table=$this->consulta_tablas()[$i];

            $lista_tupla[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $lista_photo[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');

            $tables = $this->ultimo_caracter_delete($table);

            $script_start = $create_javascript->script_start();
            $variable = $create_javascript->variable();
            $ready_body = $create_javascript->ready_body($tables);
            $javascript_add_body = $create_javascript->javascript_add_body($tables);
            $javascript_edit_start = $create_javascript->javascript_edit_start($tables);
                while($row = $this->fetch_array($lista_tupla[$i]))
                {
                    $tupla[] = $create_javascript->javascript_edit_body($row[Field], $row[Type],$row[Key]);
                }
                $javascript_modal = $create_javascript->javascript_modal($tables);
                while($row = $this->fetch_array($lista_photo[$i])){
                    $photo[] = $create_javascript->javascript_photos($row[Field], $row[Type],$row[Key]);
                }

            $javascript_edit_end = $create_javascript->javascript_edit_end();

            $javascript_reload_table = $create_javascript->javascript_reload_table();
            
            $javascript_save_body = $create_javascript->javascript_save_body($tables);
            $javascript_delete = $create_javascript->javascript_delete($tables);
            
            $script_end = $create_javascript->script_end();

            $ajax_tupla = implode($tupla);
            $ajax_photo = implode($photo);
            
            $union = "{$script_start}
{$variable}
{$ready_body}
{$javascript_add_body}
{$javascript_edit_start}
    {$ajax_tupla}
    {$javascript_modal}
    {$ajax_photo}
{$javascript_edit_end}
{$javascript_reload_table}
{$javascript_save_body}
{$javascript_delete}
{$script_end}";
            $code = $union;
            $this->create_javascript($table, $code);
        }
        

    }
    public function create_javascript($table, $javascript)
    {
        $carpeta_url = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->javascript.'';
        if (file_exists($carpeta_url)){
            //mkdir($carpeta_url, 0777, true);
           
            $formulario_table = $javascript;

            $form_table = fopen(''.$carpeta_url.'/js-'.$this->mayuscula($table).'.php', 'w') or die('error creando fichero!');            

            fputs($form_table, $formulario_table);
            fclose($form_table);
            echo '<p>Exito Archivo creado JavaScript '.$table.'</p>';
        }else{
            echo "No se creo el Archivo";
        }
    }     

}
$file_creator = new Carpeta();

$file_creator->create_javascript_table();
?>