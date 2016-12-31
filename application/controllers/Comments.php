<?php

	class Comments extends MY_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('link_model');
			$this->load->model('vote_model');
		}

		public function view($id)
		{

			$this->data['link_item'] = $this->link_model->retrieve_link($id);
            $this->data['reply'] = $this->link_model->retrieve_reply_by_id($id);
            $this->data['tree'] = $this->link_model->retrieve_reply_tree_by_id($id); //$pid

			if(empty($this->data['link_item']))
			{
				show_404(); //The page does not exist
			}

			$this->data['title']=$this->data['link_item']['title'];

			$this->load->view('templates/header',$this->data);
			$this->load->view('comments/view',$this->data);
            //$this->load->view('comments/tree');
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function tree($id)
		{

			$this->data['link_item'] = $this->link_model->retrieve_link($id);
            $this->data['reply'] = $this->link_model->retrieve_reply_tree_by_id($id); //$pid

			if(empty($this->data['link_item']))
			{
				show_404(); //The page does not exist
			}

			$this->data['title']=$this->data['link_item']['title'];

			$this->load->view('templates/header',$this->data);
			$this->load->view('comments/tree',$this->data);
			$this->load->view('templates/footer');
		}

		public function show()
		{

            $reply = $this->link_model->retrieve_reply_by_id($this->input->post('id')); //$this->data['reply']

			if(!empty($reply))
			{
				foreach ($reply as $key=>$val)
				{
					$reply[$key]['content'] = urlencode(iconv('utf-8','utf-8',$val['content']));
				}
				//echo json_encode($json);
				echo json_encode($reply);
			}


		}

		public function show_load()
		{
            echo $this->input->post('id');
		}

        public function reply()
        {
            $this->load->helper(array('form','url')); //Loads form helper functions and URL helper functions
			$this->load->library('form_validation');

            $this->data['title'] = "Reply";

			$this->form_validation->set_rules('content','Content','trim|required|max_length[228]');
            $this->form_validation->set_rules('lid','Lid','required'); //You must set up a rule to submit the value

            if($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header',$this->data);
				$this->load->view('submit/success');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->link_model->insert_reply();
				$this->load->view('templates/header',$this->data);
				$this->load->view('submit/success');
				$this->load->view('templates/footer');
			}
        }

        public function reply_ajax()
        {
			if ($this->input->post('content')) {
	            if ($this->data['is_user_logged_in']) {
		            if($this->link_model->insert_reply()) {
						$this->link_model->increase_comments();
						$this->link_model->increase_rply_comments();
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
					$this->vote_model->insert_vote();
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
					$this->vote_model->insert_vote();
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
					$this->vote_model->insert_rply_vote();
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
					$this->vote_model->insert_rply_vote();
		            $this->link_model->rply_down_score();
					echo 1;
				} else {
					echo "You have already casted your vote on this comment.";
				}
			} else {
				echo "Please login first.";
			}
        }
	}

?>
