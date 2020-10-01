
            
<?php
    class Company_client_depar_model extends CI_Model {
        
                
        public function get_entries()
        {
                $query = $this->db->get('company_client_depar');
                if(count($query->result()) > 0){
                    return $query->result();
                }
                
        }
        
                
        public function delete_entry($id){
            return $this->db->delete('company_client_depar', array('id' => $id));
        }
                
        public function insert_entry($data)
        {
            return $this->db->insert('company_client_depar', $data);
        }
        
                
        public function single_entry($id)
        {
            $this->db->select("*");
            $this->db->from("company_client_depar");
            $this->db->where("id",$id);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
            }

        }
        
                
        public function update_entry($data)
        {
            return $this->db->update('company_client_depar', $data, array('id' => $data['id']));
        }
        
            
    }
?>
        
            