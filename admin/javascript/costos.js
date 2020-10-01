  
                        
        $(document).on("click","#add",function(e){
            e.preventDefault();
                        
            var velocidades_id = $("#velocidades_id").val();
            var servicio = $("#servicio").val();
            var bajada = $("#bajada").val();
            var subida = $("#subida").val();
            var costo = $("#costo").val();
            var costo_instalacion = $("#costo_instalacion").val();
            var estado = $("#estado").val();
                        
        $.ajax({
            url: 'http://localhost/mini-interal/index.php/Admin/insert',
            type: 'POST',
            dataType: 'json',
            data: {
                        
            velocidades_id: velocidades_id,
            servicio: servicio,
            bajada: bajada,
            subida: subida,
            costo: costo,
            costo_instalacion: costo_instalacion,
            estado: estado,
                        
                },
                success: function(data) {
                console.log(data);
                fetch();
                $('#exampleModal').modal('hide');
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
        

                        
        function fetch(){
            $.ajax({
                url: 'http://localhost/mini-interal/index.php/Admin/fetch',
                type: 'POST',
                dataType: 'json',
                success: function(data){
                //console.log(data);
                var tbody = "";
                var i = "1";
                for(var key in data){
                    tbody += "<tr>"
                    tbody += "<td>"+ i++ +"</td>";
                        
                    tbody += "<td>"+ data[key]['velocidades_id']+"</td>";
                    tbody += "<td>"+ data[key]['servicio']+"</td>";
                    tbody += "<td>"+ data[key]['bajada']+"</td>";
                    tbody += "<td>"+ data[key]['subida']+"</td>";
                    tbody += "<td>"+ data[key]['costo']+"</td>";
                    tbody += "<td>"+ data[key]['costo_instalacion']+"</td>";
                    tbody += "<td>"+ data[key]['estado']+"</td>";
                        
                    tbody += `<td>
                                <a href="#" id="del" value="${data[key]['id']}">Delete</a>
                                <a href="#" id="edit" value="${data[key]['id']}">Edit</a>
                            </td>`;
                    tbody += "</tr>"
                        }
                        $("#tbody").html(tbody);
                    }
                    });
                }
                fetch();

                        
        $(document).on("click", "#del", function(e){
            e.preventDefault();
            var del_id = $(this).attr("value");
            if(del_id == ""){
              alert("delete id required");
            }else{
      //-------------------------------------------------
      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-2'
      },
      buttonsStyling: false
    })
    
    swalWithBootstrapButtons.fire({
      title: 'Estas segura ?',
      text: "No podrás revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si, bórralo!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
    
          $.ajax({
            url: 'http://localhost/mini-interal/index.php/Admin/delete',
            type: 'POST',
            dataType: 'json',
            data: {
              del_id: del_id
            },
            success: function(data){
              fetch();
              //console.log(data);
              if(data.reponce=="success"){
                swalWithBootstrapButtons.fire(
                    'Eliminada!',
                    'Su archivo ha sido eliminado.',
                    'success'
                  )
              }
            }
          });
    
        
      } else if (
       //  Read more about handling dismissals below 
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelada',
          'Tu archivo imaginario está seguro :)',
          'error'
        )
      }
    });
      //-------------------------------------------------
            }
          });

                        
        $(document).on("click","#edit",function(e){
            e.preventDefault();
    
            var edit_id = $(this).attr("value");
            if(edit_id==""){
              alert("Edit id required")
            }else{
              $.ajax({
                url: 'http://localhost/mini-interal/index.php/Admin/edit',
                type: 'POST',
                dataType: 'json',
                data: {
                  edit_id: edit_id
                },
                success: function(data){
                  
                  //console.log(data);
                  if(data.responce == "success"){
                    $('#editModal').modal('show');
                        
                $("#edit_modal_id").val(data.post.id);$("#edit_velocidades_id").val(data.post.velocidades_id);
                $("#edit_servicio").val(data.post.servicio);
                $("#edit_bajada").val(data.post.bajada);
                $("#edit_subida").val(data.post.subida);
                $("#edit_costo").val(data.post.costo);
                $("#edit_costo_instalacion").val(data.post.costo_instalacion);
                $("#edit_estado").val(data.post.estado);
                
                        
                    }
                    else{
                    toastr["error"](data.message);
                    alert(data.message);
                    $('#editModal').modal('hide');
                    
                    }
                }
                });
            }
            });

                        
            $(document).on("click","#update", function(e){
            e.preventDefault();
                        
            var edit_id = $("#edit_modal_id").val();
            var edit_velocidades_id = $("#edit_velocidades_id").val();
            var edit_servicio = $("#edit_servicio").val();
            var edit_bajada = $("#edit_bajada").val();
            var edit_subida = $("#edit_subida").val();
            var edit_costo = $("#edit_costo").val();
            var edit_costo_instalacion = $("#edit_costo_instalacion").val();
            var edit_estado = $("#edit_estado").val();
                        
                if(edit_id == "" || edit_velocidades_id == "" || edit_servicio == "" || edit_bajada == "" || edit_subida == "" || edit_costo == "" || edit_costo_instalacion == "" || edit_estado == "" || ){
                    alert("all fiel is required");
                }else{
                            
                    $.ajax({
                    url: 'http://localhost/mini-interal/index.php/Admin/update',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                            
                    edit_id: edit_id,    
                    edit_velocidades_id: edit_velocidades_id,    
                    edit_servicio: edit_servicio,    
                    edit_bajada: edit_bajada,    
                    edit_subida: edit_subida,    
                    edit_costo: edit_costo,    
                    edit_costo_instalacion: edit_costo_instalacion,    
                    edit_estado: edit_estado,
                        
                        },
                        success: function(data){
                        fetch();
                            if(data.responce == "success"){
                                alert(data.message);
                                $('#editModal').modal('hide');
                            }else{
                                alert(data.message);
                            }
                        }
                    });
                    }

                });
                        