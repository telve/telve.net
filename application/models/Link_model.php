<?php

    class Link_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            $this->load->helper('security');
            $this->load->helper('human_timing');
            $this->load->helper('markdown');
            $this->load->helper('telveflavor');
            $this->load->library('hashids');
            $this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
            $this->load->helper('tr_lang');
            $this->load->helper('link_submission');
            $this->load->library('image_lib');
        }

        public function retrieve_link($id = false, $rows = null, $offset = null, $sort = null, $topic = null, $domain = null, $search_query = null) //By default, all states are returned
        {
            if ($id === false) {
                /*
                $sql = "SELECT score,link.id,title,url,link.created,username,topic,comments FROM link, user WHERE link.uid = user.id LIMIT ".$rows.",".$rows;
                $query = $this->db->query($sql);
                $query = $this->db->get('link',$rows,$offset);
                */


                if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->select('id');
                    $this->db->limit(1);
                    $query_for_uid = $this->db->get('user');
                    $user = $query_for_uid->row_array();

                    $this->db->select('score,link.id,title,url,text,embed,picurl,domain,link.created,username,topic,comments,up_down');
                    $this->db->from('link');
                    $this->db->join('user', 'link.uid = user.id');
                    $this->db->join('vote_link', $user['id'].' = vote_link.uid AND link.id = vote_link.link_id', 'left');
                } else {
                    $this->db->select('score,link.id,title,url,text,embed,picurl,domain,link.created,username,topic,comments');
                    $this->db->from('link');
                    $this->db->join('user', 'link.uid = user.id');
                }
                $this->db->limit($rows, $offset);
                if ($sort == 'new') {
                    $this->db->order_by("created", "desc");
                } elseif ($sort == 'rising') {
                    $this->db->order_by("(200 * score) + (.1 * link.created) + (60 * comments) DESC");
                } elseif ($sort == 'controversial') {
                    $this->db->order_by("comments", "desc");
                } elseif ($sort == 'top') {
                    $this->db->order_by("score", "desc");
                } elseif ($sort == 'hot') {
                    $this->db->order_by("(100 * score) + (.001 * link.created) + (1000 * comments) DESC");
                }
                if ($topic) {
                    $this->db->where('topic', $topic);
                }
                if ($domain) {
                    $this->db->where('domain', $domain);
                }
                if ($search_query) {
                    $this->db->where('MATCH (link.title) AGAINST ("'.$search_query.'")', null, false);
                    $this->db->or_where('MATCH (link.text) AGAINST ("'.$search_query.'")', null, false);
                    $this->db->or_where('MATCH (link.domain) AGAINST ("'.$search_query.'")', null, false);
                    $this->db->or_where('MATCH (link.url) AGAINST ("'.$search_query.'")', null, false);
                    $this->db->or_where('MATCH (link.topic) AGAINST ("'.$search_query.'")', null, false);
                }
                $query = $this->db->get();

                return $this->hash_multirow($query->result_array());
            }

            $id = $this->hashids->decode($id)[0];
            if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->select('id');
                $this->db->limit(1);
                $query_for_uid = $this->db->get('user');
                $user = $query_for_uid->row_array();

                $this->db->select('score,link.id,title,url,text,embed,picurl,domain,link.created,username,topic,comments,up_down,favourite_link.uid as is_favorited');
                $this->db->from('link');
                $this->db->join('user', 'link.uid = user.id');
                $this->db->join('vote_link', $user['id'].' = vote_link.uid AND link.id = vote_link.link_id', 'left');
                $this->db->join('favourite_link', $user['id'].' = favourite_link.uid AND link.id = favourite_link.link_id', 'left');
            } else {
                $this->db->select('score,link.id,title,url,text,embed,picurl,domain,link.created,username,topic,comments');
                $this->db->from('link');
                $this->db->join('user', 'link.uid = user.id');
            }
            $this->db->where('link.id', $id);
            $query = $this->db->get();
            return $this->hash_row($query->row_array());
        }

        public function get_link_count($id = false, $rows = null, $offset = null, $topic = null, $domain = null, $search_query = null)
        {
            if ($id === false) {
                if ($topic) {
                    $this->db->where('topic', $topic);
                }
                if ($domain) {
                    $this->db->where('domain', $domain);
                }
                if ($search_query) {
                    $this->db->where('MATCH (link.title) AGAINST ("'.$search_query.'")', null, false);
                    $this->db->or_where('MATCH (link.text) AGAINST ("'.$search_query.'")', null, false);
                    $this->db->or_where('MATCH (link.domain) AGAINST ("'.$search_query.'")', null, false);
                    $this->db->or_where('MATCH (link.url) AGAINST ("'.$search_query.'")', null, false);
                    $this->db->or_where('MATCH (link.topic) AGAINST ("'.$search_query.'")', null, false);
                }
                $query = $this->db->get('link', $rows, $offset);
                return count($query->result_array());
            }

            $id = $this->hashids->decode($id)[0];
            $query = $this->db->get_where('link', array('id' => $id )); //返回某一条状态
            return $this->hash_row($query->row_array());
        }

        public function get_total_reply_count()
        {
            $query = $this->db->get('reply');
            return count($query->result_array());
        }

        public function get_total_topic_count()
        {
            $query = $this->db->get('topic');
            return count($query->result_array());
        }

        public function retrieve_reply_by_id($id)
        {
            //SELECT score,reply.id,content,reply.created,username FROM reply, user WHERE reply.uid = user.id

            $id = $this->hashids->decode($id)[0];
            $this->db->select('score,comments,reply.id,content,reply.created,username');
            $this->db->from('reply');
            $this->db->where('pid', $id);
            $this->db->join('user', 'reply.uid = user.id');
            //$this->db->limit($rows,$offset);
            $query = $this->db->get();


            //$query = $this->db->get_where('reply',array('pid' => $id ));
            return $this->hash_multirow($query->result_array());
        }

        public function retrieve_reply_tree_by_id($id)
        {
            $level = 0; //depth
            $res = "";
            return $this->display_children($id, $level, $res);
        }

        private function display_children($pid, $level, &$res)
        {
            $Parsedown = new Parsedown();
            $pid = $this->hashids->decode($pid)[0];

            if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->select('id');
                $this->db->limit(1);
                $query_for_uid = $this->db->get('user');
                $user = $query_for_uid->row_array();

                $this->db->select('reply.id,comments,content,reply.uid,score,reply.created,up_down,favourite_reply.uid as is_favorited');
                $this->db->from('reply');
                $this->db->where('pid', $pid);
                $this->db->join('vote_reply', $user['id'].' = vote_reply.uid AND reply.id = vote_reply.reply_id', 'left');
                $this->db->join('favourite_reply', 'favourite_reply.uid = '.$user['id'].' AND reply.id = favourite_reply.reply_id', 'left');
            } else {
                $this->db->select('id,comments,content,uid,score,created');
                $this->db->from('reply');
                $this->db->where('pid', $pid);
            }

            if (!$level) {
                $this->db->where('is_parent_link', 1);
            } else {
                $this->db->where('is_parent_link', 0);
            }

            if (!$this->input->get('nolimit')) {
                $this->db->limit(20);
            }
            if ($this->input->get('sirala') == 'zirve') {
                $this->db->order_by("score", "desc");
            } elseif ($this->input->get('sirala') == 'yeni') {
                $this->db->order_by("reply.created", "desc");
            } elseif ($this->input->get('sirala') == 'tartismali') {
                $this->db->order_by("comments", "desc");
            } elseif ($this->input->get('sirala') == 'eski') {
                $this->db->order_by("reply.created", "asc");
            } else {
                //$this->db->where('reply.created >= DATE_SUB(NOW(),INTERVAL 1 HOUR)'); //https://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html
                $this->db->order_by("(8 * score) + (.1 * reply.created) + (6 * comments) DESC");
                //echo $this->db->last_query();
            }
            $query = $this->db->get();

            if ($query->num_rows() == 0) {
                return;
            }

            if (!$level) {
                $res.='<ul style="list-style-type:none;">';
            } else {
                $res.='<ul style="list-style-type:none; margin-left:14px; padding-left:.8em; border-left:solid 1px rgba(0, 0, 0, .2);">';
            }

            foreach ($this->hash_multirow($query->result_array()) as $row) {
                $this->db->select('username');
                $this->db->where('id', $row['uid']);
                $query = $this->db->get('user');
                $username = $query->row_array()['username'];
                $ago = human_timing($row['created']);

                if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
                    $up_style = ($row['up_down'] == 1 ? 'color:green;' : 'color:black;');
                    $down_style = ((!($row['up_down'] == '') && ($row['up_down'] == 0)) ? 'color:red;' : 'color:black;');
                } else {
                    $up_style = 'color:black;';
                    $down_style = 'color:black;';
                }

                $favourite_onclick = (isset($row['is_favorited']) ? 'unfavourite_reply(this)' : 'favourite_reply(this)');
                $favourite_html = (isset($row['is_favorited']) ? 'favori<span class="glyphicon glyphicon-star"></span>' : 'favori<span class="glyphicon glyphicon-star-empty"></span>');

                $res.='<li>';

                $res.="<!--One reply from the reply tree of this post-->
				              <div id='yorum-".$row['id']."' class='row-fluid reply-wrapper'>
					              <div class='span8'>

						              <div class='reply-header'>
							              <a class='reply-up login-required' title='evet' href='javascript:void(0)' id='".$row['id']."' onclick='rply_up(this)'><i class='glyphicon glyphicon-arrow-up' style='".$up_style."'></i></a>
                            <a class='color-gray' title='küçült' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>
                            <a class='reply-user-link' href='".base_url('kullanici/').$username.'/'."'>".$username."</a>&nbsp;&nbsp;<span id='reply-score-".$row['id']."'>".$row['score']."</span> puan&nbsp;&nbsp;".$ago." gönderildi
                            &nbsp;<span class='color-gray'>(<a class='color-gray' title='yanıt sayısı'> ".$row['comments']." <span class='glyphicon glyphicon-comment' style='font-size:10px;'></span> </a>)</small></span>
						              </div>

						              <a class='reply-down login-required' title='hayır' href='javascript:void(0)' id='".$row['id']."' onclick='rply_down(this)'><i class='glyphicon glyphicon-arrow-down' style='".$down_style."'></i></a>
						              <div class='reply-content'>
                            <span>".telveflavor($Parsedown->text($row['content']))."</span>
						              </div>

              						<div class='reply-functions hide_function'>
              								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a class='color-gray' id='".$row['id']."' href='javascript:void(0)' onclick='".$favourite_onclick."' class='login-required'>".$favourite_html."</a>
              								&nbsp;&nbsp;&nbsp;&nbsp;<a class='color-gray' href='javascript:void(0)' onclick='report_reply(\"".$row['id']."\")' class='login-required'>şikayet<span class='glyphicon glyphicon-flag'></span></a>
              								&nbsp;&nbsp;&nbsp;&nbsp;</small><a class='color-gray' href='javascript:void(0)' onclick='set_reply(this)' id='".$row['id']."'><small>yanıt<span class='glyphicon glyphicon-share-alt special-reply-icon'></span></small></a>
                              &nbsp;&nbsp;&nbsp;&nbsp;</small><a class='color-gray' href='javascript:void(0)' onclick='share_reply(this)' id='".$row['id']."'><small>paylaş<span class='glyphicon glyphicon-share'></span></small></a>
              						</div>

					              </div>
				              </div>
				              <!--One reply from the reply tree of this post-->";

                $this->display_children($row['id'], $level+1, $res);
                $res.='</li>';
            }
            return $res.='</ul>';
        }

        public function insert_link()
        {
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $url = $this->input->post('url');
            $parsed = parse_url($url);

            $topic = str_replace(' ', '', $this->input->post('topic'));
            $topic = str_replace(['Â','â'], ['A','a'], $topic);
            $topic = preg_replace('/[^a-zA-Z0-9ÇŞĞÜÖİçşğüöı]+/', '', $topic);

            list($picurl, $text, $embed) = analyze_url($url);
            if (!empty($this->input->post('text'))) {
                $text = $this->input->post('text');
            }

            $data = array(
                'title' => $this->input->post('title'),
                'url' => $url,
                'text' => $text,
                'embed' => $embed,
                'picurl' => $picurl,
                'domain' => $parsed['host'],
                'topic' => tr_strtoupper($topic),
                'uid' => $row['id'], //User's ID
                'score' => 0,
                'comments' => 0
            );

            $this->db->insert('link', $data);
            $id = $this->hashids->encode($this->db->insert_id());

            $ext = pathinfo(parse_url($picurl, PHP_URL_PATH), PATHINFO_EXTENSION);
            $target_path = 'assets/img/link_thumbnails/'.$id.'.'.$ext;
            copy($picurl, $target_path);

            $config['image_library'] = 'gd2';
            $config['source_image'] = $target_path;
            $config['create_thumb'] = true;
            $config['maintain_ratio'] = true;
            $config['width']         = 248;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            return $id;
        }

        public function insert_link_cli($title, $url, $topic)
        {
            $this->db->where('username', 'moderator');
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $parsed = parse_url($url);

            $topic = str_replace(' ', '', $topic);
            $topic = str_replace(['Â','â'], ['A','a'], $topic);
            $topic = preg_replace('/[^a-zA-Z0-9ÇŞĞÜÖİçşğüöı]+/', '', $topic);

            list($picurl, $text, $embed) = analyze_url($url);

            $data = array(
                'title' => $title,
                'url' => $url,
                'text' => null,
                'embed' => $embed,
                'picurl' => $picurl,
                'domain' => $parsed['host'],
                'topic' => tr_strtoupper($topic),
                'uid' => $row['id'], //User's ID
                'score' => 0,
                'comments' => 0
            );

            $this->db->insert('link', $data);
            $id = $this->hashids->encode($this->db->insert_id());

            $ext = pathinfo(parse_url($picurl, PHP_URL_PATH), PATHINFO_EXTENSION);
            $target_path = 'assets/img/link_thumbnails/'.$id.'.'.$ext;
            copy($picurl, $target_path);

            $config['image_library'] = 'gd2';
            $config['source_image'] = $target_path;
            $config['create_thumb'] = true;
            $config['maintain_ratio'] = true;
            $config['width']         = 248;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            return $id;
        }

        public function insert_reply()
        {
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $content = xss_clean($this->input->post('content'));
            $content = trim($content);

            $data = array(
                'content' => $content,
                'pid' => $this->hashids->decode($this->input->post('pid'))[0],
                'uid' => $row['id'],
                'score' => 0,
                'comments' => 0,
                'is_parent_link' => $this->input->post('is_parent_link'),
                'link_id' => $this->hashids->decode($this->input->post('link_id'))[0]
            );

            $this->db->insert('reply', $data);
            return $this->hashids->encode($this->db->insert_id());
        }

        public function up_score()
        {
            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];
            $this->db->where('id', $id);
            $this->db->set('score', 'score+1', false);
            $this->db->update('link');
        }

        public function down_score()
        {
            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];
            $this->db->where('id', $id);
            $this->db->set('score', 'score-1', false);
            $this->db->update('link');
        }

        public function rply_up_score()
        {
            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];
            $this->db->where('id', $id);
            $this->db->set('score', 'score+1', false);
            $this->db->update('reply');
        }

        public function rply_down_score()
        {
            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];
            $this->db->where('id', $id);
            $this->db->set('score', 'score-1', false);
            $this->db->update('reply');
        }

        public function increase_comments()
        {
            $id = $this->input->post('pid');
            $id = $this->hashids->decode($id)[0];
            $this->db->where('id', $id);
            $this->db->set('comments', 'comments+1', false);
            $this->db->update('link');
        }

        public function increase_rply_comments()
        {
            $id = $this->input->post('pid');
            $id = $this->hashids->decode($id)[0];
            $this->db->where('id', $id);
            $this->db->set('comments', 'comments+1', false);
            $this->db->update('reply');
        }

        public function retrieve_topics_for_header()
        {
            $this->db->select('topic, COUNT(*) as topic_occurrence');
            $this->db->from('link');
            $this->db->group_by('topic');
            $this->db->order_by('topic_occurrence', 'desc');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function random_topic()
        {
            $this->db->select('topic');
            $this->db->from('link');
            $this->db->group_by('topic');
            $this->db->order_by('rand()');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row_array();
        }

        public function retrieve_topics($rows, $offset)
        {
            $this->db->select('topic, COUNT(topic) as topic_occurrence, MIN(link.created) as created, MIN(topic.description) as description, MIN(topic.subscribers) as subscribers');
            $this->db->from('link');
            $this->db->group_by('topic');
            $this->db->order_by('topic_occurrence', 'desc');
            $this->db->limit($rows, $offset);
            $this->db->join('topic', 'link.topic = topic.name', 'left');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function retrieve_all_topics()
        {
            $this->db->select('link.topic as topic,topic.header_image as header_image');
            $this->db->from('link');
            $this->db->group_by('link.topic');
            $this->db->join('topic', 'link.topic = topic.name');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function retrieve_all_links()
        {
            $this->db->select('id,uid,title,url,text,embed,picurl,domain,topic,created,score,comments,reported,favorited,is_link_for_union');
            $this->db->from('link');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function increase_topic_reported()
        {
            $this->db->where('name', $this->input->post('name'));
            $this->db->set('reported', 'reported+1', false);
            $this->db->update('topic');
        }

        public function increase_link_reported()
        {
            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];
            $this->db->where('id', $id);
            $this->db->set('reported', 'reported+1', false);
            $this->db->update('link');
        }

        public function increase_reply_reported()
        {
            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];
            $this->db->where('id', $id);
            $this->db->set('reported', 'reported+1', false);
            $this->db->update('reply');
        }

        private function hash_multirow($multirow)
        {
            foreach ($multirow as &$row) {
                $row['id'] = $this->hashids->encode($row['id']);
            }
            unset($row);
            return $multirow;
        }

        private function hash_row($row)
        {
            $row['id'] = $this->hashids->encode($row['id']);
            return $row;
        }

        public function fix_domain_with_empty_topics($domain, $topic)
        {
            $this->db->where('domain', $domain);
            $this->db->where('topic', '');
            $this->db->set('topic', $topic);
            $this->db->update('link');
        }
    }
