<?php
include("../../model/ConexionBD.php");
include("../../model/table/Table_body.php");
include("form/Form_body.php");
include("model/Create_model.php");
include("controller/Create_controller.php");
include("javascript/Create_javascript.php");

class Carpeta extends ConexionBD
{
    private $admin = "admin/forms";
    private $model = "admin/models";
    private $controller = "admin/controllers";
    private $javascript = "admin/javascript";


    //colocar el primer valor mayuscala
    public function mayuscula($val)
    {
        return ucfirst($val);
    }

    public function table_html()
    {
        $table_html =  new Table_body();

        $array_num = count($this->consulta_tablas());
        
        for($i=0; $i<$array_num;++$i)
        {
            $thead = array();
            $tbody = array();
            $tfoot = array();
            $table=$this->consulta_tablas()[$i];
            $table_thead_th[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $table_thead_td[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');
            $table_thead_foot[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');

            $cart_star =  $table_html->inicio_card($table);

            $table_start = $table_html->incio_body_table();
                $thead_start = $table_html->inicio_body_table_thead();
                    while ($row = $this->fetch_array($table_thead_th[$i]))
                    {
                        $thead[] = $table_html->menu_body_table_thead($row[Field]);
                    }
                $thead_end = $table_html->fin_body_table_thead();
                $tbody_start = $table_html->inicio_body_table_tbody();
                    while ($row = $this->fetch_array($table_thead_td[$i]))
                    {
                        $tbody[] = $table_html->menu_body_table_tbody($row[Field]);
                    }
                $tbody_end = $table_html->fin_body_table_tbody();
                $tfoot_start = $table_html->inicio_body_table_tfoot();
                    while ($row = $this->fetch_array($table_thead_foot[$i]))
                    {
                        $tfoot[] = $table_html->menu_body_table_tfoot($row[Field]);
                    }
                $tfoot_end = $table_html->fin_body_table_tfoot();

            $table_end = $table_html->fin_body_table();
            $paginate = $table_html->paginate();
        $cart_end =  $table_html->fin_card();

        $th = implode($thead);
        $td = implode($tbody);
        $th_foot = implode($tfoot);

        $union = "  {$cart_star}
                        {$table_start}
                            {$thead_start}
                                {$th}
                            {$thead_end}
                            {$tbody_start}
                                {$td}
                            {$tbody_end}
                            {$tfoot_start}
                                {$th_foot}
                            {$tfoot_end}
                        {$table_end}
                        {$paginate}
                    {$cart_end}";
        //$union = $cart_star.$table_start.$thead_start.$th.$thead_end.$table_end.$cart_end;
        $html =$union;

        $this->create_table_php($table, $html);
        }
    //echo "Formulario de tablas";

    }

    public function form_html()
    {
        
        $form_html = new Form_body();

        $array_num_form = count($this->consulta_tablas());
        
        for($i = 0; $i < $array_num_form; ++$i)
        {
            $input =array();
           $table=$this->consulta_tablas()[$i];

            $form_model_thead[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');           

            $start_modal_content = $form_html->inicio_modal_content($table);

            $header = $form_html->form_header($table);

            $start_body = $form_html->inicio_body();

            while ($row = $this->fetch_array($form_model_thead[$i])) 
            {
                $input[] = $form_html->form_input($row[Field]);
                
            }

            $end_body = $form_html->fin_body();

            $foot = $form_html->form_footer();

            $end_modal_content = $form_html->fin_modal_content();
            $input_html = implode($input);
            $union = "
                    {$start_modal_content}
                        {$header}
                        {$start_body}
                            {$input_html}
                        {$end_body}
                        {$foot}
                    {$end_modal_content}";
            $html = $union;
            
        $this->create_form_php($table,$html);

        }

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

    public function create_table_php($tabla, $html)
    {
        $carpeta_url = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->admin.'/'.$tabla.'';
        //$carpeta_url_ = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->admin.'/'.$tabla.'';
        $carpeta = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->admin.'/'.$tabla.'';

        if (!file_exists($carpeta_url)){
            mkdir($carpeta_url, 0777, true);

            $formulario_table = $html;

            $form_table = fopen(''.$carpeta_url.'/index.php', 'w') or die('error creando fichero!');            

            fputs($form_table, $formulario_table);
            fclose($form_table);
            echo 'Exito Carpeta creada '.$tabla;

        }else if($carpeta_url==$carpeta){
            echo '<p>La carpeta '.$tabla.' ya existe</p>';
        }else{
            //echo '<p>Error '.$tabla.'</p>'.$carpeta_url."<br>";
            echo '<p>Error '.$tabla.'</p>';
        }
    }
    //public function create_form_php($tabla, $html)
    public function create_form_php($tabla,$html)
    {
        
        $carpeta_url = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->admin.'/'.$tabla.'';        
        $carpeta = 'C:/AppServ/www/'.$this->name_folder.'/'.$this->admin.'/'.$tabla.'';

        if (!file_exists($carpeta_url)){
            mkdir($carpeta_url, 0777, true);

            $formulario_table = $html;

            $form_table = fopen(''.$carpeta_url.'/index.php', 'w') or die('error creando fichero!');            

            fputs($form_table, $formulario_table);
            fclose($form_table);
            echo 'Exito Carpeta creada '.$tabla;

        }else if($carpeta_url==$carpeta){

            $formulario_table = $html;

            $form_table = fopen(''.$carpeta_url.'/form.php', 'w') or die('error creando fichero!');            

            fputs($form_table, $formulario_table);
            fclose($form_table);
            echo 'Exito Archivo creada '.$tabla.'<br>';

        }else{
            echo '<p>Error '.$tabla.'</p>'.$carpeta_url."<br>";
            
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
            echo 'Exito Archivo creada '.$tabla;
        }else{
            echo "No se creo el Archivo";
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
            echo 'Exito Archivo creada '.$tabla;
        }else{
            echo "No se creo el Archivo";
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
            echo 'Exito Archivo creada '.$tabla;
        }else{
            echo "No se creo el Archivo";
        }
    }
  
	
}

?>