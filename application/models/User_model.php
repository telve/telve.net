<?php
	class User_model extends CI_Model{

		public function __construct()
		{
			$this->load->database();
			$this->load->library('hashids');
			$this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
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

		public function user_overview($this_user, $rows = NULL, $offset = NULL) //By default, all states are returned
		{
			$this->db->where('username',$this_user);
			$this->db->select('id');
			$this->db->limit(1);
			$query_for_this_user = $this->db->get('user');
			$this_user_id = $query_for_this_user->row_array()['id'];

			if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
				$this->db->where('username',$this->session->userdata('username'));
				$this->db->select('id');
				$this->db->limit(1);
				$query_for_uid = $this->db->get('user');
				$user = $query_for_uid->row_array();

				$this->db->select('link.id,link.id,title,url,link.uid,score,link.created,up_down,link.uid,picurl,domain,username,topic,comments');
                $this->db->from('link');
                $this->db->join('user', 'link.uid = user.id');
				$this->db->join('vote_link', $user['id'].' = vote_link.uid AND link.id = vote_link.link_id','left');
			} else {
				$this->db->select('link.id,link.id,title,url,score,link.created,picurl,domain,username,topic,comments');
                $this->db->from('link');
                $this->db->join('user', 'link.uid = user.id');
			}
            //$this->db->limit($rows,$offset);
			//$this->db->order_by("created", "desc");
			$this->db->where('link.uid',$this_user_id);
            $link_query = $this->db->get_compiled_select();

			if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
				$this->db->where('username',$this->session->userdata('username'));
				$this->db->select('id');
				$this->db->limit(1);
				$query_for_uid = $this->db->get('user');
				$user = $query_for_uid->row_array();

				$this->db->select('reply.id,comments,content,content,reply.uid,score,reply.created,up_down,favourite_reply.uid as is_favorited,content,content,content,content,comments');
				$this->db->from('reply');
				$this->db->join('vote_reply', $user['id'].' = vote_reply.uid AND reply.id = vote_reply.reply_id','left');
				$this->db->join('favourite_reply', 'favourite_reply.uid = '.$user['id'].' AND reply.id = favourite_reply.reply_id','left');
			} else {
				$this->db->select('id,comments,content,content,uid,score,created,content,content,content,comments');
				$this->db->from('reply');
			}
			//$this->db->order_by("reply.created", "desc");
			$reply_query = $this->db->get_compiled_select();

			$query = $this->db->query($link_query . ' UNION ' . $reply_query . 'ORDER BY created desc');

			//print_r($query->result_array());
            return $this->hash_multirow($query->result_array());
		}

		private function hash_multirow($multirow) {
			foreach ($multirow as &$row) {
				$row['id'] = $this->hashids->encode($row['id']);
			}
			unset($row);
			return $multirow;
		}

		private function hash_row($row) {
			$row['id'] = $this->hashids->encode($row['id']);
			return $row;
		}
	}
?>
