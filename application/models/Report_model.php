<?php
	class Report_model extends CI_Model{

		public function __construct()
		{
			$this->load->database();
			$this->load->library('hashids');
			$this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
		}

        public function insert_report_topic()
        {
            $this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $data = array(
                'uid' => $row['id'],
                'topic_name' => $this->input->post('name')
			);

            return $this->db->insert('report_topic',$data);
        }

		public function right_to_report_topic()
		{
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$this->db->from('report_topic');
			$this->db->where('uid',$row['id']);
			$this->db->where('topic_name',$this->input->post('name'));

			$query = $this->db->get();
            return $query->row_array();
		}

		public function insert_report_link()
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

            $this->db->insert('report_link',$data);

			$this->db->select('link.title');
			$this->db->from('link');
			$this->db->where('link.id',$id);
			$query = $this->db->get();
			$result = $query->row_array();
			return $result['title'];
        }

		public function right_to_report_link()
		{
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

			$this->db->from('report_link');
			$this->db->where('uid',$row['id']);
			$this->db->where('link_id',$id);

			$query = $this->db->get();
            return $query->row_array();
		}

		public function insert_report_reply()
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
                'reply_id' => $id
			);

            $this->db->insert('report_reply',$data);

			$this->db->select('user.username');
			$this->db->from('reply');
			$this->db->where('reply.id',$id);
			$this->db->join('user', 'reply.uid = user.id');
			$query = $this->db->get();
			$result = $query->row_array();
			return $result['username'];
        }

		public function right_to_report_reply()
		{
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

			$this->db->from('report_reply');
			$this->db->where('uid',$row['id']);
			$this->db->where('reply_id',$id);

			$query = $this->db->get();
            return $query->row_array();
		}

    }
?>
