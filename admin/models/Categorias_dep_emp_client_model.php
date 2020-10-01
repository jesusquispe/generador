
            
<?php
    class Categorias_dep_emp_client_model extends CI_Model {
        
                
        public function get_entries()
        {
                $query = $this->db->get('categorias_dep_emp_client');
                if(count($query->result()) > 0){
                    return $query->result();
                }
                
        }
        
                
        public function delete_entry($id){
            return $this->db->delete('categorias_dep_emp_client', array('id' => $id));
        }
                
        public function insert_entry($data)
        {
            return $this->db->insert('categorias_dep_emp_client', $data);
        }
        
                
        public function single_entry($id)
        {
            $this->db->select("*");
            $this->db->from("categorias_dep_emp_client");
            $this->db->where("id",$id);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
            }

        }
        
                
        public function update_entry($data)
        {
            return $this->db->update('categorias_dep_emp_client', $data, array('id' => $data['id']));
        }
        
            
    }
?>
        
            