
            
<?php
    class Empresa_cliente_model extends CI_Model {
        
                
        public function get_entries()
        {
                $query = $this->db->get('empresa_cliente');
                if(count($query->result()) > 0){
                    return $query->result();
                }
                
        }
        
                
        public function delete_entry($id){
            return $this->db->delete('empresa_cliente', array('id' => $id));
        }
                
        public function insert_entry($data)
        {
            return $this->db->insert('empresa_cliente', $data);
        }
        
                
        public function single_entry($id)
        {
            $this->db->select("*");
            $this->db->from("empresa_cliente");
            $this->db->where("id",$id);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
            }

        }
        
                
        public function update_entry($data)
        {
            return $this->db->update('empresa_cliente', $data, array('id' => $data['id']));
        }
        
            
    }
?>
        
            