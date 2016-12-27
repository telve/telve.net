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

			$this->form_validation->set_rules('username','username','trim|required|min_length[5]|max_length[12]|is_unique[user.username]');
			$this->form_validation->set_rules('email','email','required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password','password','trim|required|min_length[6]|matches[passconf]');
			$this->form_validation->set_rules('passconf','confirm password','required');
      		$this->form_validation->set_rules('captcha','verification code','trim|required|exact_length[4]|strtolower');

			if($this->form_validation->run()=== FALSE)
			{
				$this->load->view('templates/header',$this->data);
				$this->load->view('user/register');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->user_model->reg_user();

        //$this->load->view('templates/header',$this->data);
				//$this->load->view('home/index',$this->data);
				//$this->load->view('templates/footer');

        redirect('home');
			}

		}

        public function login()
        {

			$this->data['title'] = "登录";
			$this->form_validation->set_rules('username','username','required');
			$this->form_validation->set_rules('password','password','required');

			if ($this->form_validation->run() == FALSE){
				$this->data['data'] = "出错";
				$this->load->view('templates/header',$this->data);
				$this->load->view('user/login');
				$this->load->view('templates/footer');
			}else{

				if($this->user_model->login_check()) {

					$session['username'] = $this->input->post('username');;

					$this->session->set_userdata($session);

					redirect('');//登录成功

				} else {
					//$this->data['title'] = '登录';
					$this->data['title'] = '登录失败了，请检查你的信息！';
					$this->load->view('templates/header',$this->data);
					$this->load->view('user/login');
					$this->load->view('templates/footer');
				}
			}
        }

        public function logout()
        {

            $this->session->sess_destroy();
			redirect(''); //default: home/index
        }

        public function chk_username()
        {

            if(strlen($this->input->post('username'))<6)
            {
                echo "<span style='color:red'>无效的用户名</span>";
            }else{
                if($this->user_model->get_username()){
                    echo "<span style='color:red'>该用户名已存在</span>";
                }else{
                    echo "<span style='color:green'>该用户名可用</span>";
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
	}
    ?>
