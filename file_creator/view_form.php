<?php

include("../model/ConexionBD.php");
include("../model/form/Form_body.php");

class Carpeta extends ConexionBD
{
    private $admin = "admin/forms";

    public function mayuscula($val)
    {
        return ucfirst($val);
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
            echo '<p>Exito Archivo creado '.$tabla.'</p>';

        }else{
            echo '<p>Error '.$tabla.'</p>'.$carpeta_url."";
            
        }
        
    }

   
}

$file_creator = new Carpeta();

$file_creator->form_html();


?>