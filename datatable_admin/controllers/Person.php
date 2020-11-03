<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('person_model','person');
        }

        public function index()
        {
            $this->load->helper('url');
            $this->load->view('person_view');
        }



}