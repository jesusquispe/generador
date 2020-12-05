<?php
include("../model/ConexionBD.php");

include("../datatable_model/model/Create_model.php");

class Carpeta extends ConexionBD
{
    private $model = "datatable_admin/models";

    public function mayuscula($val)
    {
        return ucfirst($val);
    }
    public function ultimo_caracter($caracter)
    {
        return substr($caracter, 0, -1);
    }

    public function create_model_table()
    {
        $Create_model = new Create_model();
        $array_num_form = count($this->consulta_tablas());

        for($i = 0; $i < $array_num_form; ++$i)
        {

            $order = array();
            $search = array();

            //$table=$this->ultimo_caracter($this->consulta_tablas()[$i]);
            $table=$this->consulta_tablas()[$i];            

            $order_start[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $search_start[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');

            $tables = $this->ultimo_caracter($table);

            $basepath = $Create_model->basepath();
            $class_start = $Create_model->class_start($tables);
            $variable = $Create_model->variable($tables);

            //Ordenar en data datatable desc y asc
            $variable_column_order_start = $Create_model->variable_column_order_start();
            while($row = $this->fetch_array($order_start[$i]))
            {
                $order[] = $Create_model->variable_table_body($row[Field], $row[Type], $row[Key]);
            }
            $variable_order_start_end = $Create_model->variable_table_end();
            //variable de busqueda por start en data table
            $variable_column_search_start = $Create_model->variable_column_search_start();
            while($row = $this->fetch_array($search_start[$i]))
            {
                $search[] = $Create_model->variable_search($row[Field], $row[Type], $row[Key]);
            }
            $variable_search_start_end = $Create_model->variable_table_end();

            $construct = $Create_model->construct();

            $get_datatables_query = $Create_model->get_datatables_query();            
            $get_datatables = $Create_model->get_datatables();
            $count_filtered = $Create_model->count_filtered();
            $count_all = $Create_model->count_all();
            $get_by_id = $Create_model->get_by_id();
            $save = $Create_model->save();
            $update = $Create_model->update();
            $delete_by_id =$Create_model->delete_by_id();

            $class_end = $Create_model->class_end();
            
            $order_datatable = $this->ultimo_caracter(implode($order));
            $search_datatable = $this->ultimo_caracter(implode($search));
            $model = "<?php
{$basepath}
            {$class_start}
            {$variable}
            {$variable_column_order_start}{$order_datatable}{$variable_order_start_end}
            {$variable_column_search_start}{$search_datatable}{$variable_search_start_end}

            {$construct}
            {$get_datatables_query}
            {$get_datatables}
            {$count_filtered}
            {$count_all}
            {$get_by_id}
            {$save}
            {$update}
            {$delete_by_id}

            {$class_end}";
            $union = $model;
            
            $this->create_model_php($table, $union);
        }
    }

    public function create_model_php($table, $model)
    {
        $carpeta_url = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->model.'';
        $tables = $this->ultimo_caracter($table);
        if (file_exists($carpeta_url)){
            //mkdir($carpeta_url, 0777, true);
           
            $formulario_table = $model;

            $form_table = fopen(''.$carpeta_url.'/'.$this->mayuscula($tables).'_model.php', 'w') or die('error creando fichero!');            

            fputs($form_table, $formulario_table);
            fclose($form_table);
            echo '<p>Exito Archivo creado Model '.$table.'</p>';
        }else{
            echo "No se creo el Archivo";
        }
    }
    
}

$file_creator = new Carpeta();

$file_creator->create_model_table();

?>