  
                        
        $(document).on("click","#add",function(e){
            e.preventDefault();
                        
            var nombres = $("#nombres").val();
            var apellidos = $("#apellidos").val();
            var telefono = $("#telefono").val();
            var email = $("#email").val();
            var username = $("#username").val();
            var password = $("#password").val();
            var rol_id = $("#rol_id").val();
            var estado = $("#estado").val();
                        
        $.ajax({
            url: 'http://localhost/mini-interal/index.php/Admin/insert',
            type: 'POST',
            dataType: 'json',
            data: {
                        
            nombres: nombres,
            apellidos: apellidos,
            telefono: telefono,
            email: email,
            username: username,
            password: password,
            rol_id: rol_id,
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
                        
                    tbody += "<td>"+ data[key]['nombres']+"</td>";
                    tbody += "<td>"+ data[key]['apellidos']+"</td>";
                    tbody += "<td>"+ data[key]['telefono']+"</td>";
                    tbody += "<td>"+ data[key]['email']+"</td>";
                    tbody += "<td>"+ data[key]['username']+"</td>";
                    tbody += "<td>"+ data[key]['password']+"</td>";
                    tbody += "<td>"+ data[key]['rol_id']+"</td>";
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
                        
                $("#edit_modal_id").val(data.post.id);$("#edit_nombres").val(data.post.nombres);
                $("#edit_apellidos").val(data.post.apellidos);
                $("#edit_telefono").val(data.post.telefono);
                $("#edit_email").val(data.post.email);
                $("#edit_username").val(data.post.username);
                $("#edit_password").val(data.post.password);
                $("#edit_rol_id").val(data.post.rol_id);
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
            var edit_nombres = $("#edit_nombres").val();
            var edit_apellidos = $("#edit_apellidos").val();
            var edit_telefono = $("#edit_telefono").val();
            var edit_email = $("#edit_email").val();
            var edit_username = $("#edit_username").val();
            var edit_password = $("#edit_password").val();
            var edit_rol_id = $("#edit_rol_id").val();
            var edit_estado = $("#edit_estado").val();
                        
                if(edit_id == "" || edit_nombres == "" || edit_apellidos == "" || edit_telefono == "" || edit_email == "" || edit_username == "" || edit_password == "" || edit_rol_id == "" || edit_estado == "" || ){
                    alert("all fiel is required");
                }else{
                            
                    $.ajax({
                    url: 'http://localhost/mini-interal/index.php/Admin/update',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                            
                    edit_id: edit_id,    
                    edit_nombres: edit_nombres,    
                    edit_apellidos: edit_apellidos,    
                    edit_telefono: edit_telefono,    
                    edit_email: edit_email,    
                    edit_username: edit_username,    
                    edit_password: edit_password,    
                    edit_rol_id: edit_rol_id,    
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
                        