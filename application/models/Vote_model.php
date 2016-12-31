<?php
	class Vote_model extends CI_Model{

		public function __construct()
		{
			$this->load->database();
		}

        public function insert_vote()
        {
            $this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $id = $this->input->post('id');

            $data = array(
                'uid' => $row['id'],
                'linkid' => $id
			);

            return $this->db->insert('vote',$data);
        }

		public function right_to_vote()
		{
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $id = $this->input->post('id');

			$this->db->from('vote');
			$this->db->where('uid',$row['id']);
			$this->db->where('linkid',$id);

			$query = $this->db->get();
            return $query->row_array();
		}

		public function insert_rply_vote()
        {
            $this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $id = $this->input->post('id');

            $data = array(
                'uid' => $row['id'],
                'rply_id' => $id
			);

            return $this->db->insert('rply_vote',$data);
        }

		public function right_to_rply_vote()
		{
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $id = $this->input->post('id');

			$this->db->from('rply_vote');
			$this->db->where('uid',$row['id']);
			$this->db->where('rply_id',$id);

			$query = $this->db->get();
            return $query->row_array();
		}

    }
?>
