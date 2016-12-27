<?php

	class User extends CI_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('user_model');
		}

        public function register()
		{

			$data['title'] = "Register a user";

			$this->form_validation->set_rules('username','username','trim|required|min_length[5]|max_length[12]|is_unique[user.username]');
			$this->form_validation->set_rules('email','email','required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password','password','trim|required|min_length[6]|matches[passconf]');
			$this->form_validation->set_rules('passconf','confirm password','required');
      		$this->form_validation->set_rules('captcha','verification code','trim|required|exact_length[4]|strtolower');

			if(!empty($this->session->userdata['username']) && $this->session->userdata['username']){
				$data['login_info'] = "<div class='pull-right'>".$this->session->userdata('username')."(<abbr title='Link integration'><strong>1</strong></abbr>) | <a href='#'><i class='icon-envelope'></i></a> | <strong><a href='#'>Preference</a></strong> | <a href='".base_url('user/logout')."'>Log out</a> </div><br />";

				$data['login_form'] = "";//不显示登录表单
			}else{
				$data['login_info'] = "<a href='#myModal' data-toggle='modal'><span style='color:gray;'>Want to join?</span> Log in or sign up <span style='color:gray;'>in seconds</span></a>";
				$data['login_form'] = "
					<table class='table table-bordered'>
						<tr><td>
							".form_open('user/login')."
							<input type='text' class='span6' name='username' placeholder='username'>
							<input type='password' class='span6 pull-right' name='password' placeholder='password'>
							<br><br>
							<label class='checkbox span4'>
							<input type='checkbox'>remember me
							</label>

							<a class='checkbox' href='/password'>forgot password?</a>
							<button type='submit' class='btn pull-right'>log in</button>
							</form>
						</tr></td>
					</table>

				";
			}

			if($this->form_validation->run()=== FALSE)
			{
				$this->load->view('templates/header',$data);
				$this->load->view('user/register');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->user_model->reg_user();

        //$this->load->view('templates/header',$data);
				//$this->load->view('iyourl/index',$data);
				//$this->load->view('templates/footer');

        redirect('iyourl');
			}

		}

        public function login()
        {

			$data['title'] = "登录";
			$this->form_validation->set_rules('username','username','required');
			$this->form_validation->set_rules('password','password','required');

			if(!empty($this->session->userdata['username']) && $this->session->userdata['username']){
				$data['login_info'] = "<div class='pull-right'>".$this->session->userdata('username')."(<abbr title='Link integration'><strong>1</strong></abbr>) | <a href='#'><i class='icon-envelope'></i></a> | <strong><a href='#'>Preference</a></strong> | <a href='".base_url('user/logout')."'>Log out</a> </div><br />";

				$data['login_form'] = "";//不显示登录表单
			}else{
				$data['login_info'] = "<a href='#myModal' data-toggle='modal'><span style='color:gray;'>Want to join?</span> Log in or sign up <span style='color:gray;'>in seconds</span></a>";
				$data['login_form'] = "
					<table class='table table-bordered'>
						<tr><td>
							".form_open('user/login')."
							<input type='text' class='span6' name='username' placeholder='username'>
							<input type='password' class='span6 pull-right' name='password' placeholder='password'>
							<br><br>
							<label class='checkbox span4'>
							<input type='checkbox'>remember me
							</label>

							<a class='checkbox' href='/password'>forgot password?</a>
							<button type='submit' class='btn pull-right'>log in</button>
							</form>
						</tr></td>
					</table>

				";
			}
			
			if ($this->form_validation->run() == FALSE){
				$data['data'] = "出错";
				$this->load->view('templates/header',$data);
				$this->load->view('user/login');
				$this->load->view('templates/footer');
			}else{

				if($this->user_model->login_check()) {

					$session['username'] = $this->input->post('username');;

					$this->session->set_userdata($session);

					redirect('');//登录成功

				} else {
					//$data['title'] = '登录';
					$data['title'] = '登录失败了，请检查你的信息！';
					$this->load->view('templates/header',$data);
					$this->load->view('user/login');
					$this->load->view('templates/footer');
				}
			}
        }

        public function logout()
        {

            $this->session->sess_destroy();
			redirect(''); //default: iyourl/index
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
