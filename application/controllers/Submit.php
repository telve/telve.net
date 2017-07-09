<?php

    class Submit extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('link_model');
            $this->load->model('topic_model');
            $this->load->helper('tr_lang');
            $this->load->helper('link_submission');
            $this->load->library('simple_html_dom');
            $this->load->helper('curl');
        }

        public function index()
        {
            if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
                $this->data['title'] = "Gönder/Paylaş";
                //$this->data['credit'] = $this->link_model->get_credit();
                $this->data['is_text_post'] = $this->input->get("metin");

                $this->form_validation->set_rules('title', '<b>Başlık</b>', 'trim|required|max_length[255]|xss_clean');
                $this->form_validation->set_rules('url', '<b>URL</b>', 'trim|max_length[255]|xss_clean');
                $this->form_validation->set_rules('text', '<b>Metin</b>', 'trim|max_length[10000]|xss_clean');
                $this->form_validation->set_rules('topic', '<b>Bir konu seçin</b>', 'trim|required|max_length[255]|xss_clean');
                $this->form_validation->set_rules('captcha', '<b>Doğrulama kodu</b>', 'trim|required|exact_length[4]|strtolower|xss_clean|regex_match[/'.$this->session->userdata('captcha').'/i]');

                if ($this->form_validation->run() === false) {
                    $this->load->view('templates/header', $this->data);
                    $this->load->view('submit/link');
                    $this->load->view('templates/side');
                    $this->load->view('templates/footer');
                } else {
                    $insert_id = $this->link_model->insert_link();
                    $this->topic_model->insert_topic();
                    $topic = str_replace(' ', '', $this->input->post('topic'));
                    $topic = str_replace(['Â','â'], ['A','a'], $topic);
                    $topic = preg_replace('/[^a-zA-Z0-9ÇŞĞÜÖİçşğüöı]+/', '', $topic);
                    redirect('t/'.tr_strtoupper($topic).'/yorumlar/'.$insert_id.'/');
                }
            } else {
                redirect('giris');
            }
        }

        public function get_title()
        {
            $url = $this->input->post("url");
            $parsed = parse_url($url);
            $segment = explode('/', $parsed['path']);

            if ($parsed['host'] == 'mobile.twitter.com') {
                $url = 'https://twitter.com/'.$parsed['path'];
            }

            $html = new Simple_html_dom();
            $html->load(using_curl($url));

            if ($html->find('meta[property=og:title]')) {
                $result = $html->find('meta[property=og:title]', 0)->content;
            } else {
                $result = $html->find('title', 0)->plaintext;
            }

            if (trim($result) == "Twitter") {
                $result = $html->find('div.dir-ltr', 0)->plaintext;
            }

            $result = trim(str_replace(array('&#039;','&#39;'), "'", $result));
            $result = trim(str_replace(array('&quot;'), '"', $result));
            $result = trim(str_replace(array('&#10;'), ' ', $result));
            #$result = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result);
            #$result = preg_replace('/[^\r\n\t\x20-\x7E\xA0-\xFF]/', '', $result);
            #$result = html_entity_decode($result);
            #$result = utf8_encode($result);
            echo $result;
        }

        private function safeEncoding($string, $outEncoding ='UTF-8')
        {
            $encoding = "UTF-8";
            for ($i=0;$i<strlen($string);$i++) {
                if (ord($string{$i})<128) {
                    continue;
                }

                if ((ord($string{$i})&224)==224) {
                    //The first byte is passed
                    $char = $string{++$i};
                    if ((ord($char)&128)==128) {
                        //The second byte is passed
                        $char = $string{++$i};
                        if ((ord($char)&128)==128) {
                            $encoding = "UTF-8";
                            break;
                        }
                    }
                }

                if ((ord($string{$i})&192)==192) {
                    //The first byte is passed
                    $char = $string{++$i};
                    if ((ord($char)&128)==128) {
                        //The second byte is passed
                        $encoding = "GB2312";
                        break;
                    }
                }
            }

            if (strtoupper($encoding) == strtoupper($outEncoding)) {
                return $string;
            } else {
                return iconv($encoding, $outEncoding, $string);
            }
        }

        public function analyze_url_test()
        {
            //$url = $this->input->post('url');
            //echo print_r(analyze_url($url));
        }
    }
