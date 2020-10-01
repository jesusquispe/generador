
            
<?php
    class Usuarios_model extends CI_Model {
        
                
        public function get_entries()
        {
                $query = $this->db->get('usuarios');
                if(count($query->result()) > 0){
                    return $query->result();
                }
                
        }
        
                
        public function delete_entry($id){
            return $this->db->delete('usuarios', array('id' => $id));
        }
                
        public function insert_entry($data)
        {
            return $this->db->insert('usuarios', $data);
        }
        
                
        public function single_entry($id)
        {
            $this->db->select("*");
            $this->db->from("usuarios");
            $this->db->where("id",$id);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
            }

        }
        
                
        public function update_entry($data)
        {
            return $this->db->update('usuarios', $data, array('id' => $data['id']));
        }
        
            
    }
?>
        
            