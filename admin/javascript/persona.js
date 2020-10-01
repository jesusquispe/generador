  
                        
        $(document).on("click","#add",function(e){
            e.preventDefault();
                        
            var img = $("#img").val();
            var nombre = $("#nombre").val();
            var primer_apellido = $("#primer_apellido").val();
            var segundo_apellido = $("#segundo_apellido").val();
            var carnet_idetidad = $("#carnet_idetidad").val();
            var direccion = $("#direccion").val();
            var telefono = $("#telefono").val();
            var cel = $("#cel").val();
            var email = $("#email").val();
                        
        $.ajax({
            url: 'http://localhost/mini-interal/index.php/Admin/insert',
            type: 'POST',
            dataType: 'json',
            data: {
                        
            img: img,
            nombre: nombre,
            primer_apellido: primer_apellido,
            segundo_apellido: segundo_apellido,
            carnet_idetidad: carnet_idetidad,
            direccion: direccion,
            telefono: telefono,
            cel: cel,
            email: email,
                        
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
                        
                    tbody += "<td>"+ data[key]['img']+"</td>";
                    tbody += "<td>"+ data[key]['nombre']+"</td>";
                    tbody += "<td>"+ data[key]['primer_apellido']+"</td>";
                    tbody += "<td>"+ data[key]['segundo_apellido']+"</td>";
                    tbody += "<td>"+ data[key]['carnet_idetidad']+"</td>";
                    tbody += "<td>"+ data[key]['direccion']+"</td>";
                    tbody += "<td>"+ data[key]['telefono']+"</td>";
                    tbody += "<td>"+ data[key]['cel']+"</td>";
                    tbody += "<td>"+ data[key]['email']+"</td>";
                        
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
                        
                $("#edit_modal_id").val(data.post.id);$("#edit_img").val(data.post.img);
                $("#edit_nombre").val(data.post.nombre);
                $("#edit_primer_apellido").val(data.post.primer_apellido);
                $("#edit_segundo_apellido").val(data.post.segundo_apellido);
                $("#edit_carnet_idetidad").val(data.post.carnet_idetidad);
                $("#edit_direccion").val(data.post.direccion);
                $("#edit_telefono").val(data.post.telefono);
                $("#edit_cel").val(data.post.cel);
                $("#edit_email").val(data.post.email);
                
                        
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
            var edit_img = $("#edit_img").val();
            var edit_nombre = $("#edit_nombre").val();
            var edit_primer_apellido = $("#edit_primer_apellido").val();
            var edit_segundo_apellido = $("#edit_segundo_apellido").val();
            var edit_carnet_idetidad = $("#edit_carnet_idetidad").val();
            var edit_direccion = $("#edit_direccion").val();
            var edit_telefono = $("#edit_telefono").val();
            var edit_cel = $("#edit_cel").val();
            var edit_email = $("#edit_email").val();
                        
                if(edit_id == "" || edit_img == "" || edit_nombre == "" || edit_primer_apellido == "" || edit_segundo_apellido == "" || edit_carnet_idetidad == "" || edit_direccion == "" || edit_telefono == "" || edit_cel == "" || edit_email == "" || ){
                    alert("all fiel is required");
                }else{
                            
                    $.ajax({
                    url: 'http://localhost/mini-interal/index.php/Admin/update',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                            
                    edit_id: edit_id,    
                    edit_img: edit_img,    
                    edit_nombre: edit_nombre,    
                    edit_primer_apellido: edit_primer_apellido,    
                    edit_segundo_apellido: edit_segundo_apellido,    
                    edit_carnet_idetidad: edit_carnet_idetidad,    
                    edit_direccion: edit_direccion,    
                    edit_telefono: edit_telefono,    
                    edit_cel: edit_cel,    
                    edit_email: edit_email,
                        
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
                        