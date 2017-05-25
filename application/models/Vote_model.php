<?php
    class Vote_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            $this->load->library('hashids');
            $this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
        }

        public function insert_vote($up_down)
        {
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];

            $data = array(
                'uid' => $row['id'],
                'link_id' => $id,
                'up_down' => $up_down
            );

            return $this->db->insert('vote_link', $data);
        }

        public function right_to_vote()
        {
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];

            $this->db->from('vote_link');
            $this->db->where('uid', $row['id']);
            $this->db->where('link_id', $id);

            $query = $this->db->get();
            return $query->row_array();
        }

        public function insert_rply_vote($up_down)
        {
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];

            $data = array(
                'uid' => $row['id'],
                'reply_id' => $id,
                'up_down' => $up_down
            );

            return $this->db->insert('vote_reply', $data);
        }

        public function right_to_rply_vote()
        {
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            $id = $this->input->post('id');
            $id = $this->hashids->decode($id)[0];

            $this->db->from('vote_reply');
            $this->db->where('uid', $row['id']);
            $this->db->where('reply_id', $id);

            $query = $this->db->get();
            return $query->row_array();
        }
    }
