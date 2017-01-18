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
			if(count($query->result_array()) > 0) {
				return true;
			} else {
				return false;
			}
		}

		public function check_username_by_param($username)
		{
			$this->db->where('username',$username);
			$query = $this->db->get('user');
			if(count($query->result_array()) > 0) {
				return true;
			} else {
				return false;
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

		public function user_overview($this_user, $rows = NULL, $offset = NULL, $activity_tab = NULL)
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

				$this->db->select('link.id as id,title,url,score,link.created as created,vote_link.up_down as up_down,favourite_link.uid as is_favorited,picurl,domain,username,topic,comments,text,is_link_for_union');
                $this->db->from('link');
                $this->db->join('user', 'link.uid = user.id');
				if ( ($activity_tab == 'upvoted') || ($activity_tab == 'downvoted') ) {
					$this->db->join('vote_link', $user['id'].' = vote_link.uid AND link.id = vote_link.link_id');
				} else {
					$this->db->join('vote_link', $user['id'].' = vote_link.uid AND link.id = vote_link.link_id','left');
				}
				if ($activity_tab == 'favourites') {
					$this->db->join('favourite_link', 'favourite_link.uid = user.id AND link.id = favourite_link.link_id');
				} else {
					$this->db->join('favourite_link', 'favourite_link.uid = user.id AND link.id = favourite_link.link_id','left');
				}
			} else {
				$this->db->select('link.id as id,title,url,score,link.created as created,picurl,domain,username,topic,comments,text,is_link_for_union');
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

				$this->db->select('reply.id as id,link.title as title,link.id as url,reply.score as score,reply.created as created,vote_reply.up_down as up_down,favourite_reply.uid as is_favorited,link.picurl as picurl,link.domain as domain,user.username as username,link.topic as topic,reply.comments as comments,content as text,reply.is_link_for_union as is_link_for_union');
				$this->db->from('reply');
				if ( ($activity_tab == 'upvoted') || ($activity_tab == 'downvoted') ) {
					$this->db->join('vote_reply', $user['id'].' = vote_reply.uid AND reply.id = vote_reply.reply_id');
				} else {
					$this->db->join('vote_reply', $user['id'].' = vote_reply.uid AND reply.id = vote_reply.reply_id','left');
				}
				if ($activity_tab == 'favourites') {
					$this->db->join('favourite_reply', 'favourite_reply.uid = '.$user['id'].' AND reply.id = favourite_reply.reply_id');
				} else {
					$this->db->join('favourite_reply', 'favourite_reply.uid = '.$user['id'].' AND reply.id = favourite_reply.reply_id','left');
				}
			} else {
				$this->db->select('reply.id as id,link.title as title,link.id as url,reply.score as score,reply.created as created,link.picurl as picurl,link.domain as domain,user.username as username,link.topic as topic,reply.comments as comments,content as text,reply.is_link_for_union as is_link_for_union');
				$this->db->from('reply');
			}
			//$this->db->order_by("reply.created", "desc");
			$this->db->join('user', 'reply.uid = user.id');
			$this->db->join('link', 'reply.link_id = link.id');
			$this->db->where('reply.uid',$this_user_id);
			$reply_query = $this->db->get_compiled_select();

			if (!$offset) {
				$offset = 0;
			}
			if (!$rows) {
				$limit_clause = '';
			} else {
				$limit_clause = 'LIMIT '.$rows.' OFFSET '.$offset;
			}

			if ($activity_tab == 'upvoted') {
				$query = $this->db->query('SELECT * FROM (' . $link_query . ' UNION ' . $reply_query . ') AS u WHERE u.up_down=1 ORDER BY created desc '.$limit_clause);
			} else if ($activity_tab == 'downvoted') {
				$query = $this->db->query('SELECT * FROM (' . $link_query . ' UNION ' . $reply_query . ') AS u WHERE u.up_down=0 ORDER BY created desc '.$limit_clause);
			} else {
				$query = $this->db->query($link_query . ' UNION ' . $reply_query . ' ORDER BY created desc '.$limit_clause);
			}

			//print_r($this->hash_multirow($query->result_array()));
            return $this->hash_multirow($query->result_array());
		}

		public function user_submitted($this_user, $rows = NULL, $offset = NULL)
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

				$this->db->select('score,link.id,title,url,text,picurl,domain,link.created,username,topic,comments,up_down,is_link_for_union');
                $this->db->from('link');
                $this->db->join('user', 'link.uid = user.id');
				$this->db->join('vote_link', $user['id'].' = vote_link.uid AND link.id = vote_link.link_id','left');
			} else {
				$this->db->select('score,link.id,title,url,text,picurl,domain,link.created,username,topic,comments,is_link_for_union');
                $this->db->from('link');
                $this->db->join('user', 'link.uid = user.id');
			}
            $this->db->limit($rows,$offset);
			$this->db->order_by("created", "desc");

			$this->db->where('link.uid',$this_user_id);

            $query = $this->db->get();

            return $this->hash_multirow($query->result_array());
		}

		public function user_comments($this_user, $rows = NULL, $offset = NULL)
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

				$this->db->select('reply.id as id,link.title as title,link.id as url,reply.score as score,reply.created as created,vote_reply.up_down as up_down,favourite_reply.uid as is_favorited,link.picurl as picurl,link.domain as domain,user.username as username,link.topic as topic,reply.comments as comments,content as text,reply.is_link_for_union as is_link_for_union');
				$this->db->from('reply');
				$this->db->join('vote_reply', $user['id'].' = vote_reply.uid AND reply.id = vote_reply.reply_id','left');
				$this->db->join('favourite_reply', 'favourite_reply.uid = '.$user['id'].' AND reply.id = favourite_reply.reply_id','left');
			} else {
				$this->db->select('reply.id as id,link.title as title,link.id as url,reply.score as score,reply.created as created,link.picurl as picurl,link.domain as domain,user.username as username,link.topic as topic,reply.comments as comments,content as text,reply.is_link_for_union as is_link_for_union');
				$this->db->from('reply');
			}
			$this->db->join('user', 'reply.uid = user.id');
			$this->db->join('link', 'reply.link_id = link.id');
            $this->db->limit($rows,$offset);
			$this->db->order_by("created", "desc");

			$this->db->where('reply.uid',$this_user_id);

            $query = $this->db->get();

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
