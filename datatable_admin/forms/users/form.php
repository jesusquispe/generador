
                    
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
                        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
                            
            <div class="modal-body form">
                                
                <form action="#" id="form" class="form-horizontal">
                                    
                    <input type="hidden" value="" name="id"/>
                                    
                    <div class="form-body">
                                       
                        <div class="form-group">
                            <label class="control-label col-md-3">persons_id</label>
                            <div class="col-md-9">
                                <select name="persons_id" class="form-control">
                                    <option value="">--Select persons_id--</option>
                                    <option value="1">uno</option>
                                    <option value="2">dos</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">name</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">email</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="email" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">contrasenia</label>
                            <div class="col-md-9">
                                <input name="contrasenia" placeholder="contrasenia" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">estado</label>
                            <div class="col-md-9">
                                <input name="estado" placeholder="estado" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                                    
                    </div>

                                
                </form>
                            
            </div>

                    
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
                    
        </div>
    </div>
</div>