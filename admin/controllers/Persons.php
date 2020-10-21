
                        
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persons extends CI_Controller {
                        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('crud_model');
        }
                        
        public function index()
        {
            $this->load->view('persons');
        }
                        
        public function insert(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('firstName', 'FirstName', 'required');
                $this->form_validation->set_rules('lastName', 'LastName', 'required');
                $this->form_validation->set_rules('gender', 'Gender', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('dob', 'Dob', 'required');
                $this->form_validation->set_rules('photo', 'Photo', 'required');//while
                        
                    if ($this->form_validation->run() == FALSE)
                    {
                        $data = array('responce' => 'error','message' => validation_errors());
                    }
                    else
                    {
                        $ajax_data = $this->input->post();
                        if($this->persons_model->insert_entry($ajax_data)){
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
                $posts = $this->persons_model->get_entries();
                echo json_encode($posts);
            }
        }
                        
        public function delete(){
            if($this->input->is_ajax_request())
            {
                $del_id = $this->input->post('del_id');
                if($this->persons_model->delete_entry($del_id)){
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
                if($post = $this->persons_model->single_entry($edit_id)){
                    $data = array('responce'=> "success",'post'=>$post);
                }else{
                    $data = array('responce'=>"error", 'message'=>'failed');
                }
            }
            echo json_encode($data);
        }
                        
        public function update(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('edit_firstName', 'FirstName', 'required');
                $this->form_validation->set_rules('edit_lastName', 'LastName', 'required');
                $this->form_validation->set_rules('edit_gender', 'Gender', 'required');
                $this->form_validation->set_rules('edit_address', 'Address', 'required');
                $this->form_validation->set_rules('edit_dob', 'Dob', 'required');
                $this->form_validation->set_rules('edit_photo', 'Photo', 'required');//while
                        
                if ($this->form_validation->run() == FALSE)
                {
                    $data = array('responce' => 'error','message' => validation_errors());
                }
                else
                {
                        
                    $data['id'] = $this->input->post('edit_id');
                    $data['firstName'] = $this->input->post('edit_firstName');
                    $data['lastName'] = $this->input->post('edit_lastName');
                    $data['gender'] = $this->input->post('edit_gender');
                    $data['address'] = $this->input->post('edit_address');
                    $data['dob'] = $this->input->post('edit_dob');
                    $data['photo'] = $this->input->post('edit_photo');//while
                        
                    if($this->persons_model->update_entry($data)){
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
                        