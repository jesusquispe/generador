<?php

include("../model/ConexionBD.php");
include("../datatable_model/form/Dt_view_form.php");

class Carpeta extends ConexionBD{

    private $admin = "datatable_admin/forms";

    public function mayuscula($val)
    {
        return ucfirst($val);
    }
    
    public function form_html()
    {
        $form_html = new Dt_view_form();

        $array_num_form = count($this->consulta_tablas());

        for($i = 0; $i < $array_num_form; ++$i)
        {
            $input =array();
            $table=$this->consulta_tablas()[$i];

            $form_model_thead[$i] = $this->consulta('SHOW COLUMNS FROM '.$table.'');

            $content_modal_start = $form_html->content_modal_start();
                $header_modal_button = $form_html->header_modal_button();
                    $body_modal_start = $form_html->body_modal_start();
                        $form_start = $form_html->form_start();
                            $input_hidden = $form_html->input_hidden();
                            $form_body_start = $form_html->form_body_start();
                                while($row = $this->fetch_array($form_model_thead[$i])){
                                    $input[] = $form_html->form_group_input($row[Field], $row[Type]);
                                }

                            $form_body_end = $form_html->form_body_end();

                        $form_end = $form_html->form_end();
                    $body_modal_end = $form_html->body_modal_end();

                $footer_modal_button = $form_html->footer_modal();
            $content_modal_end = $form_html->content_modal_end();

            $input_html = implode($input);

            $union = "
                    {$content_modal_start}
                        {$header_modal_button}
                            {$body_modal_start}
                                {$form_start}
                                    {$input_hidden}
                                    {$form_body_start}
                                       {$input_html}
                                    {$form_body_end}

                                {$form_end}
                            {$body_modal_end}

                    {$footer_modal_button}
                    {$content_modal_end}";
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

            $form_table = fopen(''.$carpeta_url.'/form.php', 'w') or die('error creando fichero!');            

            fputs($form_table, $formulario_table);
            fclose($form_table);
            echo '<p>Exito Carpeta creada '.$tabla.'</p>';

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
