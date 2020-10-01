
                        
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_dep_emp_client extends CI_Controller {
                        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('crud_model');
        }
                        
        public function index()
        {
            $this->load->view('categorias_dep_emp_client');
        }
                        
        public function insert(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('categorias_id', 'Categorias_id', 'required');
                $this->form_validation->set_rules('company_client_depar_id', 'Company_client_depar_id', 'required');
                $this->form_validation->set_rules('estado', 'Estado', 'required');
                $this->form_validation->set_rules('fecha', 'Fecha', 'required');//while
                        
                    if ($this->form_validation->run() == FALSE)
                    {
                        $data = array('responce' => 'error','message' => validation_errors());
                    }
                    else
                    {
                        $ajax_data = $this->input->post();
                        if($this->categorias_dep_emp_client_model->insert_entry($ajax_data)){
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
                $posts = $this->categorias_dep_emp_client_model->get_entries();
                echo json_encode($posts);
            }
        }
                        
        public function delete(){
            if($this->input->is_ajax_request())
            {
                $del_id = $this->input->post('del_id');
                if($this->categorias_dep_emp_client_model->delete_entry($del_id)){
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
                if($post = $this->categorias_dep_emp_client_model->single_entry($edit_id)){
                    $data = array('responce'=> "success",'post'=>$post);
                }else{
                    $data = array('responce'=>"error", 'message'=>'failed');
                }
            }
            echo json_encode($data);
        }
                        
        public function update(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('edit_categorias_id', 'Categorias_id', 'required');
                $this->form_validation->set_rules('edit_company_client_depar_id', 'Company_client_depar_id', 'required');
                $this->form_validation->set_rules('edit_estado', 'Estado', 'required');
                $this->form_validation->set_rules('edit_fecha', 'Fecha', 'required');//while
                        
                if ($this->form_validation->run() == FALSE)
                {
                    $data = array('responce' => 'error','message' => validation_errors());
                }
                else
                {
                        
                    $data['id'] = $this->input->post('edit_id');
                    $data['categorias_id'] = $this->input->post('edit_categorias_id');
                    $data['company_client_depar_id'] = $this->input->post('edit_company_client_depar_id');
                    $data['estado'] = $this->input->post('edit_estado');
                    $data['fecha'] = $this->input->post('edit_fecha');//while
                        
                    if($this->categorias_dep_emp_client_model->update_entry($data)){
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
                        