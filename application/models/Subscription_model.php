<?php
	class Subscription_model extends CI_Model{

		public function __construct()
		{
			$this->load->database();
		}

        public function insert_subscription()
        {
            $this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $data = array(
                'uid' => $row['id'],
                'topic' => $this->input->post('topic')
			);

            return $this->db->insert('subscription',$data);
        }

		public function delete_subscription()
        {
            $this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $this->db->where('uid', $row['id']);
            $this->db->where('topic', $this->input->post('topic'));

            return $this->db->delete('subscription');
        }

		public function right_to_unsubscribe()
		{
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$this->db->from('subscription');
			$this->db->where('uid',$row['id']);
			$this->db->where('topic',$this->input->post('topic'));

			$query = $this->db->get();
            return $query->row_array();
		}

		public function increase_subscribers()
		{
            $this->db->where('name',$this->input->post('topic'));
			$this->db->set('subscribers', 'subscribers+1', FALSE);
			$this->db->update('topic');
		}

		public function decrease_subscribers()
		{
            $this->db->where('name',$this->input->post('topic'));
			$this->db->set('subscribers', 'subscribers-1', FALSE);
			$this->db->update('topic');
		}

		public function retrieve_subscriptions($rows,$offset) {
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$this->db->select('link.topic, COUNT(link.topic) as topic_occurrence, MIN(link.created) as created, MIN(topic.description) as description, MIN(topic.subscribers) as subscribers, MIN(subscription.topic) as subscribed');
			$this->db->from('link');
			$this->db->group_by('topic');
			$this->db->order_by('topic_occurrence','desc');
			$this->db->limit($rows,$offset);
			$this->db->join('topic', 'link.topic = topic.name','left');
			$this->db->join('subscription', 'link.topic = subscription.topic AND '.$row['id'].' = subscription.uid','left');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function retrieve_only_subscribed() {
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$this->db->select('link.topic, COUNT(link.topic) as topic_occurrence, MIN(topic.description) as description');
			$this->db->from('link');
			$this->db->group_by('topic');
			$this->db->order_by('topic_occurrence','desc');
			$this->db->join('topic', 'link.topic = topic.name','left');
			$this->db->join('subscription', 'link.topic = subscription.topic AND '.$row['id'].' = subscription.uid');
			$query = $this->db->get();
			return $query->result_array();
		}

    }
?>
