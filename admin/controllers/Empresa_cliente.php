
                        
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa_cliente extends CI_Controller {
                        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('crud_model');
        }
                        
        public function index()
        {
            $this->load->view('empresa_cliente');
        }
                        
        public function insert(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('clientes_id', 'Clientes_id', 'required');
                $this->form_validation->set_rules('empresa_id', 'Empresa_id', 'required');
                $this->form_validation->set_rules('cargo', 'Cargo', 'required');
                $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
                $this->form_validation->set_rules('fecha', 'Fecha', 'required');//while
                        
                    if ($this->form_validation->run() == FALSE)
                    {
                        $data = array('responce' => 'error','message' => validation_errors());
                    }
                    else
                    {
                        $ajax_data = $this->input->post();
                        if($this->empresa_cliente_model->insert_entry($ajax_data)){
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
                $posts = $this->empresa_cliente_model->get_entries();
                echo json_encode($posts);
            }
        }
                        
        public function delete(){
            if($this->input->is_ajax_request())
            {
                $del_id = $this->input->post('del_id');
                if($this->empresa_cliente_model->delete_entry($del_id)){
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
                if($post = $this->empresa_cliente_model->single_entry($edit_id)){
                    $data = array('responce'=> "success",'post'=>$post);
                }else{
                    $data = array('responce'=>"error", 'message'=>'failed');
                }
            }
            echo json_encode($data);
        }
                        
        public function update(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('edit_clientes_id', 'Clientes_id', 'required');
                $this->form_validation->set_rules('edit_empresa_id', 'Empresa_id', 'required');
                $this->form_validation->set_rules('edit_cargo', 'Cargo', 'required');
                $this->form_validation->set_rules('edit_descripcion', 'Descripcion', 'required');
                $this->form_validation->set_rules('edit_fecha', 'Fecha', 'required');//while
                        
                if ($this->form_validation->run() == FALSE)
                {
                    $data = array('responce' => 'error','message' => validation_errors());
                }
                else
                {
                        
                    $data['id'] = $this->input->post('edit_id');
                    $data['clientes_id'] = $this->input->post('edit_clientes_id');
                    $data['empresa_id'] = $this->input->post('edit_empresa_id');
                    $data['cargo'] = $this->input->post('edit_cargo');
                    $data['descripcion'] = $this->input->post('edit_descripcion');
                    $data['fecha'] = $this->input->post('edit_fecha');//while
                        
                    if($this->empresa_cliente_model->update_entry($data)){
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
                        