<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<?php

include("model/ConexionBD.php");
include("model/formsp/Form.php");
include("model/formsp/Formbody.php");
include("model/formsp/Formheader.php");
include("model/formsp/Formfooter.php");
include("model/formsp/Formmodalcontent.php");
include("model/Carpeta.php");


//include("model/controller/Create_controller.php");
//include("model/javascript/Create_javascript.php");



include("model/table/Table_body.php");


$con = new ConexionBD();


$form_inpur = new Form();
$form_body =  new Formbody();
$Formheader = new Formheader();
$Formfooter = new Formfooter();
$Formmodalcontent = new Formmodalcontent();

$Carpeta = new Carpeta();

$table_body = new Table_body();

//$Create_controller = new Create_controller();

//print_r($con->consulta_tablas());



$array_num = count($con->consulta_tablas());

//echo $Carpeta->table_html();

//echo $Carpeta->form_html();
echo $Carpeta->create_model_table();
echo $Carpeta->create_controller_code();
//echo $Carpeta->create_javascript_code();

echo '<div class="container">';
for($i = 0; $i < $array_num; ++$i){	
	//echo $con->consulta_tablas()[$i]."<br/>";


//------------------------------------------------------------------------------------
$menu=$con->consulta_tablas()[$i];

$table_thead_th[$i] = $con->consulta('SHOW COLUMNS FROM '.$menu.'');
$table_thead_td[$i] = $con->consulta('SHOW COLUMNS FROM '.$menu.'');
$table_thead_foot[$i] = $con->consulta('SHOW COLUMNS FROM '.$menu.'');

//echo $Carpeta->create_form_php($menu);

/*
$carpeta = 'C:/AppServ/www/generador/admin/'.$menu.'';	
if(!file_exists($carpeta)){			
	mkdir($carpeta, 0777, true);
	
	$fomrulario = $carpeta;

	$fp = fopen(''.$carpeta.'/fichero.html', 'w') or die('error creando fichero!');

	fputs($fp,$fomrulario);

	fclose($fp);

}

else{
	echo "Error";
}*/



//-------------------------------inicio table------------------------------------


echo $table_body->inicio_card($menu);

	echo $table_body->incio_body_table();

		echo $table_body->inicio_body_table_thead();

		while ($row = $con->fetch_array($table_thead_th[$i]))
		{
			echo $table_body->menu_body_table_thead($row[Field]);
		}
		echo $table_body->fin_body_table_thead();

		echo $table_body->inicio_body_table_tbody();


		while ($row = $con->fetch_array($table_thead_td[$i]))
		{
			echo $table_body->menu_body_table_tbody($row[Field]);
		}
		echo $table_body->fin_body_table_tbody();

		echo $table_body->inicio_body_table_tfoot();

		while ($row = $con->fetch_array($table_thead_foot[$i]))
		{
			echo $table_body->menu_body_table_tfoot($row[Field]);
		}
		echo $table_body->fin_body_table_tfoot();

	echo $table_body->fin_body_table();

echo $table_body->fin_card();

}
//-------------------------------fin table------------------------------------
//-------------------------Inicio de formulario------------------------------------------

$array_num_form = count($con->consulta_tablas());

for($i = 0; $i < $array_num_form; ++$i){	

$menu=$con->consulta_tablas()[$i];

$form_model_thead[$i] = $con->consulta('SHOW COLUMNS FROM '.$menu.'');

	echo $Formmodalcontent->inicio_modal_content($menu);

	echo $Formheader->form_header($menu);

	echo $form_body->inicio_body();

	while ($row = $con->fetch_array($form_model_thead[$i])) 
	{
		echo $form_inpur->form_input($row[Field]);
		
	}

	echo $form_body->fin_body();

	echo $Formfooter->form_footer();

	echo $Formmodalcontent->inicio_modal_content();

}
//-----------------fin del formulario---------------------------------------------------
	echo '</div>';


//------------------------------------------------------------------------------------
?>