<?php
class Create_controller{

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
class '.$this->mayuscula($table).' extends CI_Controller {';
    }

    public function class_end()
    {
        return '
}';
    }

    public function construct($name_table)
    {
        return '
        public function __construct()
        {
            parent::__construct();
            $this->load->model(\''.$name_table.'_model\',\''.$name_table.'\');
        }';
    }
    public function index($name_table)
    {
        return '
        public function index()
        {
            $this->load->helper(\'url\');
            $this->load->view(\''.$name_table.'_view\');
        }';
    }
    
}