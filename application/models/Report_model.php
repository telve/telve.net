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

    }
?>
