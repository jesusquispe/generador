  
                        
        $(document).on("click","#add",function(e){
            e.preventDefault();
                        
            var name = $("#name").val();
            var email = $("#email").val();
                        
        $.ajax({
            url: 'http://localhost/mini-interal/index.php/Admin/insert',
            type: 'POST',
            dataType: 'json',
            data: {
                        
            name: name,
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
                        
                    tbody += "<td>"+ data[key]['name']+"</td>";
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
                        
                $("#edit_modal_id").val(data.post.id);$("#edit_name").val(data.post.name);
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
            var edit_name = $("#edit_name").val();
            var edit_email = $("#edit_email").val();
                        
                if(edit_id == "" || edit_name == "" || edit_email == "" || ){
                    alert("all fiel is required");
                }else{
                            
                    $.ajax({
                    url: 'http://localhost/mini-interal/index.php/Admin/update',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                            
                    edit_id: edit_id,    
                    edit_name: edit_name,    
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
                        