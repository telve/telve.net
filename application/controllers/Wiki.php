<?php
    class Wiki extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            $this->data['title'] = 'genel viki';
            $this->load->view('templates/header', $this->data);
            $this->load->view('wiki/index', $this->data);
            $this->load->view('templates/side');
            $this->load->view('templates/footer');
        }
    }
