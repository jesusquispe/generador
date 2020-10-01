
                        
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costos extends CI_Controller {
                        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('crud_model');
        }
                        
        public function index()
        {
            $this->load->view('costos');
        }
                        
        public function insert(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('velocidades_id', 'Velocidades_id', 'required');
                $this->form_validation->set_rules('servicio', 'Servicio', 'required');
                $this->form_validation->set_rules('bajada', 'Bajada', 'required');
                $this->form_validation->set_rules('subida', 'Subida', 'required');
                $this->form_validation->set_rules('costo', 'Costo', 'required');
                $this->form_validation->set_rules('costo_instalacion', 'Costo_instalacion', 'required');
                $this->form_validation->set_rules('estado', 'Estado', 'required');//while
                        
                    if ($this->form_validation->run() == FALSE)
                    {
                        $data = array('responce' => 'error','message' => validation_errors());
                    }
                    else
                    {
                        $ajax_data = $this->input->post();
                        if($this->costos_model->insert_entry($ajax_data)){
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
                $posts = $this->costos_model->get_entries();
                echo json_encode($posts);
            }
        }
                        
        public function delete(){
            if($this->input->is_ajax_request())
            {
                $del_id = $this->input->post('del_id');
                if($this->costos_model->delete_entry($del_id)){
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
                if($post = $this->costos_model->single_entry($edit_id)){
                    $data = array('responce'=> "success",'post'=>$post);
                }else{
                    $data = array('responce'=>"error", 'message'=>'failed');
                }
            }
            echo json_encode($data);
        }
                        
        public function update(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('edit_velocidades_id', 'Velocidades_id', 'required');
                $this->form_validation->set_rules('edit_servicio', 'Servicio', 'required');
                $this->form_validation->set_rules('edit_bajada', 'Bajada', 'required');
                $this->form_validation->set_rules('edit_subida', 'Subida', 'required');
                $this->form_validation->set_rules('edit_costo', 'Costo', 'required');
                $this->form_validation->set_rules('edit_costo_instalacion', 'Costo_instalacion', 'required');
                $this->form_validation->set_rules('edit_estado', 'Estado', 'required');//while
                        
                if ($this->form_validation->run() == FALSE)
                {
                    $data = array('responce' => 'error','message' => validation_errors());
                }
                else
                {
                        
                    $data['id'] = $this->input->post('edit_id');
                    $data['velocidades_id'] = $this->input->post('edit_velocidades_id');
                    $data['servicio'] = $this->input->post('edit_servicio');
                    $data['bajada'] = $this->input->post('edit_bajada');
                    $data['subida'] = $this->input->post('edit_subida');
                    $data['costo'] = $this->input->post('edit_costo');
                    $data['costo_instalacion'] = $this->input->post('edit_costo_instalacion');
                    $data['estado'] = $this->input->post('edit_estado');//while
                        
                    if($this->costos_model->update_entry($data)){
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
                        