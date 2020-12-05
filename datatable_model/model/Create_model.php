<?php
class Create_model{
    
    public function mayuscula($val)
    {
        return ucfirst($val);
    }

    public function basepath()
    {
        return 'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');';
    }

    public function class_start($table)
    {
        return '
class '.$this->mayuscula($table).'_model extends CI_Model {';
    }

    public function class_end()
    {
        return '
}';
    }

    public function variable($name_table)
    {
        $last_table = 's';
        return '
        var $table = \''.$name_table.$last_table.'\';
        var $order = array(\'id\' => \'desc\'); // default order';
       
        
    }
    public function variable_column_order_start()
    {
        return '
        var $column_order = array(';
    }
    public function variable_column_search_start()
    {
        return '
        var $column_search = array(';
    }

    public function variable_table_body($attribute, $tipo, $key)
    {        
        if($key == 'PRI'){
            return false;
        }else if($tipo == 'varchar(255)'){
            $valor_null = "null";
            return ''.$valor_null.',';
        }else{
            return '\''.$attribute.'\',';
        }
    }

    public function variable_search($attribute, $tipo, $key)
    {
        /*if($tipo != 'int(11)' && $tipo != 'varchar(255)'){
            return '\''.$attribute.'\',';
        }*/
        if($key != 'PRI'  && $tipo != 'varchar(255)')
        {
            return '\''.$attribute.'\',';
        }

    }

    public function variable_table_end()
    {
        return ');';
    }

    public function construct()
    {
        return '
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }';
    }

    public function get_datatables_query()
    {
        return '
        private function _get_datatables_query()
        {
            
            $this->db->from($this->table);

            $i = 0;
        
            foreach ($this->column_search as $item) // loop column 
            {
                if($_POST[\'search\'][\'value\']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST[\'search\'][\'value\']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST[\'search\'][\'value\']);
                    }

                    if(count($this->column_search) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST[\'order\'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST[\'order\'][\'0\'][\'column\']], $_POST[\'order\'][\'0\'][\'dir\']);
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }';
    }

    public function get_datatables()
    {
        return '
        function get_datatables()
        {
            $this->_get_datatables_query();
            if($_POST[\'length\'] != -1)
            $this->db->limit($_POST[\'length\'], $_POST[\'start\']);
            $query = $this->db->get();
            return $query->result();
        }
        ';
    }

    public function count_filtered()
    {
        return '
        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }';
    }

    public function count_all()
    {
        return '
        public function count_all()
        {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }
        ';
    }

    public function get_by_id()
    {
        return '
        public function get_by_id($id)
        {
            $this->db->from($this->table);
            $this->db->where(\'id\',$id);
            $query = $this->db->get();

            return $query->row();
        }';
    }

    public function save()
    {
        return '
        public function save($data)
        {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }';
    }

    public function update(){
        return '
        public function update($where, $data)
        {
            $this->db->update($this->table, $data, $where);
            return $this->db->affected_rows();
        }';
    }

    public function delete_by_id()
    {
        return '
        public function delete_by_id($id)
        {
            $this->db->where(\'id\', $id);
            $this->db->delete($this->table);
        }';
    }

}
?>