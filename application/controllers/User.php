<?php

	class User extends MY_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('user_model');
		}

        public function register()
		{

			$this->data['title'] = "Register a user";

			$this->form_validation->set_rules('username','username','trim|required|min_length[5]|max_length[12]|is_unique[user.username]|regex_match[/^((?!admin).)*$/]|regex_match[/^((?!moderator).)*$/]');
			$this->form_validation->set_rules('email','email','required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password','password','trim|required|min_length[6]|matches[passconf]');
			$this->form_validation->set_rules('passconf','confirm password','required');
      		$this->form_validation->set_rules('captcha','verification code','trim|required|exact_length[4]|strtolower');

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header',$this->data);
				$this->load->view('user/register');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->user_model->insert_user();

        		//$this->load->view('templates/header',$this->data);
				//$this->load->view('hot/index',$this->data);
				//$this->load->view('templates/footer');

        		redirect(''); //default: hot/index
			}

		}

        public function login()
        {

			$this->data['title'] = "Log in";
			$this->form_validation->set_rules('username','username','required');
			$this->form_validation->set_rules('password','password','required');

			if ($this->form_validation->run() == FALSE){

				$this->data['data'] = "An error occured";
				$this->load->view('templates/header',$this->data);
				$this->load->view('user/login');
				$this->load->view('templates/footer');

			} else {

				if ($this->user_model->authenticate()) {

					$session['username'] = $this->input->post('username');
					$this->session->set_userdata($session);
					redirect(''); //default: hot/index

				} else {

					$this->data['title'] = 'Login failed, please check your information!';
					$this->load->view('templates/header',$this->data);
					$this->load->view('user/login');
					$this->load->view('templates/footer');

				}
			}
        }

        public function logout()
        {

            $this->session->sess_destroy();
			redirect(''); //default: hot/index
        }

        public function is_username_available()
        {

            if(strlen($this->input->post('username')) < 6)
            {
                echo "<span style='color:red'>Invalid username</span>";
            } else {
                if($this->user_model->check_username()){
                    echo "<span style='color:red'>The username already exists</span>";
                } else {
                    echo "<span style='color:green'>The username is available</span>";
                }
            }
        }

        public function captcha()
        {
            $this->load->library('captcha');
            $this->load->helper('string');

            $rand_str = random_string('alnum',4);
            $captcha = new Captcha(220,80,$rand_str);
            $captcha->showImg();
            $this->session->set_userdata('captcha',strtolower($rand_str));
        }

		public function is_user_logged_in()
		{
			echo $this->data['is_user_logged_in'];
		}
	}
?>
