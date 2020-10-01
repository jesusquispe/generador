
                        
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona extends CI_Controller {
                        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('crud_model');
        }
                        
        public function index()
        {
            $this->load->view('persona');
        }
                        
        public function insert(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('img', 'Img', 'required');
                $this->form_validation->set_rules('nombre', 'Nombre', 'required');
                $this->form_validation->set_rules('primer_apellido', 'Primer_apellido', 'required');
                $this->form_validation->set_rules('segundo_apellido', 'Segundo_apellido', 'required');
                $this->form_validation->set_rules('carnet_idetidad', 'Carnet_idetidad', 'required');
                $this->form_validation->set_rules('direccion', 'Direccion', 'required');
                $this->form_validation->set_rules('telefono', 'Telefono', 'required');
                $this->form_validation->set_rules('cel', 'Cel', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');//while
                        
                    if ($this->form_validation->run() == FALSE)
                    {
                        $data = array('responce' => 'error','message' => validation_errors());
                    }
                    else
                    {
                        $ajax_data = $this->input->post();
                        if($this->persona_model->insert_entry($ajax_data)){
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
                $posts = $this->persona_model->get_entries();
                echo json_encode($posts);
            }
        }
                        
        public function delete(){
            if($this->input->is_ajax_request())
            {
                $del_id = $this->input->post('del_id');
                if($this->persona_model->delete_entry($del_id)){
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
                if($post = $this->persona_model->single_entry($edit_id)){
                    $data = array('responce'=> "success",'post'=>$post);
                }else{
                    $data = array('responce'=>"error", 'message'=>'failed');
                }
            }
            echo json_encode($data);
        }
                        
        public function update(){
            if($this->input->is_ajax_request()){
                        
                $this->form_validation->set_rules('edit_img', 'Img', 'required');
                $this->form_validation->set_rules('edit_nombre', 'Nombre', 'required');
                $this->form_validation->set_rules('edit_primer_apellido', 'Primer_apellido', 'required');
                $this->form_validation->set_rules('edit_segundo_apellido', 'Segundo_apellido', 'required');
                $this->form_validation->set_rules('edit_carnet_idetidad', 'Carnet_idetidad', 'required');
                $this->form_validation->set_rules('edit_direccion', 'Direccion', 'required');
                $this->form_validation->set_rules('edit_telefono', 'Telefono', 'required');
                $this->form_validation->set_rules('edit_cel', 'Cel', 'required');
                $this->form_validation->set_rules('edit_email', 'Email', 'required');//while
                        
                if ($this->form_validation->run() == FALSE)
                {
                    $data = array('responce' => 'error','message' => validation_errors());
                }
                else
                {
                        
                    $data['id'] = $this->input->post('edit_id');
                    $data['img'] = $this->input->post('edit_img');
                    $data['nombre'] = $this->input->post('edit_nombre');
                    $data['primer_apellido'] = $this->input->post('edit_primer_apellido');
                    $data['segundo_apellido'] = $this->input->post('edit_segundo_apellido');
                    $data['carnet_idetidad'] = $this->input->post('edit_carnet_idetidad');
                    $data['direccion'] = $this->input->post('edit_direccion');
                    $data['telefono'] = $this->input->post('edit_telefono');
                    $data['cel'] = $this->input->post('edit_cel');
                    $data['email'] = $this->input->post('edit_email');//while
                        
                    if($this->persona_model->update_entry($data)){
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
                        