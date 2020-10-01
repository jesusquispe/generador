<?php
    class Servicios_model extends CI_Model {
        
                
        public function get_entries()
        {
                $query = $this->db->get('servicios');
                if(count($query->result()) > 0){
                    return $query->result();
                }
                
        }
        
                
        public function delete_entry($id){
            return $this->db->delete('servicios', array('id' => $id));
        }
                
        public function insert_entry($data)
        {
            return $this->db->insert('servicios', $data);
        }
        
                
        public function single_entry($id)
        {
            $this->db->select("*");
            $this->db->from("servicios");
            $this->db->where("id",$id);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
            }

        }
        
                
        public function update_entry($data)
        {
            return $this->db->update('servicios', $data, array('id' => $data['id']));
        }
        
            
    }
?>
        
            