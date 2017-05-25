<?php
    class Topic extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('link_model');
            $this->load->model('topic_model');
        }

        public function index()
        {
            if (urldecode($this->uri->segment(2)) == 'RASTGELE') {
                redirect('t/'.$this->link_model->random_topic()['topic'].'/');
            }

            $this->load->library('pagination');

            $config['base_url'] = base_url('t/'.$this->uri->segment(2));
            if (!is_numeric($this->uri->segment(3)) && !empty($this->uri->segment(3))) {
                $config['base_url'] = $config['base_url'].'/'.$this->uri->segment(3);
                $this->data['offset'] = $this->uri->segment(4);
            } else {
                $this->data['offset'] = $this->uri->segment(3);
            }

            $this->data['base_url'] = base_url('t/'.$this->uri->segment(2).'/');

            $topic = urldecode($this->uri->segment(2));
            if ($topic == 'TÜMÜ') {
                $topic = null;
            }

            $topic_item = $this->topic_model->retrieve_topic($topic);
            if (!empty($topic_item['header_image'])) {
                $ext = pathinfo(parse_url($topic_item['header_image'], PHP_URL_PATH), PATHINFO_EXTENSION);
                $this->data['header_image'] = base_url('assets/img/topics/'.$topic.'.'.$ext);
                $this->data['og_image'] = $this->data['header_image'];
            }
            if (!empty($topic_item['description'])) {
                $this->data['description'] = $topic_item['description'];
            } else {
                $this->data['description'] = $topic." konusuna hoş geldiniz. ".$topic." ile alâkalı en yeni, en tartışmalı ve en çok beğenilen paylaşımları burada bulabilirsiniz.";
            }

            $config['total_rows'] = count($this->link_model->get_link_count(false, null, null, $topic));
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

            $this->data['sn'] = 3;
            $this->data['title'] = urldecode($this->uri->segment(2));

            $segment = $this->uri->segment(3);
            if (($segment == 'sicak') || ($segment == '')) {
                $ranking = 'hot';
            } elseif ($segment == 'yeni') {
                $ranking = 'new';
                $this->data['title'] = 'en yeni paylaşımlar | '.$this->data['title'];
            } elseif ($segment == 'yukselen') {
                $ranking = 'rising';
                $this->data['title'] = 'yükselen gönderiler | '.$this->data['title'];
            } elseif ($segment == 'tartismali') {
                $ranking = 'controversial';
                $this->data['title'] = 'en tartışmalı paylaşımlar | '.$this->data['title'];
            } elseif ($segment == 'zirve') {
                $ranking = 'top';
                $this->data['title'] = 'zirvedeki gönderiler | '.$this->data['title'];
            } elseif ($segment == 'viki') {
                $this->data['wiki_topic'] = $this->topic_model->retrieve_topic($topic);
                $this->data['title'] = $this->data['title'].' konusunun vikisi';
                $this->load->view('templates/header', $this->data);
                $this->load->view('wiki/index', $this->data);
                $this->load->view('templates/side');
                $this->load->view('templates/footer');
                return 1;
            } elseif (is_numeric($segment)) {
                $ranking = 'hot';
            } else {
                redirect($this->data['base_url']);
            }

            $this->data['link'] = $this->link_model->retrieve_link($id = false, $config['per_page'], $this->data['offset'], $ranking, $topic);

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
