<?php
//include("../../datatable_admin/app/Validate.php");
class Create_controller{

    public function mayuscula($val)
    {
        return ucfirst($val);
    }   

    public function basepath()
    {
        return 'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');';
    }

    public function class_start($table)
    {        
        return '
class '.$this->mayuscula($table).' extends CI_Controller {';
    }

    public function class_end()
    {
        return '
}';
    }

    public function construct($name_table)
    {
        return '
        public function __construct()
        {
            parent::__construct();
            $this->load->model(\''.$name_table.'_model\',\''.$name_table.'\');
        }';
    }
    public function index($name_table)
    {
        return '
        public function index()
        {
            $this->load->helper(\'url\');
            $this->load->view(\''.$name_table.'_view\');
        }';
    }

   
    public function ajax_list_start($name_table)
    {
        return '
        public function ajax_list()
        {
            $this->load->helper(\'url\');

            $list = $this->'.$name_table.'->get_datatables();
            $data = array();
            $no = $_POST[\'start\'];
            foreach ($list as $'.$name_table.') {
                $no++;
                $row = array();
                $row[] = $no;';
    }
    public function ajax_list_body($name_table, $tupla, $type, $key)
    {
        if($type=='varchar(255)'){
            return '
            if($'.$name_table.'->'.$tupla.')
                $row[] = \'<a href="\'.base_url(\'upload/\'.$'.$name_table.'->'.$tupla.').\'" target="_blank"><img src="\'.base_url(\'upload/\'.$'.$name_table.'->'.$tupla.').\'" class="img-responsive" /></a>\';
            else
                $row[] = \'(No photo)\';';
        }else if($key!='PRI'){
            return '
                $row[] = $'.$name_table.'->'.$tupla.';';
        }
        
    }
    public function ajax_list_end($name_table)
    {
        return '
                //add html for action
                $row[] = \'<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_'.$name_table.'(\'."\'".$'.$name_table.'->id."\'".\')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_'.$name_table.'(\'."\'".$'.$name_table.'->id."\'".\')"><i class="glyphicon glyphicon-trash"></i> Delete</a>\';
            
                $data[] = $row;
            }

            $output = array(
                            "draw" => $_POST[\'draw\'],
                            "recordsTotal" => $this->'.$name_table.'->count_all(),
                            "recordsFiltered" => $this->'.$name_table.'->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }';
    }

    public function ajax_edit_start($name_table){
        return '
        public function ajax_edit($id)
        {
            $data = $this->'.$name_table.'->get_by_id($id);';
    }

    public function ajax_edit_body($type, $tupla)
    {
        if($type=='date'){
            return '
            $data->'.$tupla.' = ($data->'.$tupla.' == \'0000-00-00\') ? \'\' : $data->'.$tupla.'; // if 0000-00-00 set tu empty for datepicker compatibility';
        }
    }
    public function ajax_edit_end(){
        return '
            echo json_encode($data);
        }';
    }
   
    /*--------------------Generador de insertar--------------------------------------- */

    public function ajax_add_start()
    {       
        return '
        public function ajax_add()
        {
            $this->_validate();
            
            $data = array(';
    }
    public function ajax_add_body_start($tupla, $type, $key)
    {
        if($key!='PRI' && $type!='varchar(255)'){
            return '
                \''.$tupla.'\' => $this->input->post(\''.$tupla.'\'),';
        }
        
    }
    public function ajax_add_body_end()
    {
        return '
        );';
    }
    public function ajax_add_photo($tupla, $type)
    {
        if($type=='varchar(255)'){
            return '
            if(!empty($_FILES[\''.$tupla.'\'][\'name\']))
            {
                $upload = $this->_do_upload();
                $data[\''.$tupla.'\'] = $upload;
            }';
        }
        
    }
    public function ajax_add_end($name_table)
    {
        return '
            $insert = $this->'.$name_table.'->save($data);

            echo json_encode(array("status" => TRUE));
        }';
    }

    /*----------------------------------------------------------- */
    /*---------------------Ajax Actualizar -------------------------------------- */

    public function ajax_update_start()
    {

        return '
        public function ajax_update()
        {
            $this->_validate();
            $data = array(';
    }
    public function ajax_update_body($tupla, $type, $key)
    {
        if($key!='PRI' && $type!='varchar(255)'){
            return '
            \''.$tupla.'\' => $this->input->post(\''.$tupla.'\'),';
        }
        
    }
    public function ajax_update_body_end()
    {
        return '
        );';
    }
    public function ajax_update_remove_photo($tupla, $type)
    {
        if($type=='varchar(255)'){
            return '
            if($this->input->post(\'remove_photo\')) // if remove photo checked
            {
                if(file_exists(\'upload/\'.$this->input->post(\'remove_photo\')) && $this->input->post(\'remove_photo\'))
                    unlink(\'upload/\'.$this->input->post(\'remove_photo\'));
                $data[\''.$tupla.'\'] = \'\';
            }
            ';
        }
       
    }

    public function ajax_update_photo($name_table,$tupla,$type)
    {
        if($type=='varchar(255)'){
            return '
            if(!empty($_FILES[\''.$tupla.'\'][\'name\']))
            {
                $upload = $this->_do_upload();
                
                //delete file
                $'.$name_table.' = $this->'.$name_table.'->get_by_id($this->input->post(\'id\'));
                if(file_exists(\'upload/\'.$'.$name_table.'->'.$tupla.') && $'.$name_table.'->'.$tupla.')
                    unlink(\'upload/\'.$'.$name_table.'->'.$tupla.');

                $data[\''.$tupla.'\'] = $upload;
            }
            ';
        }
        
    }

    public function ajax_update_end($name_table)
    {
        return '
        $this->'.$name_table.'->update(array(\'id\' => $this->input->post(\'id\')), $data);
		echo json_encode(array("status" => TRUE));
	}';
    }

    /*--------------------------------------------------------------------------------------- */
    /*-------------------------Eliminar------------------------------------------------------ */

    public function ajax_delete_start($name_table)
    {
        return '
        public function ajax_delete($id)
        {
            //delete file
            $'.$name_table.' = $this->'.$name_table.'->get_by_id($id);';
    }

    public function ajax_delete_body($name_table, $tupla, $type)
    {
        if($type=='varchar(255)'){
            return '
            if(file_exists(\'upload/\'.$'.$name_table.'->'.$tupla.') && $'.$name_table.'->'.$tupla.')
			unlink(\'upload/\'.$'.$name_table.'->'.$tupla.');';
        }
        
    }
    public function ajax_delete_end($name_table)
    {
        return '
            $this->'.$name_table.'->delete_by_id($id);
            echo json_encode(array("status" => TRUE));
        }';
    }
/*---------------------------------------------------------- */
    public function ajax__do_upload($type)
    {
        if($type=='varchar(255)'){
            return '
        private function _do_upload()
        {
            $config[\'upload_path\']          = \'upload/\';
            $config[\'allowed_types\']        = \'gif|jpg|png\';
            $config[\'max_size\']             = 100; //set max size allowed in Kilobyte
            $config[\'max_width\']            = 1000; // set max width image allowed
            $config[\'max_height\']           = 1000; // set max height allowed
            $config[\'file_name\']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

            $this->load->library(\'upload\', $config);

            if(!$this->upload->do_upload(\'photo\')) //upload and validate
            {
                $data[\'inputerror\'][] = \'photo\';
                $data[\'error_string\'][] = \'Upload error: \'.$this->upload->display_errors(\'\',\'\'); //show ajax error
                $data[\'status\'] = FALSE;
                echo json_encode($data);
                exit();
            }
            return $this->upload->data(\'file_name\');
        }';
        }
        
    }

    public function ajax__validate_start()
    {
        return '
        private function _validate()
        {
            $data = array();
            $data[\'error_string\'] = array();
            $data[\'inputerror\'] = array();
            $data[\'status\'] = TRUE;';
    }
    public function ajax__validate_body( $tupla, $type, $key)
    {
        if($key!='PRI' && $type!='varchar(255)'){
            return '
            if($this->input->post(\''.$tupla.'\') == \'\')
            {
                $data[\'inputerror\'][] = \''.$tupla.'\';
                $data[\'error_string\'][] = \''.$tupla.' is required\';
                $data[\'status\'] = FALSE;
            }';
        }
        
    }
    public function  ajax__validate_end()
    {
        return '
            if($data[\'status\'] === FALSE)
            {
                echo json_encode($data);
                exit();
            }
        }';
    }


}