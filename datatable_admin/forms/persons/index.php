
                
<div class="container">
    <h1 style="font-size:20pt">Ajax CRUD with Bootstrap modals and Datatables with Image Upload</h1>

    <h3>person Data</h3>
    <br />
                    
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add person</button>
                    
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        
            <thead>
                <tr>
                            
                    <th>#</th>
                            
                    <th>firstName</th>
                    <th>lastName</th>
                    <th>gender</th>
                    <th>address</th>
                    <th>dob</th>
                    <th>photo</th>
                            
                    <th style="width:150px;">Action</th>
                        
                </tr>
            </thead>
                        
            <tbody>
                        
            </tbody>
                        
            <tfoot>
                <tr>
                            
                    <th>#</th>
                            
                    <th>firstName</th>
                    <th>lastName</th>
                    <th>gender</th>
                    <th>address</th>
                    <th>dob</th>
                    <th>photo</th>
                            
                    <th>Action</th>
                        
                </tr>
            </tfoot>
                    
        </table>
                
</div>
<div id="list_img">
</div>