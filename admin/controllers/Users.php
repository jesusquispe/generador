
                        
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
                        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('crud_model');
        }
                        
        public function index()
        {
            $this->load->view('users');
        }
                        
        public function insert(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('persons_id', 'Persons_id', 'required');
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('contrasenia', 'Contrasenia', 'required');
                $this->form_validation->set_rules('estado', 'Estado', 'required');//while
                        
                    if ($this->form_validation->run() == FALSE)
                    {
                        $data = array('responce' => 'error','message' => validation_errors());
                    }
                    else
                    {
                        $ajax_data = $this->input->post();
                        if($this->users_model->insert_entry($ajax_data)){
                            $data = array('responce' => 'success','message' => 'Datos agregados exitosamente');
                        }else{
                            $data = array('responce' => 'error','message' => 'failed');
                        }
                        
                    }
                }else{
                    echo "No direct script access allowed";
                }

                echo json_encode($data);
            }
                        
        public function fetch()
        {
            if($this->input->is_ajax_request()){
                $posts = $this->users_model->get_entries();
                echo json_encode($posts);
            }
        }
                        
        public function delete(){
            if($this->input->is_ajax_request())
            {
                $del_id = $this->input->post('del_id');
                if($this->users_model->delete_entry($del_id)){
                    $data = array('responce'=>"success");
                }else{
                    $data = array('responce'=>"error");
                }			
            }
            echo json_encode($data);
        }
        
                        
        public function edit(){
            if($this->input->is_ajax_request())
            {
                $edit_id = $this->input->post('edit_id');
                if($post = $this->users_model->single_entry($edit_id)){
                    $data = array('responce'=> "success",'post'=>$post);
                }else{
                    $data = array('responce'=>"error", 'message'=>'failed');
                }
            }
            echo json_encode($data);
        }
                        
        public function update(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('edit_persons_id', 'Persons_id', 'required');
                $this->form_validation->set_rules('edit_name', 'Name', 'required');
                $this->form_validation->set_rules('edit_email', 'Email', 'required');
                $this->form_validation->set_rules('edit_contrasenia', 'Contrasenia', 'required');
                $this->form_validation->set_rules('edit_estado', 'Estado', 'required');//while
                        
                if ($this->form_validation->run() == FALSE)
                {
                    $data = array('responce' => 'error','message' => validation_errors());
                }
                else
                {
                        
                    $data['id'] = $this->input->post('edit_id');
                    $data['persons_id'] = $this->input->post('edit_persons_id');
                    $data['name'] = $this->input->post('edit_name');
                    $data['email'] = $this->input->post('edit_email');
                    $data['contrasenia'] = $this->input->post('edit_contrasenia');
                    $data['estado'] = $this->input->post('edit_estado');//while
                        
                    if($this->users_model->update_entry($data)){
                        $data = array('responce' => 'success','message' => 'Data update successfully');
                    }else{
                        $data = array('responce' => 'error','message' => 'failed');
                    }
                    
                }
            }else{
                echo "No direct script access allowed";
            }
            echo json_encode($data);
        }
                        
}
?>
                        