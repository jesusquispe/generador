
                    
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
                            <label class="control-label col-md-3">firstName</label>
                            <div class="col-md-9">
                                <input name="firstName" placeholder="firstName" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">lastName</label>
                            <div class="col-md-9">
                                <input name="lastName" placeholder="lastName" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">gender</label>
                            <div class="col-md-9">
                                <input name="gender" placeholder="gender" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">address</label>
                            <div class="col-md-9">
                                <input name="address" placeholder="address" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">dob</label>
                            <div class="col-md-9">
                                <input name="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">photo</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo">photo </label>
                            <div class="col-md-9">
                                <input name="photo" type="file">
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