
            
<?php
    class Persona_model extends CI_Model {
        
                
        public function get_entries()
        {
                $query = $this->db->get('persona');
                if(count($query->result()) > 0){
                    return $query->result();
                }
                
        }
        
                
        public function delete_entry($id){
            return $this->db->delete('persona', array('id' => $id));
        }
                
        public function insert_entry($data)
        {
            return $this->db->insert('persona', $data);
        }
        
                
        public function single_entry($id)
        {
            $this->db->select("*");
            $this->db->from("persona");
            $this->db->where("id",$id);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
            }

        }
        
                
        public function update_entry($data)
        {
            return $this->db->update('persona', $data, array('id' => $data['id']));
        }
        
            
    }
?>
        
            