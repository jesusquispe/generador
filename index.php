<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Hello Generador!</title>
  </head>
  <body>
    <div class="container">
    <br><br>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Generar Codigo</h1>
            </div>
        </div>
        <div class="card">
            <div class="card-body">                
                <div class="row">
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-success" id="btn_view">View Codeinaiter</button>
                        <div id="js_view">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-success" id="btn_model">Model Codeinaiter</button>
                        <div id="js_model">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-success" id="btn_controller">Controller Codeinaiter</button>
                        <div id="js_controller">
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-4 text-center">
                        
                        <a href="#" class="btn btn-success" name="form" id="btn_javascript" value="1">Generation Ajax </a>
                        <div id="js_javascript">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-success" id="btn_table">Table Codeinaiter</button>
                        <div id="js_table">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-success" id="btn_null">:-P</button>
                        <div class="" id="js_null"></div>
                    </div>
                </div>               
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 text-center">
            <h1>Generar Codigo en Data table en Codeinaiter</h1>
            </div>
        </div>
        <div class="card">
            <div class="card-body">                
                <div class="row">
                </div>
            </div>
        </div>
        
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <!-- Generado de crud ajax -->
    <script type="text/javascript">
        const generar = new Generador();
        eventos();

        function eventos(){
            //Generador de formulario
            document.getElementById("btn_view").addEventListener("click",function(){                
                $("#js_view").load("file_creator/view_form.php");
            });
           //Generador de Modelos           
            document.getElementById("btn_model").addEventListener("click",function(){
                $("#js_model").load("file_creator/model.php");
            });
            //Generador de Controladores
            document.getElementById("btn_controller").addEventListener("click",function(){
                $("#js_controller").load("file_creator/controller.php");
            });
            //Generador de Ajax
            document.getElementById("btn_javascript").addEventListener("click",function(){
                $("#js_javascript").load("file_creator/javascript.php");            
            });

            //Generador de tablas
            document.getElementById("btn_table").addEventListener("click",function(){
                $("#js_table").load("file_creator/table.php");            
            });

            //null
            document.getElementById("btn_null").addEventListener("click",function(){
               alert("hellor world");
            });
           
        }

      		
			
    </script>
  </body>
</html>