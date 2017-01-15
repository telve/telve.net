<?php
	class Subscriptions extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('link_model');
			$this->load->model('subscription_model');
			$this->load->model('report_model');
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
			$this->data['topics'] = $this->subscription_model->retrieve_subscriptions($config['per_page'],$this->data['offset']);

			$this->data['toggle_sidebar'] = '';
			$this->data['sidebar'] = '';

			$this->load->view('templates/header',$this->data);
			$this->load->view('subscriptions/index',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function subscribe()
        {
			if ($this->data['is_user_logged_in']) {
				if (!$this->subscription_model->right_to_unsubscribe()) {
					$this->subscription_model->insert_subscription();
					$this->subscription_model->increase_subscribers();
					echo 1;
				} else {
					echo "You have already subscribed to this topic.";
				}
			} else {
				echo "Please login first.";
			}
        }

		public function unsubscribe()
        {
			if ($this->data['is_user_logged_in']) {
				if ($this->subscription_model->right_to_unsubscribe()) {
					$this->subscription_model->delete_subscription();
					$this->subscription_model->decrease_subscribers();
					echo 1;
				} else {
					echo "You have already subscribed to this topic.";
				}
			} else {
				echo "Please login first.";
			}
        }

		public function report_topic()
        {
			if ($this->data['is_user_logged_in']) {
				if (!$this->report_model->right_to_report_topic()) {
					$this->report_model->insert_report_topic();
		            $this->link_model->inscrease_topic_reported();
					echo 1;
				} else {
					echo "You have already reported this topic.";
				}
			} else {
				echo "Please login first.";
			}
        }

	}
?>
