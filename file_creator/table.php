<?php
include("../model/ConexionBD.php");

include("../model/table/Table_body.php");

class Carpeta extends ConexionBD
{
    private $admin = "admin/forms";
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
}

$file_creator = new Carpeta();

echo $file_creator->table_html();
?>