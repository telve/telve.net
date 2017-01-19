<?php

	class Submit extends MY_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('link_model');
			$this->load->model('topic_model');
			//$this->load->model('link_model');
		}

		public function index()
		{
			if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {

				$this->data['title'] = "Gönder/Paylaş";
				//$this->data['credit'] = $this->link_model->get_credit();
				$this->data['is_text_post'] = $this->input->get("metin");

				$this->form_validation->set_rules('title','<b>Başlık</b>','trim|required|max_length[255]|xss_clean');
	            $this->form_validation->set_rules('url','<b>URL</b>','trim|max_length[255]|xss_clean');
				$this->form_validation->set_rules('text','<b>Metin</b>','trim|max_length[10000]|xss_clean');
	            $this->form_validation->set_rules('topic','<b>Bir konu seçin</b>','trim|required|max_length[255]|xss_clean');
	            $this->form_validation->set_rules('captcha','<b>Doğrulama kodu</b>','trim|required|exact_length[4]|strtolower|xss_clean');

				if($this->form_validation->run() === FALSE){

	                $this->load->view('templates/header',$this->data);
					$this->load->view('submit/link');
					$this->load->view('templates/side');
					$this->load->view('templates/footer');

				} else {

	                $insert_id = $this->link_model->insert_link();
					$this->topic_model->insert_topic();
					$topic = str_replace(' ', '', $this->input->post('topic'));
					$topic = preg_replace('/[^a-zA-Z0-9]+/', '', $topic);
					redirect('t/'.strtoupper($topic).'/comments/'.$insert_id.'/');

				}

			} else {
				redirect('');
			}
		}

        public function get_title(){

            //Here also need to determine whether the string over the post URL or empty

            $html = file_get_contents($this->input->post("url"));
            $preg = "/<title>(.*?)<\/title>/si";
            preg_match($preg, $html, $arr);
            //echo trim(mb_convert_encoding($arr[1], "UTF-8", "GBK")); //GBK To UTF-8 Encoding conversion
            echo $arr[1]; //UTF-8
            //echo $this->safeEncoding($arr[1]); //The character set is automatically recognized and transcoded
        }

        private function safeEncoding($string,$outEncoding ='UTF-8')
        {
            $encoding = "UTF-8";
            for($i=0;$i<strlen($string);$i++)
            {
                if(ord($string{$i})<128)
                    continue;

                if((ord($string{$i})&224)==224)
                {
                    //The first byte is passed
                    $char = $string{++$i};
                    if((ord($char)&128)==128)
                    {
                        //The second byte is passed
                        $char = $string{++$i};
                        if((ord($char)&128)==128)
                        {
                            $encoding = "UTF-8";
                            break;
                        }
                    }
                }

                if((ord($string{$i})&192)==192)
                {
                    //The first byte is passed
                    $char = $string{++$i};
                    if((ord($char)&128)==128)
                    {
                        //The second byte is passed
                        $encoding = "GB2312";
                        break;
                    }
                }
            }

            if(strtoupper($encoding) == strtoupper($outEncoding))
                return $string;
            else
                return iconv($encoding,$outEncoding,$string);
        }
	}

?>
