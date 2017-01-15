<?php

	class Comments extends MY_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('link_model');
			$this->load->model('vote_model');
			$this->load->model('report_model');
		}

		public function view()
		{
			$id = $this->uri->segment(4);
			$this->data['base_url'] = base_url('t/'.$this->uri->segment(2).'/');

			$this->data['link_item'] = $this->link_model->retrieve_link($id);
            $this->data['reply'] = $this->link_model->retrieve_reply_by_id($id);
            $this->data['tree'] = $this->link_model->retrieve_reply_tree_by_id($id); //$pid

			if(empty($this->data['link_item']))
			{
				show_404(); //The page does not exist
			}

			$this->data['link_item']['seo_segment'] = str_replace(" ","-", strtolower( implode(' ', array_slice( preg_split('/\s+/', preg_replace('/[^a-zA-Z0-9\s]+/', '', $this->data['link_item']['title']) ), 0, 6) ) ) );
			if (empty($this->uri->segment(5)) || $this->uri->segment(5) != $this->data['link_item']['seo_segment']) {
				redirect('t/'.$this->data['link_item']['topic'].'/comments/'.$id.'/'.$this->data['link_item']['seo_segment'].'/');
			}

			$this->data['title']=$this->data['link_item']['title'];

			$this->load->view('templates/header',$this->data);
			$this->load->view('comments/view',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

        public function reply_ajax()
        {
			if ($this->input->post('content')) {
	            if ($this->data['is_user_logged_in']) {
		            if($this->link_model->insert_reply()) {
						if ($this->input->post('is_parent_link') == 1) {
							$this->link_model->increase_comments();
						} else if ($this->input->post('is_parent_link') == 0) {
							$this->link_model->increase_rply_comments();
						}
		                echo 1;
		            } else {
						echo "Operation was not succesful. Please try again.";
					}
				} else {
					echo "Please login first.";
				}
			} else {
				echo "You cannot send empty replies.";
			}
        }

        public function up()
        {
			if ($this->data['is_user_logged_in']) {

				if (!$this->vote_model->right_to_vote()) {
					$this->vote_model->insert_vote(1);
		            $this->link_model->up_score();
					echo 1;
				} else {
					echo "You have already casted your vote on this post.";
				}
			} else {
				echo "Please login first.";
			}
        }

		public function down()
        {
			if ($this->data['is_user_logged_in']) {

				if (!$this->vote_model->right_to_vote()) {
					$this->vote_model->insert_vote(0);
		            $this->link_model->down_score();
					echo 1;
				} else {
					echo "You have already casted your vote on this post.";
				}
			} else {
				echo "Please login first.";
			}
        }

        public function rply_up()
        {
			if ($this->data['is_user_logged_in']) {

				if (!$this->vote_model->right_to_rply_vote()) {
					$this->vote_model->insert_rply_vote(1);
		            $this->link_model->rply_up_score();
					echo 1;
				} else {
					echo "You have already casted your vote on this comment.";
				}
			} else {
				echo "Please login first.";
			}
        }

		public function rply_down()
        {
			if ($this->data['is_user_logged_in']) {

				if (!$this->vote_model->right_to_rply_vote()) {
					$this->vote_model->insert_rply_vote(0);
		            $this->link_model->rply_down_score();
					echo 1;
				} else {
					echo "You have already casted your vote on this comment.";
				}
			} else {
				echo "Please login first.";
			}
        }

		public function report_link()
        {
			if ($this->data['is_user_logged_in']) {
				if (!$this->report_model->right_to_report_link()) {
					$title = $this->report_model->insert_report_link();
		            $this->link_model->inscrease_link_reported();
					echo '1 '.$title;
				} else {
					echo "You have already reported this topic.";
				}
			} else {
				echo "Please login first.";
			}
        }
	}

?>
