<?php

	class User extends MY_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('user_model');
			$this->load->model('link_model');
		}

		public function index()
		{
            $this->load->library('pagination');

            $config['base_url'] = base_url('user');

            $config['total_rows'] = count($this->link_model->get_link_count());
            $config['per_page'] = 10;
            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = '<span class="glyphicon glyphicon-arrow-left"></span> <span class="pagination">Previous page</span>';
            $config['next_link'] = '<span class="pagination">Next page</span> <span class="glyphicon glyphicon-arrow-right"></span>';
            $config['full_tag_close'] = '</p>';
            $config['display_pages'] = FALSE; //The "number" link is not displayed
            $config['first_link'] = FALSE; //The start link is not displayed
            $config['last_link'] = FALSE;
			$config['next_tag_open'] = '<span style="float:right;">';
			$config['next_tag_close'] = "</span>";
            $this->pagination->initialize($config);
			$this->data['per_page'] = $config['per_page'];

            $this->data['title'] = 'User';
			$this->data['offset'] = $this->uri->segment(2);
            $this->data['link'] = $this->link_model->retrieve_link($id = FALSE,$config['per_page'],$this->data['offset'],'hot');

			foreach ($this->data['link'] as &$link_item) {
				$link_item['seo_segment'] = str_replace(" ","-", strtolower( implode(' ', array_slice( preg_split('/\s+/', preg_replace('/[^a-zA-Z0-9\s]+/', '', $link_item['title']) ), 0, 6) ) ) );
			}
			unset($link_item);

			$this->load->view('templates/header',$this->data);
			$this->load->view('link/index',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

        public function register()
		{

			$this->data['title'] = "Register a user";

			$reserved_usernames = 'regex_match[/^((?!admin).)*$/i]|regex_match[/^((?!moderator).)*$/i]|regex_match[/^((?!register).)*$/i]|regex_match[/^((?!login).)*$/i]|regex_match[/^((?!logout).)*$/i]|regex_match[/^((?!is_username_available).)*$/i]|regex_match[/^((?!captcha).)*$/i]|regex_match[/^((?!is_user_logged_in).)*$/i]|regex_match[/^((?!allah).)*$/i]';
			$this->form_validation->set_rules('username','username','trim|required|min_length[5]|max_length[12]|is_unique[user.username]|'.$reserved_usernames.'|xss_clean');
			$this->form_validation->set_rules('email','email','required|valid_email|is_unique[user.email]|xss_clean');
			$this->form_validation->set_rules('password','password','trim|required|min_length[6]|matches[passconf]|xss_clean');
			$this->form_validation->set_rules('passconf','confirm password','required|xss_clean');
      		$this->form_validation->set_rules('captcha','verification code','trim|required|exact_length[4]|strtolower|xss_clean');

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
				//$this->load->view('link/index',$this->data);
				//$this->load->view('templates/footer');

        		redirect(''); //default: hot/index
			}

		}

        public function login()
        {

			$this->data['title'] = "Log in";
			$this->form_validation->set_rules('username','username','required|xss_clean');
			$this->form_validation->set_rules('password','password','required|xss_clean');

			if ($this->form_validation->run() == FALSE){

				$this->data['login_error'] = "";
				$this->load->view('templates/header',$this->data);
				$this->load->view('user/login');
				$this->load->view('templates/footer');

			} else {

				if ($this->user_model->authenticate()) {

					$session['username'] = $this->input->post('username');
					$this->session->set_userdata($session);
					redirect(''); //default: hot/index

				} else {

					$this->data['login_error'] = 'Login failed, please check your information!<br>';
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
