<?php

	class Link_model extends CI_Model{

		public function __construct()
		{
			$this->load->database();
			$this->load->helper('human_timing');
			$this->load->library('hashids');
			$this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
		}

		public function retrieve_link($id = FALSE, $rows = NULL, $offset = NULL, $sort = NULL, $topic = NULL, $domain = NULL) //By default, all states are returned
		{

			if($id === FALSE)
            {
                /*
                $sql = "SELECT score,link.id,title,url,link.created,username,topic,comments FROM link, user WHERE link.uid = user.id LIMIT ".$rows.",".$rows;
                $query = $this->db->query($sql);
                $query = $this->db->get('link',$rows,$offset);
                */

				if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
					$this->db->where('username',$this->session->userdata('username'));
					$this->db->select('id');
					$this->db->limit(1);
					$query_for_uid = $this->db->get('user');
					$user = $query_for_uid->row_array();

					$this->db->select('score,link.id,title,url,text,picurl,domain,link.created,username,topic,comments,up_down');
	                $this->db->from('link');
	                $this->db->join('user', 'link.uid = user.id');
					$this->db->join('vote_link', $user['id'].' = vote_link.uid AND link.id = vote_link.link_id','left');
				} else {
					$this->db->select('score,link.id,title,url,text,picurl,domain,link.created,username,topic,comments');
	                $this->db->from('link');
	                $this->db->join('user', 'link.uid = user.id');
				}
                $this->db->limit($rows,$offset);
				if ($sort == 'new') {
					$this->db->order_by("created", "desc");
				} else if ($sort == 'rising') {
					$this->db->order_by("(200 * score) + (.1 * link.created) + (60 * comments) DESC");
				} else if ($sort == 'controversial') {
					$this->db->order_by("comments", "desc");
				} else if ($sort == 'top') {
					$this->db->order_by("score", "desc");
				} else if ($sort == 'hot') {
					$this->db->order_by("(400 * score) + (.1 * link.created) + (120 * comments) DESC");
				}
				if ($topic) {
					$this->db->where('topic',$topic);
				}
				if ($domain) {
					$this->db->where('domain',$domain);
				}
                $query = $this->db->get();

                return $this->hash_multirow($query->result_array());
            }

			$id = $this->hashids->decode($id)[0];
			if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
				$this->db->where('username',$this->session->userdata('username'));
				$this->db->select('id');
				$this->db->limit(1);
				$query_for_uid = $this->db->get('user');
				$user = $query_for_uid->row_array();

				$this->db->select('score,link.id,title,url,text,picurl,domain,link.created,username,topic,comments,up_down');
	            $this->db->from('link');
	            $this->db->join('user', 'link.uid = user.id');
				$this->db->join('vote_link', $user['id'].' = vote_link.uid AND link.id = vote_link.link_id','left');
			} else {
				$this->db->select('score,link.id,title,url,text,picurl,domain,link.created,username,topic,comments');
	            $this->db->from('link');
	            $this->db->join('user', 'link.uid = user.id');
			}
            $this->db->where('link.id',$id);
            $query = $this->db->get();
            return $this->hash_row($query->row_array());
		}

        public function get_link_count($id = FALSE, $rows = NULL, $offset = NULL, $topic = NULL, $domain = NULL)
		{

			if($id === FALSE)
            {
				if ($topic) {
					$this->db->where('topic',$topic);
				}
				if ($domain) {
					$this->db->where('domain',$domain);
				}
                $query = $this->db->get('link',$rows,$offset);
                return $this->hash_multirow($query->result_array());
            }

			$id = $this->hashids->decode($id)[0];
            $query = $this->db->get_where('link',array('id' => $id )); //返回某一条状态
            return $this->hash_row($query->row_array());
		}

        public function retrieve_reply_by_id($id)
        {
            //SELECT score,reply.id,content,reply.created,username FROM reply, user WHERE reply.uid = user.id

			$id = $this->hashids->decode($id)[0];
            $this->db->select('score,comments,reply.id,content,reply.created,username');
            $this->db->from('reply');
            $this->db->where('pid',$id);
            $this->db->join('user','reply.uid = user.id');
            //$this->db->limit($rows,$offset);
            $query = $this->db->get();


            //$query = $this->db->get_where('reply',array('pid' => $id ));
            return $this->hash_multirow($query->result_array());
        }

		public function retrieve_reply_tree_by_id($id)
		{

			$level = 0; //depth
            $res = "";
			return $this->display_children($id,$level,$res);

		}

		/*
		private function display_children($pid,$level,&$res) //这里的&要好好研究下
		{

			$this->db->select('id,content,comments');
			$this->db->where('pid',$pid);
			$query = $this->db->get('reply');

			if ($query->num_rows() == 0) return;

            $res.='<ul>';

            foreach ($query->result_array() as $row)
			{
				$res.='<li>';

                $res.=$row['content'].($row['comments']);

                $this->display_children($row['id'],$level+1,$res);

                $res.='</li>';
			}

            return $res.='</ul>';
        }*/


		private function display_children($pid,$level,&$res)
		{
			$pid = $this->hashids->decode($pid)[0];

			if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
				$this->db->where('username',$this->session->userdata('username'));
				$this->db->select('id');
				$this->db->limit(1);
				$query_for_uid = $this->db->get('user');
				$user = $query_for_uid->row_array();

				$this->db->select('reply.id,comments,content,reply.uid,score, created,up_down');
				$this->db->from('reply');
				$this->db->where('pid',$pid);
				$this->db->join('vote_reply', $user['id'].' = vote_reply.uid AND reply.id = vote_reply.reply_id','left');
			} else {
				$this->db->select('id,comments,content,uid,score, created');
				$this->db->from('reply');
				$this->db->where('pid',$pid);
			}

			if(!$level)
				$this->db->where('is_parent_link',1);
			else
				$this->db->where('is_parent_link',0);

			if (!$this->input->get('nolimit')) {
				$this->db->limit(20);
			}
			if ($this->input->get('sort') == 'top') {
				$this->db->order_by("score", "desc");
			} else if ($this->input->get('sort') == 'new') {
				$this->db->order_by("created", "desc");
			} else if ($this->input->get('sort') == 'controversial') {
				$this->db->order_by("comments", "desc");
			} else if ($this->input->get('sort') == 'old') {
				$this->db->order_by("created", "asc");
			} else {
				//$this->db->where('created >= DATE_SUB(NOW(),INTERVAL 1 HOUR)'); //https://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html
				$this->db->order_by("(8 * score) + (.1 * created) + (6 * comments) DESC");
				//echo $this->db->last_query();
			}
			$query = $this->db->get();

			if ($query->num_rows() == 0) return;

			if(!$level)
				$res.='<ul style="list-style-type:none;">';
			else
				$res.='<ul style="list-style-type:none; margin-left:14px; padding-left:.8em; border-left:solid 1px rgba(0, 0, 0, .2);">';

            foreach ($this->hash_multirow($query->result_array()) as $row)
			{
				$this->db->select('username');
				$this->db->where('id',$row['uid']);
				$query = $this->db->get('user');
				$username = $query->row_array()['username'];
				$ago = human_timing($row['created']);

				if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
					$up_style = ($row['up_down'] == 1 ? 'color:green;' : 'color:black;');
					$down_style = ( (!($row['up_down'] == '') && ($row['up_down'] == 0)) ? 'color:red;' : 'color:black;');
				} else {
					$up_style = 'color:black;';
					$down_style = 'color:black;';
				}

				$res.='<li>';

                $res.="<!--One reply from the reply tree of this post-->
                <div>
				<div class='row-fluid'>

					<div class='span12'>
						<style>

                        </style>

						<div id='switch' style='margin-bottom:4px;color: #888;'>
							<a class='hide_up login-required' href='javascript:void(0)' id='".$row['id']."' onclick='rply_up(this)'><i class='glyphicon glyphicon-arrow-up' style='".$up_style."'></i></a>

							<a style='color: gray;' id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>

                            <a style='color: #369;font-weight: bold;' href='#'>".$username."</a>&nbsp;&nbsp;<span id='show-".$row['id']."'>".$row['score']."</span> points&nbsp;&nbsp;submitted ".$ago."
                            &nbsp;<span style='color: gray;'>
								(<a style='color: gray;' class='hide_rply' href=''> ".$row['comments']." <span class='glyphicon glyphicon-comment' style='font-size:10px;'></span> </a>)</small></span>
						</div>

						<div class='hide_content' style='margin-bottom:6px;'>
                            <a class='login-required' href='javascript:void(0)' id='".$row['id']."' onclick='rply_down(this)'><i class='glyphicon glyphicon-arrow-down' style='".$down_style."'></i></a>

                            <span>".$row['content']."</span>
                            <!--<input type='hidden' class='show' value='".$row['id']."'/>-->
						</div>

						<div class='hide_function' style='margin-bottom:8px;'>
							<div style='color: #888;font-weight: bold;padding: 0 1px;'>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a style='color: #888;' href='#'>favorite<span class='glyphicon glyphicon-star-empty'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a style='color: #888;' href='#'>report<span class='glyphicon glyphicon-flag'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;</small><a style='color: #888;' href='javascript:void(0)' onclick='set_reply(this)' id='".$row['id']."'><small>reply<span class='glyphicon glyphicon-share-alt special-reply-icon'></span></small></a>
							</div>
						</div>
					</div>

				</div>

				</div>
				<!--One reply from the reply tree of this post-->";

				$this->display_children($row['id'], $level+1,$res);
                $res.='</li>';
			}
			return $res.='</ul>';
        }

		public function insert_link()
		{
			$this->db->where('username',$this->session->userdata('username'));
			$this->db->select('id');
			$this->db->limit(1);
			$query = $this->db->get('user');
			$row = $query->row_array();

            $url = $this->input->post('url');
			$parse = parse_url($url);

			$topic = str_replace(' ', '', $this->input->post('topic'));
			$topic = preg_replace('/[^a-zA-Z0-9]+/', '', $topic);

            $data = array(
				'title' => $this->input->post('title'),
                'url' => $url,
				'text' => $this->input->post('text'),
				'picurl' => $this->find_largest_image($url),
                'domain' => $parse['host'],
                'topic' => strtoupper($topic),
                'uid' => $row['id'], //User's ID
				'score' => 0,
				'comments' => 0
			);

			$this->db->insert('link',$data);
			return $this->hashids->encode($this->db->insert_id());
		}

        public function insert_reply()
		{
            $this->db->where('username',$this->session->userdata('username'));
			$this->db->select('id');
			$this->db->limit(1);
			$query = $this->db->get('user');
			$row = $query->row_array();

            $data = array(
				'content' => $this->input->post('content'),
				'pid' => $this->hashids->decode($this->input->post('pid'))[0],
                'uid' => $row['id'],
				'score' => 0,
				'comments' => 0,
				'is_parent_link' => $this->input->post('is_parent_link')
			);

			return $this->db->insert('reply',$data);
		}

        public function up_score()
		{
            $id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];
            $this->db->where('id',$id);
			$this->db->set('score', 'score+1', FALSE);
			$this->db->update('link');
		}

		public function down_score()
		{
			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];
            $this->db->where('id',$id);
			$this->db->set('score', 'score-1', FALSE);
			$this->db->update('link');
		}

        public function rply_up_score()
		{
			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];
            $this->db->where('id',$id);
			$this->db->set('score', 'score+1', FALSE);
			$this->db->update('reply');
		}

		public function rply_down_score()
		{
			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];
            $this->db->where('id',$id);
			$this->db->set('score', 'score-1', FALSE);
			$this->db->update('reply');
		}

        public function increase_comments()
		{
            $id = $this->input->post('pid');
			$id = $this->hashids->decode($id)[0];
            $this->db->where('id',$id);
			$this->db->set('comments', 'comments+1', FALSE);
			$this->db->update('link');
		}

		public function increase_rply_comments()
		{
            $id = $this->input->post('pid');
			$id = $this->hashids->decode($id)[0];
            $this->db->where('id',$id);
			$this->db->set('comments', 'comments+1', FALSE);
			$this->db->update('reply');
		}

		private function find_largest_image($url)
		{
			$this->load->library("simple_html_dom");
			$html = new Simple_html_dom();
			$html->load_file($url);

			$biggestImage = ''; // Is returned when no images are found.
			$maxSize = 0;
			$visited = array();
			$forOnce = '';
			foreach($html->find('img') as $element) {
			    $src = $element->src;
			    if($src=='')continue;// it happens on your test url
				if (strpos($src, '://') !== false) {
					$imageurl = $src;
				} elseif (substr( $src, 0, 2 ) === "//") {
					$imageurl = 'http:'.$src;
				} else {
					$parse = parse_url($url);
			    	$imageurl = $parse['scheme'].'://'.$parse['host'].'/'.$src;//get image absolute url
				}
			    // ignore already seen images, add new images
			    if(in_array($imageurl, $visited))continue;
				$visited[]=$imageurl;

				// get original size of first image occurrence without any width and height attribute
				if ( (empty($element->width) || $element->width == 0) && (empty($element->height) || $element->height == 0) && (empty($forOnce)) ) {
				     $image=@getimagesize($imageurl); // get the rest images width and height
					 $forOnce = $imageurl;
					 if ($image[0] > $maxSize) {
	 			        $maxSize = $image[0];
	 			        $biggest_img = $imageurl;
	 			    } else if ($image[1] > $maxSize) {
	 			        $maxSize = $image[1];
	 			        $biggest_img = $imageurl;
	 			    }
				}

			    if ($element->width > $maxSize) {
			        $maxSize = $element->width;  //compare sizes
			        $biggest_img = $imageurl;
			    } else if ($element->height > $maxSize) {
			        $maxSize = $element->height;  //compare sizes
			        $biggest_img = $imageurl;
			    }
			}
			return $biggest_img; //return the biggest found image
			//return implode(" | ", $visited);
		}

		public function retrieve_topics() {
			$this->db->select('topic, COUNT(*) as topic_occurrence');
			$this->db->from('link');
			$this->db->group_by('topic');
			$this->db->order_by('topic_occurrence','desc');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function random_topic() {
			$this->db->select('topic');
			$this->db->from('link');
			$this->db->group_by('topic');
			$this->db->order_by('rand()');
			$this->db->limit(1);
			$query = $this->db->get();
			return $query->row_array();
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
