
            
<?php
    class Persons_model extends CI_Model {
        
                
        public function get_entries()
        {
                $query = $this->db->get('persons');
                if(count($query->result()) > 0){
                    return $query->result();
                }
                
        }
        
                
        public function delete_entry($id){
            return $this->db->delete('persons', array('id' => $id));
        }
                
        public function insert_entry($data)
        {
            return $this->db->insert('persons', $data);
        }
        
                
        public function single_entry($id)
        {
            $this->db->select("*");
            $this->db->from("persons");
            $this->db->where("id",$id);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
            }

        }
        
                
        public function update_entry($data)
        {
            return $this->db->update('persons', $data, array('id' => $data['id']));
        }
        
            
    }
?>
        
            