<?php
    class Search extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('link_model');
        }

        public function index()
        {
            $this->load->library('pagination');

            $config['base_url'] = base_url('arama');

            $this->data['search_query'] = $this->input->get("q");

            $config['total_rows'] = count($this->link_model->get_link_count(false, null, null, null, null, $this->data['search_query']));
            $this->data['search_total_rows'] = $config['total_rows'];
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

            $this->data['title'] = 'Arama: '.$this->input->get("q");
            $this->data['offset'] = $this->uri->segment(2);
            $this->data['link'] = $this->link_model->retrieve_link($id = false, $config['per_page'], $this->data['offset'], 'hot', null, null, $this->data['search_query']);

            foreach ($this->data['link'] as &$link_item) {
                $link_item['seo_segment'] = str_replace(" ", "-", strtolower(implode(' ', array_slice(preg_split('/\s+/', preg_replace('/[^a-zA-Z0-9ÇŞĞÜÖİçşğüöı\s]+/', '', $link_item['title'])), 0, 6))));
            }
            unset($link_item);

            $this->load->view('templates/header', $this->data);
            $this->load->view('link/index', $this->data);
            $this->load->view('templates/side');
            $this->load->view('templates/footer');
        }
    }
