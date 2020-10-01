<?php
    class Empresa_model extends CI_Model {
        
                
        public function get_entries()
        {
                $query = $this->db->get('empresa');
                if(count($query->result()) > 0){
                    return $query->result();
                }
                
        }
        
                
        public function delete_entry($id){
            return $this->db->delete('empresa', array('id' => $id));
        }
                
        public function insert_entry($data)
        {
            return $this->db->insert('empresa', $data);
        }
        
                
        public function single_entry($id)
        {
            $this->db->select("*");
            $this->db->from("empresa");
            $this->db->where("id",$id);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
            }

        }
        
                
        public function update_entry($data)
        {
            return $this->db->update('empresa', $data, array('id' => $data['id']));
        }
        
            
    }
?>
        
            