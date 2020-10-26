<?php
class Dt_view_table{

    public function button_modal_add($name_table)
    {
        return '<button class="btn btn-success" onclick="add_'.$name_table.'()"><i class="glyphicon glyphicon-plus"></i> Add '.$name_table.'</button>';
    }
    public function button_modal_Reload()
    {
        return '<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>';
    }

    public function table_start()
    {
        return '<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">';
    }

    public function table_end()
    {
        return '</table>';
    }

    public function thead_start()
    {
        return '<thead>
                    <tr>';
    }

    public function thead_end()
    {
        return '    </tr>
                </thead>';
    }

    public function thead_th_body($name_attribute)
    {
        return '<th>'.$name_attribute.'</th>';
    }

    public function thead_body_piece_start()
    {
        return '<th>#</th>';
    }

    public function thead_body_piece_end()
    {
        return '<th style="width:150px;">Action</th>';
    }

    public function tbody_start()
    {
        return '<tbody>';
    }

    public function tbody_end()
    {
        return '</tbody>';
    }

    public function tfoot_start()
    {
        return '<tfoot>
                    <tr>';
    }

    public function tfoot_end()
    {
        return '    </tr>
                </tfoot>';
    }

    public function tfoot_body_piece_start()
    {
        return '<th>#</th>';
    }

    public function tfoot_body_piece_end()
    {
        return '<th>Action</th>';
    }
     
}
?>