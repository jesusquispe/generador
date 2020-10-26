<?php
include("../model/ConexionBD.php");
include("../datatable_model/form/Dt_view_table.php");

class Carpeta extends ConexionBD
{
    public function sms(){
        echo "hello jesus";
    }
    
}

$file_creator = new Carpeta();

$file_creator->sms();
?>
