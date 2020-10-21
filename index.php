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
                        <button type="submit" class="btn btn-success" id="btn-javascript">JavaScrip</button>
                    </div>
                    <div class="col-md-4 text-center">
                        <!--<button type="submit" class="btn btn-success" id="btn-form">Form</button>-->
                        <a href="#" class="btn btn-success" name="form" id="btn_form" value="1">Llamar al contenido PHP</a>
                        <div id="form_php">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-success" id="btn-controller">Controller</button>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-success" id="btn_script">Model Codeinaiter</button>
                        <div id="js_script">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-success" id="btn_null">Null</button>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-success" id="btn_">:-P</button>
                    </div>
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
    <script type="text/javascript">
        const generar = new Generador();
        eventos();

        function eventos(){
            document.getElementById("btn-javascript").addEventListener("click",function(){
                alert("java script");
            });
            document.getElementById("btn_form").addEventListener("click",function(){
                $("#form_php").load("file_creator/form.php");            
            });

            /* ----------------------------------------------------------- */

            document.getElementById("btn_script").addEventListener("click",function(){
                $("#js_script").load("file_creator/script.php");
            });
           
        }

      		
			
    </script>
  </body>
</html>