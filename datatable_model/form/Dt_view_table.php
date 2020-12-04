<?php
class Dt_view_table{

    public function container_start($name_table)
    {
        return '
<div class="container">
    <h1 style="font-size:20pt">Ajax CRUD with Bootstrap modals and Datatables with Image Upload</h1>

    <h3>'.$name_table.' Data</h3>
    <br />';
    }
    public function container_end()
    {
        return '
</div>
<div id="list_img">
</div>';
    }
    public function button_modal_add($name_table)
    {
        return '
        <button class="btn btn-success" onclick="add_'.$name_table.'()"><i class="glyphicon glyphicon-plus"></i> Add '.$name_table.'</button>';
    }
    public function button_modal_Reload()
    {
        return '
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>';
    }

    public function table_start()
    {
        return '
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">';
    }

    public function table_end()
    {
        return '
        </table>';
    }

    public function thead_start()
    {
        return '
            <thead>
                <tr>';
    }

    public function thead_end()
    {
        return '
                </tr>
            </thead>';
    }

    public function thead_th_body($name_attribute, $tipo,$key)
    {
        if($key != 'PRI'){
            return '
                    <th>'.$name_attribute.'</th>';
        }
        
    }

    public function thead_body_piece_start()
    {
        return '
                    <th>#</th>';
    }

    public function thead_body_piece_end()
    {
        return '
                    <th style="width:150px;">Action</th>';
    }

    public function tbody_start()
    {
        return '
            <tbody>';
    }

    public function tbody_end()
    {
        return '
            </tbody>';
    }

    public function tfoot_start()
    {
        return '
            <tfoot>
                <tr>';
    }

    public function tfoot_end()
    {
        return '
                </tr>
            </tfoot>';
    }

    public function tfoot_body_piece_start()
    {
        return '
                    <th>#</th>';
    }

    public function tfoot_body_piece_end()
    {
        return '
                    <th>Action</th>';
    }

    public function tfoot_th_body($name_attribute, $tipo, $key)
    {
        if($key != 'PRI'){
            return '
                    <th>'.$name_attribute.'</th>';
        }
        
    }

    
     
}
?>