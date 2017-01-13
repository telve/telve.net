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

		public function right_to_subscribe()
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

    }
?>
