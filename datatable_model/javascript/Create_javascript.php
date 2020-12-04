<?php
//include("../../datatable_admin/app/Validate.php");
class Create_javascript{
    
    public function script_start()
    {
        return '<script type="text/javascript">';
    }
    public function script_end()
    {
        return '</script>';
    }

    public function variable()
    {
        return '
        var save_method; //for save method string
        var table;
        var base_url = \'<?php echo base_url();?>\';';
    }

    
    public function ready_body($table)
    {
        return '
        $(document).ready(function() {

            //datatables
            table = $(\'#table\').DataTable({ 
        
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables\' server-side processing mode.
                "order": [], //Initial no order.
        
                // Load data for the table\'s content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url(\''.$table.'/ajax_list\')?>",
                    "type": "POST"
                },
        
                //Set column definition initialisation properties.
                "columnDefs": [
                    { 
                        "targets": [ -1 ], //last column
                        "orderable": false, //set not orderable
                    },
                    { 
                        "targets": [ -2 ], //2 last column (photo)
                        "orderable": false, //set not orderable
                    },
                ],
        
            });
        
            //datepicker
            $(\'.datepicker\').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                todayHighlight: true,
                orientation: "top auto",
                todayBtn: true,
                todayHighlight: true,  
            });
        
            //set input/textarea/select event when change value, remove class error and remove text help block 
            $("input").change(function(){
                $(this).parent().parent().removeClass(\'has-error\');
                $(this).next().empty();
            });
            $("textarea").change(function(){
                $(this).parent().parent().removeClass(\'has-error\');
                $(this).next().empty();
            });
            $("select").change(function(){
                $(this).parent().parent().removeClass(\'has-error\');
                $(this).next().empty();
            });
        
        });';
    }



    public function javascript_add_body($table)
    {
        return '
        function add_'.$table.'()
        {
            save_method = \'add\';
            $(\'#form\')[0].reset(); // reset form on modals
            $(\'.form-group\').removeClass(\'has-error\'); // clear error class
            $(\'.help-block\').empty(); // clear error string
            $(\'#modal_form\').modal(\'show\'); // show bootstrap modal
            $(\'.modal-title\').text(\'Add '.$table.'\'); // Set Title to Bootstrap modal title

            $(\'#photo-preview\').hide(); // hide photo preview modal

            $(\'#label-photo\').text(\'Upload Photo\'); // label photo upload
        }';
    }


    public function javascript_edit_start($table)
    {
        return '
        function edit_'.$table.'(id)
        {
            save_method = \'update\';
            $(\'#form\')[0].reset(); // reset form on modals
            $(\'.form-group\').removeClass(\'has-error\'); // clear error class
            $(\'.help-block\').empty(); // clear error string
        
        
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url(\''.$table.'/ajax_edit\')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {';
    }
    
    public function javascript_edit_body($field, $type, $key)
    {
        if($type != 'varchar(255)'){
            return '
                $(\'[name="'.$field.'"]\').val(data.'.$field.');';
        }
        
    }
    public function javascript_modal($table)
    {
        return '
            $(\'#modal_form\').modal(\'show\'); // show bootstrap modal when complete loaded
            $(\'.modal-title\').text(\'Edit '.$table.'\'); // Set title to Bootstrap modal title';
    }

    public function javascript_photos($field, $type, $key)
    {
        if($type == 'varchar(255)'){
            return '
                $(\'#photo-preview\').show(); // show photo preview modal

                if(data.'.$field.')
                {
                    $(\'#label-photo\').text(\'Change Photo\'); // label photo upload
                    $(\'#photo-preview div\').html(\'<img src="\'+base_url+\'upload/\'+data.'.$field.'+\'" class="img-responsive">\'); // show photo
                    $(\'#photo-preview div\').append(\'<input type="checkbox" name="remove_photo" value="\'+data.'.$field.'+\'"/> Remove photo when saving\'); // remove photo

                }
                else
                {
                    $(\'#label-photo\').text(\'Upload Photo\'); // label photo upload
                    $(\'#photo-preview div\').text(\'(No '.$field.')\');
                }';

        }
        
    }

    public function javascript_edit_end()
    {
        return '        
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(\'Error get data from ajax\');
            }
        });
        }
        ';
    }


    public function javascript_reload_table()
    {
        return '
        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax 
        }
        ';
    }

    

    public function javascript_save_body($table)
    {
        return '
        function save()
        {
            $(\'#btnSave\').text(\'saving...\'); //change button text
            $(\'#btnSave\').attr(\'disabled\',true); //set button disable 
            var url;

            if(save_method == \'add\') {
                url = "<?php echo site_url(\''.$table.'/ajax_add\')?>";
            } else {
                url = "<?php echo site_url(\''.$table.'/ajax_update\')?>";
            }

            // ajax adding data to database

            var formData = new FormData($(\'#form\')[0]);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {

                    if(data.status) //if success close modal and reload ajax table
                    {
                        $(\'#modal_form\').modal(\'hide\');
                        reload_table();
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $(\'[name="\'+data.inputerror[i]+\'"]\').parent().parent().addClass(\'has-error\'); //select parent twice to select div form-group class and add has-error class
                            $(\'[name="\'+data.inputerror[i]+\'"]\').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $(\'#btnSave\').text(\'save\'); //change button text
                    $(\'#btnSave\').attr(\'disabled\',false); //set button enable 


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(\'Error adding / update data\');
                    $(\'#btnSave\').text(\'save\'); //change button text
                    $(\'#btnSave\').attr(\'disabled\',false); //set button enable 

                }
            });
        }';
    }

    public function javascript_delete($table){
        return '
        function delete_'.$table.'(id)
        {
            if(confirm(\'Are you sure delete this data?\'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "<?php echo site_url(\''.$table.'/ajax_delete\')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        $(\'#modal_form\').modal(\'hide\');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert(\'Error deleting data\');
                    }
                });

            }
        }';
    }

}