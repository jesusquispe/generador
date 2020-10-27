<?php
include("../model/ConexionBD.php");
include("../datatable_model/form/Dt_view_table.php");

class Carpeta extends ConexionBD
{
    private $admin = "datatable_admin/forms";

    public function mayuscula($val)
    {
        return ucfirst($val);
    }

    public function table_html()
    {
        $table_html =  new Dt_view_table();
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

            $button_add = $table_html->button_modal_add($table);
            $button_reload = $table_html->button_modal_Reload($table);

            $table_start = $table_html->table_start();
                $table_thead_start = $table_html->thead_start();
                    $table_th_start = $table_html->thead_body_piece_start();
                        while($row = $this->fetch_array($table_thead_th[$i])){
                            $thead[] = $table_html->thead_th_body($row[Field]);
                        }
                    $tabel_th_end = $table_html->thead_body_piece_end();
                $table_thead_end = $table_html->thead_end();
                $tbody_start = $table_html->tbody_start();
                        
                $tbody_end = $table_html->tbody_end();
                $tfoot_start = $table_html->tfoot_start();
                    $tfoot_th_start = $table_html->tfoot_body_piece_start();
                    while($row = $this->fetch_array($table_thead_foot[$i])){
                        $tfoot[] = $table_html->tfoot_th_body($row[Field]);
                    }
                    $tfoot_th_end = $table_html->tfoot_body_piece_end();
                $tfoot_end = $table_html->tfoot_end();
            $table_end =$table_html->table_end();
            

            $th = implode($thead);
            $th_foot = implode($tfoot);
            $union = "
                    {$button_add}
                    {$button_reload}
                    {$table_start}
                        {$table_thead_start}
                            {$table_th_start}
                            {$th}
                            {$tabel_th_end}
                        {$table_thead_end}
                        {$tbody_start}
                        {$tbody_end}
                        {$tfoot_start}
                            {$tfoot_th_start}
                            {$th_foot}
                            {$tfoot_th_end}
                        {$tfoot_end}
                    {$table_end}";
            $html =$union;
            $this->create_table_php($table, $html);

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
            echo '<p>Exito Carpeta creada Data table '.$tabla.'</p>';

        }else if($carpeta_url==$carpeta){
            //echo '<p>La carpeta '.$tabla.' ya existe</p>';
            $formulario_table = $html;

            $form_table = fopen(''.$carpeta_url.'/index.php', 'w') or die('error creando fichero!');            

            fputs($form_table, $formulario_table);
            fclose($form_table);
            echo '<p>Exito Archivo creado '.$tabla.'</p>';
            
        }else{
            //echo '<p>Error '.$tabla.'</p>'.$carpeta_url."<br>";
            echo '<p>Error '.$tabla.'</p>';
        }
    }

    public function sms(){
        echo "hello jesus";
    }
    
}

$file_creator = new Carpeta();

$file_creator->table_html();
?>
