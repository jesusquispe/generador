<?php
class Dt_view_form{

    public function content_modal_start()
    {
        return '
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">';
    }

    public function content_modal_end(){
        return '
        </div>
    </div>
</div>';
    }

    public function header_modal_button()
    {
        return '
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>';
    }

    public function body_modal_start()
    {
        return '
            <div class="modal-body form">';
    }
    public function body_modal_end()
    {
        return '
            </div>';
    }
    public function form_start()
    {
        return '
                <form action="#" id="form" class="form-horizontal">';
    }
    public function form_end()
    {
        return '
                </form>';
    }

    public function input_hidden()
    {
        return '
                    <input type="hidden" value="" name="id"/>';
    }
    public function form_body_start()
    {
        return '
                    <div class="form-body">';
    }
    public function form_body_end()
    {
        return '
                    </div>';
    }

    public function form_group_input($name_attribute, $tipo, $key)
    {
        if($tipo == 'varchar(100)')
        {            
            return '
                        <div class="form-group">
                            <label class="control-label col-md-3">'.$name_attribute.'</label>
                            <div class="col-md-9">
                                <input name="'.$name_attribute.'" placeholder="'.$name_attribute.'" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>';
        }else if($tipo == 'date'){
            return '
                        <div class="form-group">
                            <label class="control-label col-md-3">'.$name_attribute.'</label>
                            <div class="col-md-9">
                                <input name="'.$name_attribute.'" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>';

        }else if($tipo == 'varchar(255)')
        {
            return '
                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">'.$name_attribute.'</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo">'.$name_attribute.' </label>
                            <div class="col-md-9">
                                <input name="'.$name_attribute.'" type="file">
                                <span class="help-block"></span>
                            </div>
                        </div>';
        }else if($tipo == 'varchar(255)')
        {
            return '
                        <input type="hidden" value="" name="'.$name_attribute.'"/>';
        }else if($key == 'PRI'){
            return false;
        }else if($tipo == 'int(11)'){
            return '
                        <div class="form-group">
                            <label class="control-label col-md-3">'.$name_attribute.'</label>
                            <div class="col-md-9">
                                <select name="'.$name_attribute.'" class="form-control">
                                    <option value="">--Select '.$name_attribute.'--</option>
                                    <option value="1">uno</option>
                                    <option value="2">dos</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>';
        }
        else{
            return '
                        <div class="form-group">
                            <label class="control-label col-md-3">'.$name_attribute.'</label>
                            <div class="col-md-9">
                                <input name="'.$name_attribute.'" placeholder="'.$name_attribute.'" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>';
        }
       
    }

    public function footer_modal()
    {
        return '
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>';
    }

}
?>