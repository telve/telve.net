<?php

	class Submit extends MY_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('link_model');
			//$this->load->model('link_model');
		}

		public function index()
		{
			if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {

				$this->data['title'] = "Submit";
				//$this->data['credit'] = $this->link_model->get_credit();

				$this->form_validation->set_rules('title','title','trim|required|max_length[255]');
	            $this->form_validation->set_rules('url','URL','trim|required|max_length[255]');
	            $this->form_validation->set_rules('category','category','trim|required|max_length[255]');
	            $this->form_validation->set_rules('captcha','verification code','trim|required|exact_length[4]|strtolower');

				if($this->form_validation->run() === FALSE){

	                $this->load->view('templates/header',$this->data);
					$this->load->view('submit/link');
					$this->load->view('templates/footer');

				} else {

	                $this->link_model->insert_link();
					$this->load->view('templates/header',$this->data);
					$this->load->view('submit/success');
					$this->load->view('templates/footer');

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
            //echo $arr[1]; //UTF-8
            echo $this->safeEncoding($arr[1]); //The character set is automatically recognized and transcoded
        }

		public function status()
		{

			$this->data['title'] = "发布状态";

			$this->form_validation->set_rules('content','Content','trim|required|min_length[5]|max_length[228]');

			if($this->form_validation->run()===FALSE)
			{
				$this->load->view('templates/header',$this->data);
				$this->load->view('submit/status');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->link_model->set_submit();
				$this->load->view('templates/header',$this->data);
				$this->load->view('submit/success');
				$this->load->view('templates/footer');
			}

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
