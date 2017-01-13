<?php
	class Subscriptions extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('link_model');
			$this->load->model('subscription_model');
		}

		public function index()
		{
			if (!$this->data['is_user_logged_in']) {
				redirect('');
			}
            $this->load->library('pagination');

            $config['base_url'] = base_url('subscriptions');

            $config['total_rows'] = count($this->link_model->retrieve_topics_for_header());
            $config['per_page'] = 10;
            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = '<span class="glyphicon glyphicon-arrow-left"></span> <span class="pagination">Previous page</span>';
            $config['next_link'] = '<span class="pagination">Next page</span> <span class="glyphicon glyphicon-arrow-right"></span>';
            $config['full_tag_close'] = '</p>';
            $config['display_pages'] = FALSE; //The "number" link is not displayed
            $config['first_link'] = FALSE; //The start link is not displayed
            $config['last_link'] = FALSE;
			$config['next_tag_open'] = '<span style="float:right;">';
			$config['next_tag_close'] = "</span>";
            $this->pagination->initialize($config);
			$this->data['per_page'] = $config['per_page'];

            $this->data['title'] = 'Subscriptions';
			$this->data['offset'] = $this->uri->segment(2);
            $this->data['link'] = $this->link_model->retrieve_link($id = FALSE,$config['per_page'],$this->data['offset'],'hot');
			$this->data['topics'] = $this->link_model->retrieve_topics($config['per_page'],$this->data['offset']);

			foreach ($this->data['link'] as &$link_item) {
				$link_item['seo_segment'] = str_replace(" ","-", strtolower( implode(' ', array_slice( preg_split('/\s+/', preg_replace('/[^a-zA-Z0-9\s]+/', '', $link_item['title']) ), 0, 6) ) ) );
			}
			unset($link_item);

			$this->load->view('templates/header',$this->data);
			$this->load->view('subscriptions/index',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function subscribe()
        {
			if ($this->data['is_user_logged_in']) {

				if (!$this->subscription_model->right_to_subscribe()) {
					$this->vote_model->insert_subscription();
					echo 1;
				} else {
					echo "You have already subscribed to this topic.";
				}
			} else {
				echo "Please login first.";
			}
        }

	}
?>
