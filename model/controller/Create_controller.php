<?php
include("../ConexionBD.php");
class Create_controller extends ConexionBD 
{

    public function __construct(){
        $bd =  new ConexionBD();
        echo "<h1>hello Worlt</h1>";
    }

    public function mayuscula($val)
    {
        return ucfirst($val);
    }
    public function home_construct()
    {
        return '
        public function __construct(){
            parent::__construct();
            $this->load->helper(array(\'form\', \'url\'));
            $this->load->library(\'form_validation\');
            $this->load->model(\'crud_model\');
        }';
    }
    public function vista_index($table)
    {
        return '
        public function index()
        {
            $this->load->view(\''.$table.'\');
        }';
    }
    public function start_insert_input($val)
    {
        if($val != 'id')
        {
            return '
                $this->form_validation->set_rules(\''.$val.'\', \''.$this->mayuscula($val).'\', \'required\');';
        }        
          
    }
    public function start_insert()
    {
        return '
        public function insert(){
            if($this->input->is_ajax_request()){';
    }
    public function end_insert($table)
    {
        return '
                    if ($this->form_validation->run() == FALSE)
                    {
                        $data = array(\'responce\' => \'error\',\'message\' => validation_errors());
                    }
                    else
                    {
                        $ajax_data = $this->input->post();
                        if($this->'.$table.'_model->insert_entry($ajax_data)){
                            $data = array(\'responce\' => \'success\',\'message\' => \'Datos agregados exitosamente\');
                        }else{
                            $data = array(\'responce\' => \'error\',\'message\' => \'failed\');
                        }
                        
                    }
                }else{
                    echo "No direct script access allowed";
                }

                echo json_encode($data);
            }';
    }

    public function list($table)
    {
        return '
        public function fetch()
        {
            if($this->input->is_ajax_request()){
                $posts = $this->'.$table.'_model->get_entries();
                echo json_encode($posts);
            }
        }';
    }
    public function delete($table)
    {
        return '
        public function delete(){
            if($this->input->is_ajax_request())
            {
                $del_id = $this->input->post(\'del_id\');
                if($this->'.$table.'_model->delete_entry($del_id)){
                    $data = array(\'responce\'=>"success");
                }else{
                    $data = array(\'responce\'=>"error");
                }			
            }
            echo json_encode($data);
        }
        ';
    }
    public function edit($table)
    {
        return '
        public function edit(){
            if($this->input->is_ajax_request())
            {
                $edit_id = $this->input->post(\'edit_id\');
                if($post = $this->'.$table.'_model->single_entry($edit_id)){
                    $data = array(\'responce\'=> "success",\'post\'=>$post);
                }else{
                    $data = array(\'responce\'=>"error", \'message\'=>\'failed\');
                }
            }
            echo json_encode($data);
        }';
    }

    public function start_update()
    {
        return '
        public function update(){
            if($this->input->is_ajax_request()){';
    }
    public function start_update_input_start($val)
    {
        if($val != "id")
        {
            return '
                $this->form_validation->set_rules(\'edit_'.$val.'\', \''.$this->mayuscula($val).'\', \'required\');';
        }
        
    }
    public function start_update_input_main()
    {
        return '
                if ($this->form_validation->run() == FALSE)
                {
                    $data = array(\'responce\' => \'error\',\'message\' => validation_errors());
                }
                else
                {';
    }
    public function start_update_input_end($val)
    {
        return '
                    $data[\''.$val.'\'] = $this->input->post(\'edit_'.$val.'\');';
    }
    public function end_update($table)
    {
        return '
                    if($this->'.$table.'_model->update_entry($data)){
                        $data = array(\'responce\' => \'success\',\'message\' => \'Data update successfully\');
                    }else{
                        $data = array(\'responce\' => \'error\',\'message\' => \'failed\');
                    }
                    
                }
            }else{
                echo "No direct script access allowed";
            }
            echo json_encode($data);
        }';
    }

    public function start_controller($table)
    {
        return '
<?php
defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

class '.$this->mayuscula($table).' extends CI_Controller {';
    }
    public function end_controller()
    {
        return '
}
?>';
    }
}

?>