<?php
    class Domain extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('link_model');
        }

        public function index()
        {
            $this->load->library('pagination');

            $config['base_url'] = base_url('alan-adi/'.$this->uri->segment(2));
            if (!is_numeric($this->uri->segment(3)) && !empty($this->uri->segment(3))) {
                $config['base_url'] = $config['base_url'].'/'.$this->uri->segment(3);
                $this->data['offset'] = $this->uri->segment(4);
            } else {
                $this->data['offset'] = $this->uri->segment(3);
            }

            $this->data['base_url'] = base_url('alan-adi/'.$this->uri->segment(2).'/');

            $config['total_rows'] = count($this->link_model->get_link_count(false, null, null, null, $this->uri->segment(2)));
            $config['per_page'] = 10;
            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = '<span class="glyphicon glyphicon-arrow-left"></span> <span class="pagination">Önceki sayfa</span>';
            $config['next_link'] = '<span class="pagination">Sonraki sayfa</span> <span class="glyphicon glyphicon-arrow-right"></span>';
            $config['full_tag_close'] = '</p>';
            $config['display_pages'] = false; //The "number" link is not displayed
            $config['first_link'] = false; //The start link is not displayed
            $config['last_link'] = false;
            $config['next_tag_open'] = '<span style="float:right;">';
            $config['next_tag_close'] = "</span>";
            $this->pagination->initialize($config);
            $this->data['per_page'] = $config['per_page'];

            $segment = $this->uri->segment(3);
            if (($segment == 'sicak') || ($segment == '')) {
                $ranking = 'hot';
            } elseif ($segment == 'yeni') {
                $ranking = 'new';
            } elseif ($segment == 'yukselen') {
                $ranking = 'rising';
            } elseif ($segment == 'tartismali') {
                $ranking = 'controversial';
            } elseif ($segment == 'zirve') {
                $ranking = 'top';
            } else {
                $ranking = 'hot';
            }

            $this->data['title'] = $this->uri->segment(2).' | telve.net';

            $this->data['link'] = $this->link_model->retrieve_link($id = false, $config['per_page'], $this->data['offset'], $ranking, null, $this->uri->segment(2));
            $this->data['sn'] = 3;

            foreach ($this->data['link'] as &$link_item) {
                $link_item['seo_segment'] = str_replace(" ", "-", strtolower(implode(' ', array_slice(preg_split('/\s+/', preg_replace('/[^a-zA-Z0-9ÇŞĞÜÖİçşğüöı\s]+/', '', $link_item['title'])), 0, 6))));
            }
            unset($link_item);

            $this->load->view('templates/header', $this->data);
            $this->load->view('link/index', $this->data);
            $this->load->view('templates/side');
            $this->load->view('templates/footer');
        }

        public function check_ranking($segment)
        {
            if ($segment == 'new') {
                return 'new';
            } elseif ($segment == 'rising') {
                return 'rising';
            } elseif ($segment == 'controversial') {
                return 'controversial';
            } elseif ($segment == 'top') {
                return 'top';
            } else {
                return 'hot';
            }
        }
    }
