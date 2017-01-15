<?php
	class Favourite_model extends CI_Model{

		public function __construct()
		{
			$this->load->database();
			$this->load->library('hashids');
			$this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
		}

        public function insert_favourite_link()
        {
            $this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

            $data = array(
                'uid' => $row['id'],
                'link_id' => $id
			);

            return $this->db->insert('favourite_link',$data);
        }

		public function delete_favourite_link()
        {
            $this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

            $this->db->where('uid', $row['id']);
            $this->db->where('link_id', $id);

            return $this->db->delete('favourite_link');
        }

		public function right_to_unfavourite_link()
		{
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

			$this->db->from('favourite_link');
			$this->db->where('uid',$row['id']);
			$this->db->where('link_id',$id);

			$query = $this->db->get();
            return $query->row_array();
		}

		public function increase_link_favorited()
		{
			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

            $this->db->where('id',$id);
			$this->db->set('favorited', 'favorited+1', FALSE);
			$this->db->update('link');
		}

		public function decrease_link_favorited()
		{
			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

            $this->db->where('id',$id);
			$this->db->set('favorited', 'favorited-1', FALSE);
			$this->db->update('link');
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
