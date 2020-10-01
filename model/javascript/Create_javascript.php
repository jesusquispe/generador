<?php

include("../ConexionBD.php");
echo "<p>entro pero </p>";
class Create_javascript  extends ConexionBD 
{

    private $url ='http://localhost/mini-interal/';
    public function __construct(){
        return "<h1>Entro</h1>";
    }
//--------------Botonos de instert--------------------------------------------
    public function start_insert_javascript()
    {
        return '
        $(document).on("click","#add",function(e){
            e.preventDefault();';
    }
    public function var_insert_javascript($var)
    {
        if($var != "id"){
            return '
            var '.$var.' = $("#'.$var.'").val();';
        }
        
    }
    public function ajax_insert_javascript()
    {
        return '
        $.ajax({
            url: \''.$this->url.'index.php/Admin/insert\',
            type: \'POST\',
            dataType: \'json\',
            data: {';
    }
    public function data_insert_javascript($var)
    {
        if($var != "id")
        {
            return '
            '.$var.': '.$var.',';
        }
        
    }
    public function end_insert_javascript()
    {
        return '
                },
                success: function(data) {
                console.log(data);
                fetch();
                $(\'#exampleModal\').modal(\'hide\');
                if(data.message == "success"){
                        alert(data.message);
                    }else{
                        alert(data.message);
                    }
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });
        });
        ';
    }

//-----------------------------------------------------------------------------
//----------------------Lista de tabla-----------------------------------------
    public function start_list()
    {
        return '
        function fetch(){
            $.ajax({
                url: \''.$this->url.'index.php/Admin/fetch\',
                type: \'POST\',
                dataType: \'json\',
                success: function(data){
                //console.log(data);
                var tbody = "";
                var i = "1";
                for(var key in data){
                    tbody += "<tr>"
                    tbody += "<td>"+ i++ +"</td>";';
    }
    public function menu_list($var)
    {
        if($var != "id"){
            return '
                    tbody += "<td>"+ data[key][\''.$var.'\']+"</td>";';
        }
        
    }
    public function end_list()
    {
        return '
                    tbody += `<td>
                                <a href="#" id="del" value="${data[key][\'id\']}">Delete</a>
                                <a href="#" id="edit" value="${data[key][\'id\']}">Edit</a>
                            </td>`;
                    tbody += "</tr>"
                        }
                        $("#tbody").html(tbody);
                    }
                    });
                }
                fetch();';
    }
    
//-----------------------------------------------------------------------------
//-----------------------Eliminar Registro-------------------------------------
    public function delete()
    {
        return '
        $(document).on("click", "#del", function(e){
            e.preventDefault();
            var del_id = $(this).attr("value");
            if(del_id == ""){
              alert("delete id required");
            }else{
      //-------------------------------------------------
      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: \'btn btn-success\',
        cancelButton: \'btn btn-danger mr-2\'
      },
      buttonsStyling: false
    })
    
    swalWithBootstrapButtons.fire({
      title: \'Estas segura ?\',
      text: "No podrás revertir esto!",
      icon: \'warning\',
      showCancelButton: true,
      confirmButtonText: \'Si, bórralo!\',
      cancelButtonText: \'No, cancelar!\',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
    
          $.ajax({
            url: \''.$this->url.'index.php/Admin/delete\',
            type: \'POST\',
            dataType: \'json\',
            data: {
              del_id: del_id
            },
            success: function(data){
              fetch();
              //console.log(data);
              if(data.reponce=="success"){
                swalWithBootstrapButtons.fire(
                    \'Eliminada!\',
                    \'Su archivo ha sido eliminado.\',
                    \'success\'
                  )
              }
            }
          });
    
        
      } else if (
       //  Read more about handling dismissals below 
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          \'Cancelada\',
          \'Tu archivo imaginario está seguro :)\',
          \'error\'
        )
      }
    });
      //-------------------------------------------------
            }
          });';
    }
//-----------------------------------------------------------------------------
//---------------------Edit ---------------------------------------------
    public function start_edit()
    {
        return '
        $(document).on("click","#edit",function(e){
            e.preventDefault();
    
            var edit_id = $(this).attr("value");
            if(edit_id==""){
              alert("Edit id required")
            }else{
              $.ajax({
                url: \''.$this->url.'index.php/Admin/edit\',
                type: \'POST\',
                dataType: \'json\',
                data: {
                  edit_id: edit_id
                },
                success: function(data){
                  
                  //console.log(data);
                  if(data.responce == "success"){
                    $(\'#editModal\').modal(\'show\');';
    }
    public function menu_edit($val)
    {
        if($val != "id")
        {
            $input1 = '$("#edit_'.$val.'").val(data.post.'.$val.');';
        }else if($val == "id"){
            $input2 = '$("#edit_modal_'.$val.'").val(data.post.'.$val.');';
        }

        return "{$input1}
                {$input2}";
    }
    public function end_edit()    
    {
        return '
                    }
                    else{
                    toastr["error"](data.message);
                    alert(data.message);
                    $(\'#editModal\').modal(\'hide\');
                    
                    }
                }
                });
            }
            });';
    }
//------------------------------------------------------------------------
//---------------------Update---------------------------------------------
    public function start_update()
    {
        return '
            $(document).on("click","#update", function(e){
            e.preventDefault();';
    }
    public function var_update($var)
    {
        if($var != "id")
        {
            $var_data = '
            var edit_'.$var.' = $("#edit_'.$var.'").val();';
        }else if($var == "id"){
            $var_data = '
            var edit_id = $("#edit_modal_id").val();';
        }
        return $var_data;
    }
    public function start_condicion()
    {
        return '
                if(';
    }
    public function start_condicion_var($var)
    {
        return 'edit_'.$var.' == "" || ';
    }
    public function end_condicion_var()
    {
        return '){
                    alert("all fiel is required");
                }else{
                            
                    $.ajax({
                    url: \''.$this->url.'index.php/Admin/update\',
                    type: \'POST\',
                    dataType: \'json\',
                    data: {';
    }
    public function data_update($var)
    {
        return '    
                    edit_'.$var.': edit_'.$var.',';
    }
    public function end_update()
    {
        return '
                        },
                        success: function(data){
                        fetch();
                            if(data.responce == "success"){
                                alert(data.message);
                                $(\'#editModal\').modal(\'hide\');
                            }else{
                                alert(data.message);
                            }
                        }
                    });
                    }

                });';
    }
//------------------------------------------------------------------------

    public function start_javascript()
    {
    return '
<script type="text/javascript">
$(\'#collapseDiv\').collapse("toggle");';
    }

    public function end_javascript()
    {
    return '
</script>';
    }
}


?>