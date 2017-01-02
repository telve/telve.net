<?php

	class Link_model extends CI_Model{

		public function __construct()
		{
			$this->load->database();
			$this->load->helper('human_timing');
		}

		public function retrieve_link($id = FALSE,$rows = NULL,$offset=NULL,$sort) //By default, all states are returned
		{

			if($id === FALSE)
            {
                /*
                $sql = "SELECT score,link.id,title,url,link.created,username,category,comments FROM link, user WHERE link.uid = user.id LIMIT ".$rows.",".$rows;
                $query = $this->db->query($sql);
                $query = $this->db->get('link',$rows,$offset);
                */

                $this->db->select('score,link.id,title,url,text,picurl,domain,link.created,username,category,comments');
                $this->db->from('link');
                $this->db->join('user', 'link.uid = user.id');
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
                $query = $this->db->get();

                return $query->result_array();
            }

            $this->db->select('score,link.id,title,url,text,picurl,domain,link.created,username,category,comments');
            $this->db->from('link');
            $this->db->join('user', 'link.uid = user.id');
            $this->db->where('link.id',$id);
            $query = $this->db->get();
            return $query->row_array();
		}

        public function get_link_count($id = FALSE,$rows = NULL,$offset=NULL)
		{

			if($id === FALSE)
            {
                $query = $this->db->get('link',$rows,$offset);
                return $query->result_array(); //返回所有的状态
            }

            $query = $this->db->get_where('link',array('id' => $id )); //返回某一条状态
            return $query->row_array();
		}

        public function retrieve_latest_links($id = FALSE,$rows = NULL,$offset=NULL)
		{

			if($id === FALSE)
            {
                $this->db->order_by('created','desc');
                $query = $this->db->get('status',$rows,$offset);
                return $query->result_array(); //返回所有的状态
            }
            $query = $this->db->get_where('status',array('id' => $id ));
            return $query->row_array();
		}

        //rising
        //controversial

        public function retrieve_top_links($id = FALSE,$rows = NULL,$offset=NULL)
		{

			if($id === FALSE)
            {
                $this->db->order_by('score','desc');
                $query = $this->db->get('status',$rows,$offset);
                return $query->result_array(); //返回所有的状态
            }
            $query = $this->db->get_where('status',array('id' => $id ));
            return $query->row_array();
		}

        //wiki


        public function retrieve_reply_by_id($id)
        {
            //SELECT score,reply.id,content,reply.created,username FROM reply, user WHERE reply.uid = user.id

            $this->db->select('score,comments,reply.id,content,reply.created,username');
            $this->db->from('reply');
            $this->db->where('pid',$id);
            $this->db->join('user','reply.uid = user.id');
            //$this->db->limit($rows,$offset);
            $query = $this->db->get();


            //$query = $this->db->get_where('reply',array('pid' => $id ));
            return $query->result_array();
        }

		public function retrieve_reply_tree_by_id($id)
		{

			$level=0;//深度
            $res ="";
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

			$this->db->select('id,comments,content,uid,score, created');
			$this->db->where('pid',$pid);
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
			$query = $this->db->get('reply');

			if ($query->num_rows() == 0) return;

			if(!$level)
				$res.='<ul style="list-style-type:none;">';
			else
				$res.='<ul style="list-style-type:none;margin-left:14px;padding-left: .8em;border-left: 1px dashed #ccc;">';

            foreach ($query->result_array() as $row)
			{
				$this->db->select('username');
				$this->db->where('id',$row['uid']);
				$query = $this->db->get('user');
				$username = $query->row_array()['username'];
				$ago = human_timing($row['created']);

				$res.='<li>';

                $res.="<!--One reply from the reply tree of this post-->
                <div>
				<div class='row-fluid'>

					<div class='span12'>
						<style>

                        </style>

						<div id='switch' style='margin-bottom:4px;color: #888;'>
							<a class='hide_up login-required' href='javascript:void(0)' id='".$row['id']."' onclick='rply_up(this)'><i class='icon-thumbs-up'></i></a>

							<a style='color: gray;' id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>

                            <a style='color: #369;font-weight: bold;' href='#'>".$username."</a>&nbsp;&nbsp;<span id='show-".$row['id']."'>".$row['score']."</span> points&nbsp;&nbsp;submitted ".$ago."
                            &nbsp;<span style='color: gray;'>
								(<a style='color: gray;' class='hide_rply' href='".base_url('comments/view')."/".$row['id']."'> ".$row['comments']." replies </a>)</small></span>
						</div>

						<div class='hide_content' style='margin-bottom:6px;'>
                            <a class='login-required' href='javascript:void(0)' id='".$row['id']."' onclick='rply_down(this)'><i class='icon-thumbs-down'></i></a>

                            <span>".$row['content']."</span>
                            <!--<input type='hidden' class='show' value='".$row['id']."'/>-->
						</div>

						<div class='hide_function' style='margin-bottom:8px;'>
							<div style='color: #888;font-weight: bold;padding: 0 1px;'>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a style='color: #888;' href='#'>favorite&#9733;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a style='color: #888;' href='#'>report&#9873;</a>&nbsp;&nbsp;&nbsp;&nbsp;</small><a style='color: #888;' href='javascript:void(0)' onclick='set_reply(this)' id='".$row['id']."'><small>reply&#9889;</small></a>
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

            $data = array(
				'title' => $this->input->post('title'),
                'url' => $url,
				'text' => $this->input->post('text'),
				'picurl' => $this->find_largest_image($url),
                'domain' => $parse['host'],
                'category' => $this->input->post('category'),
                'uid' => $row['id'], //User's ID
				'score' => 0,
				'comments' => 0
			);

			$this->db->insert('link',$data);
			return $this->db->insert_id();
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
				'pid' => $this->input->post('pid'),
                'uid' => $row['id'],
				'score' => 0,
				'comments' => 0
			);

			return $this->db->insert('reply',$data);
		}

        public function up_score()
		{
            $id = $this->input->post('id');
            $this->db->where('id',$id);
			$this->db->set('score', 'score+1', FALSE);
			$this->db->update('link');
		}

		public function down_score()
		{
			$id = $this->input->post('id');
            $this->db->where('id',$id);
			$this->db->set('score', 'score-1', FALSE);
			$this->db->update('link');
		}

        public function rply_up_score()
		{
			$id = $this->input->post('id');
            $this->db->where('id',$id);
			$this->db->set('score', 'score+1', FALSE);
			$this->db->update('reply');
		}

		public function rply_down_score()
		{
			$id = $this->input->post('id');
            $this->db->where('id',$id);
			$this->db->set('score', 'score-1', FALSE);
			$this->db->update('reply');
		}

        public function increase_comments()
		{
            $id = $this->input->post('pid');
            $this->db->where('id',$id);
			$this->db->set('comments', 'comments+1', FALSE);
			$this->db->update('link');
		}

		public function increase_rply_comments()
		{
            $id = $this->input->post('pid');
            $this->db->where('id',$id);
			$this->db->set('comments', 'comments+1', FALSE);
			$this->db->update('reply');
		}

		private function find_largest_image($url)
		{
			$this->load->library("simple_html_dom");
			$html = new Simple_html_dom();
			$html->load_file($url);

			$biggestImage = 'path to "no image found" image'; // Is returned when no images are found.
			$maxSize = -1;
			$visited = array();
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
			    // get image
			    $image=@getimagesize($imageurl);// get the rest images width and height
			    if (($image[0] * $image[1]) > $maxSize) {
			        $maxSize = $image[0] * $image[1];  //compare sizes
			        $biggest_img = $imageurl;
			    }
			}
			return $biggest_img; //return the biggest found image
			//return implode(" | ", $visited);
		}

	}
?>
