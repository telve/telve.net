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
			if (!$this->user_model->check_username_by_param(urldecode($this->uri->segment(2)))) {
				redirect('');
			}

			if ( ($this->uri->segment(3) == '') || is_numeric($this->uri->segment(3)) ) {
				$this->data['offset'] = $this->uri->segment(3);
				$this->data['activity_tab'] = NULL;
				$config['base_url'] = base_url('kullanici/').$this->uri->segment(2).'/';
			} else {
				//if ( (!$this->data['is_user_logged_in']) && ($this->uri->segment(3) != 'gonderileri') && ($this->uri->segment(3) != 'yorumlari') ) redirect( base_url('kullanici/').$this->uri->segment(2).'/' );
				$this->data['offset'] = $this->uri->segment(4);
				$this->data['activity_tab'] = $this->uri->segment(3);
				$config['base_url'] = base_url('kullanici/').$this->uri->segment(2).'/'.$this->uri->segment(3);
			}

			if ( ($this->uri->segment(3) == '') || is_numeric($this->uri->segment(3)) ) {
				$config['total_rows'] = count($this->user_model->user_overview(urldecode($this->uri->segment(2)),NULL,NULL,'overview'));
			} else if ($this->uri->segment(3) == 'gonderileri') {
				$config['total_rows'] = count($this->user_model->user_submitted(urldecode($this->uri->segment(2)),NULL,NULL));
			} else if ($this->uri->segment(3) == 'yorumlari') {
				$config['total_rows'] = count($this->user_model->user_comments(urldecode($this->uri->segment(2)),NULL,NULL));
			} else if ($this->uri->segment(3) == 'evetoylari') {
				$config['total_rows'] = count($this->user_model->user_overview(urldecode($this->uri->segment(2)),NULL,NULL,'upvoted'));
			} else if ($this->uri->segment(3) == 'hayiroylari') {
				$config['total_rows'] = count($this->user_model->user_overview(urldecode($this->uri->segment(2)),NULL,NULL,'downvoted'));
			} else if ($this->uri->segment(3) == 'favorileri') {
				$config['total_rows'] = count($this->user_model->user_overview(urldecode($this->uri->segment(2)),NULL,NULL,'favourites'));
			} else {
				redirect(base_url('kullanici/').$this->uri->segment(2).'/');
			}

            $config['per_page'] = 10;
            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = '<span class="glyphicon glyphicon-arrow-left"></span> <span class="pagination">Önceki sayfa</span>';
            $config['next_link'] = '<span class="pagination">Sonraki sayfa</span> <span class="glyphicon glyphicon-arrow-right"></span>';
            $config['full_tag_close'] = '</p>';
            $config['display_pages'] = FALSE; //The "number" link is not displayed
            $config['first_link'] = FALSE; //The start link is not displayed
            $config['last_link'] = FALSE;
			$config['next_tag_open'] = '<span style="float:right;">';
			$config['next_tag_close'] = "</span>";
            $this->pagination->initialize($config);
			$this->data['per_page'] = $config['per_page'];

			if ( ($this->uri->segment(3) == '') || is_numeric($this->uri->segment(3)) ) {
				$this->data['link'] = $this->user_model->user_overview(urldecode($this->uri->segment(2)),$config['per_page'],$this->data['offset'],'overview');
				$this->data['title'] = urldecode($this->uri->segment(2)).' kullanıcısının özeti';
			} else if ($this->uri->segment(3) == 'gonderileri') {
				$this->data['link'] = $this->user_model->user_submitted(urldecode($this->uri->segment(2)),$config['per_page'],$this->data['offset']);
				$this->data['title'] = urldecode($this->uri->segment(2)).' tarafından gönderilenler';
			} else if ($this->uri->segment(3) == 'yorumlari') {
				$this->data['link'] = $this->user_model->user_comments(urldecode($this->uri->segment(2)),$config['per_page'],$this->data['offset']);
				$this->data['title'] = urldecode($this->uri->segment(2)).' tarafından yapılan yorumlar';
			} else if ($this->uri->segment(3) == 'evetoylari') {
				$this->data['link'] = $this->user_model->user_overview(urldecode($this->uri->segment(2)),$config['per_page'],$this->data['offset'],'upvoted');
				$this->data['title'] = urldecode($this->uri->segment(2)).' kullanıcısının evet oyları';
			} else if ($this->uri->segment(3) == 'hayiroylari') {
				$this->data['link'] = $this->user_model->user_overview(urldecode($this->uri->segment(2)),$config['per_page'],$this->data['offset'],'downvoted');
				$this->data['title'] = urldecode($this->uri->segment(2)).' kullanıcısının hayır oyları';
			} else if ($this->uri->segment(3) == 'favorileri') {
				$this->data['link'] = $this->user_model->user_overview(urldecode($this->uri->segment(2)),$config['per_page'],$this->data['offset'],'favourites');
				$this->data['title'] = urldecode($this->uri->segment(2)).' kullanıcısının favorileri';
			} else {
				redirect(base_url('kullanici/').$this->uri->segment(2).'/');
			}

			foreach ($this->data['link'] as &$link_item) {
				$link_item['seo_segment'] = str_replace(" ","-", strtolower( implode(' ', array_slice( preg_split('/\s+/', preg_replace('/[^a-zA-Z0-9ÇŞĞÜÖİçşğüöı\s]+/', '', $link_item['title']) ), 0, 6) ) ) );
			}
			unset($link_item);

			$this->load->view('templates/header',$this->data);
			$this->load->view('user/index',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

        public function register()
		{

			$this->data['title'] = "Üye ol";

			$reserved_usernames = 'regex_match[/^((?!admin).)*$/i]|regex_match[/^((?!moderator).)*$/i]|regex_match[/^((?!register).)*$/i]|regex_match[/^((?!login).)*$/i]|regex_match[/^((?!logout).)*$/i]|regex_match[/^((?!is_username_available).)*$/i]|regex_match[/^((?!captcha).)*$/i]|regex_match[/^((?!is_user_logged_in).)*$/i]|regex_match[/^((?!allah).)*$/i]';
			$this->form_validation->set_rules('username','<b>Kullanıcı adı</b>','trim|required|min_length[3]|max_length[19]|is_unique[user.username]|'.$reserved_usernames.'|xss_clean');
			$this->form_validation->set_rules('email','<b>E-posta</b>','required|valid_email|is_unique[user.email]|xss_clean');
			$this->form_validation->set_rules('password','<b>Şifre</b>','trim|required|min_length[6]|matches[passconf]|xss_clean');
			$this->form_validation->set_rules('passconf','<b>Şifrenizi doğrulayın</b>','required|xss_clean');
      		$this->form_validation->set_rules('captcha','<b>Doğrulama kodu</b>','trim|required|exact_length[4]|strtolower|xss_clean');

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

			$this->data['title'] = "Giriş yap";
			$this->form_validation->set_rules('username','<b>Kullanıcı adı</b>','required|xss_clean');
			$this->form_validation->set_rules('password','<b>Şifre</b>','required|xss_clean');

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

					$this->data['login_error'] = 'Giriş başarısız, lütfen bilgilerinizi kontrol edin!<br>';
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

            if(strlen($this->input->post('username')) < 3) {
                echo "<span style='color:red'>Kullanıcı adınız en az 3 karakter olmalıdır!</span>";
            } else if(strlen($this->input->post('username')) > 19) {
                echo "<span style='color:red'>Kullanıcı adınız 20 karakterden az olmalıdır!</span>";
            } else {
                if($this->user_model->check_username()){
                    echo "<span style='color:red'>Üzgünüz, bu kullanıcı adı zaten alınmış</span>";
                } else {
                    echo "<span style='color:green'>Kullanıcı adı kullanılabilir</span>";
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
