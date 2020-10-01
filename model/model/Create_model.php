<?php
class Create_model{
    
    public function mayuscula($val)
    {
        return ucfirst($val);
    }
    public function list($table){
        return '
        public function get_entries()
        {
                $query = $this->db->get(\''.$table.'\');
                if(count($query->result()) > 0){
                    return $query->result();
                }
                
        }
        ';
    }
    public function delete($table){
        return '
        public function delete_entry($id){
            return $this->db->delete(\''.$table.'\', array(\'id\' => $id));
        }';
    }
    public function insert($table){
        return '
        public function insert_entry($data)
        {
            return $this->db->insert(\''.$table.'\', $data);
        }
        ';
    }
    public function optener_datos($table){
        return '
        public function single_entry($id)
        {
            $this->db->select("*");
            $this->db->from("'.$table.'");
            $this->db->where("id",$id);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
            }

        }
        ';
    }
    public function update($table){
        return '
        public function update_entry($data)
        {
            return $this->db->update(\''.$table.'\', $data, array(\'id\' => $data[\'id\']));
        }
        ';
    }
    public function start_class($table)
    {
        return '
<?php
    class '.$this->mayuscula($table).'_model extends CI_Model {
        ';

    }
    public function end_class()
    {
        return '
    }
?>
        ';
    }

}
?>