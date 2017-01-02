<?php
	class User_model extends CI_Model{

		public function __construct()
		{
			$this->load->database();
		}

		private $salt = 'AtF)b6!F-fCcqJKpnPIe1&Wi)phb!zGkR$xkHQ6A';

        private $expire = 864000; //10 days

        private function add_user_session($username,$password,$remember){

            //$this->session->set_userdata('admin',$username);
            $this->session->set_userdata('username',$username);
            $this->session->set_userdata('logged_in',true);

            if($remember == 'on'){
                $cookie_admin = array(
                    'name'   => 'archnote_admin',
                    'value'  => $username,
                    'expire' => $this->expire,
                );
                $cookie_auth = array(
                    'name'   => 'archnote_auth',
                    'value'  => md5($username.$password),
                    'expire' => $this->expire,
                );

                $this->input->set_cookie($cookie_auth);
                $this->input->set_cookie($cookie_admin);
            }
        }

        public function insert_user()
		{
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $captcha = $this->input->post('captcha');
            $remember = $this->input->post('remember');

            if($captcha <> $this->session->userdata('captcha'))
            {
                return '<p>Verification code error</p>';
            }else
            {
                $data =array(
                    'username' => $username,
                    'email' => $this->input->post('email'),
                    'password' => md5($password),
                    'karma' => 0
                );

                $this->session->set_userdata('username',$username);
                return $this->db->insert('user',$data);
                //$this->add_user_session($username,$password,$remember);
                return '<p>The registration is successful</p>';
                //redirect('hot');
            }
		}
		public function check_username()
		{
			$this->db->where('username',$this->input->post('username'));
			$query = $this->db->get('user');
			if($query->num_rows > 0)
			{
				return count($query->num_rows);
			}
		}

		public function authenticate()
		{

			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', md5($this->input->post('password')));

			$query = $this->db->get('user');
			if ($query->num_rows() > 0) {
				return $query->row();
			}
		}
	}
?>
