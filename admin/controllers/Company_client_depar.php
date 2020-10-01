
                        
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_client_depar extends CI_Controller {
                        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('crud_model');
        }
                        
        public function index()
        {
            $this->load->view('company_client_depar');
        }
                        
        public function insert(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('departamento_id', 'Departamento_id', 'required');
                $this->form_validation->set_rules('empresa_cliente_id', 'Empresa_cliente_id', 'required');
                $this->form_validation->set_rules('estado', 'Estado', 'required');
                $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
                $this->form_validation->set_rules('fecha', 'Fecha', 'required');//while
                        
                    if ($this->form_validation->run() == FALSE)
                    {
                        $data = array('responce' => 'error','message' => validation_errors());
                    }
                    else
                    {
                        $ajax_data = $this->input->post();
                        if($this->company_client_depar_model->insert_entry($ajax_data)){
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
                $posts = $this->company_client_depar_model->get_entries();
                echo json_encode($posts);
            }
        }
                        
        public function delete(){
            if($this->input->is_ajax_request())
            {
                $del_id = $this->input->post('del_id');
                if($this->company_client_depar_model->delete_entry($del_id)){
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
                if($post = $this->company_client_depar_model->single_entry($edit_id)){
                    $data = array('responce'=> "success",'post'=>$post);
                }else{
                    $data = array('responce'=>"error", 'message'=>'failed');
                }
            }
            echo json_encode($data);
        }
                        
        public function update(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('edit_departamento_id', 'Departamento_id', 'required');
                $this->form_validation->set_rules('edit_empresa_cliente_id', 'Empresa_cliente_id', 'required');
                $this->form_validation->set_rules('edit_estado', 'Estado', 'required');
                $this->form_validation->set_rules('edit_descripcion', 'Descripcion', 'required');
                $this->form_validation->set_rules('edit_fecha', 'Fecha', 'required');//while
                        
                if ($this->form_validation->run() == FALSE)
                {
                    $data = array('responce' => 'error','message' => validation_errors());
                }
                else
                {
                        
                    $data['id'] = $this->input->post('edit_id');
                    $data['departamento_id'] = $this->input->post('edit_departamento_id');
                    $data['empresa_cliente_id'] = $this->input->post('edit_empresa_cliente_id');
                    $data['estado'] = $this->input->post('edit_estado');
                    $data['descripcion'] = $this->input->post('edit_descripcion');
                    $data['fecha'] = $this->input->post('edit_fecha');//while
                        
                    if($this->company_client_depar_model->update_entry($data)){
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
                        