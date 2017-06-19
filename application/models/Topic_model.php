<?php
    class Topic_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            $this->load->helper('tr_lang');
        }

        public function insert_topic()
        {
            $topic = str_replace(' ', '', $this->input->post('topic'));
            $topic = preg_replace('/[^a-zA-Z0-9ÇŞĞÜÖİçşğüöı]+/', '', $topic);
            $topic = str_replace('â', 'a', $topic);
            $topic = tr_strtoupper($topic);

            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            if (!$this->right_to_insert_topic($topic)) {
                $data = array(
                    'name' => $topic,
                    'creator_uid' => $row['id']
                );

                return $this->db->insert('topic', $data);
            }
        }

        public function insert_topic_cli($topic)
        {
            $topic = str_replace(' ', '', $topic);
            $topic = preg_replace('/[^a-zA-Z0-9ÇŞĞÜÖİçşğüöı]+/', '', $topic);
            $topic = str_replace('â', 'a', $topic);
            $topic = tr_strtoupper($topic);

            $this->db->where('username', 'moderator');
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            if (!$this->right_to_insert_topic($topic)) {
                $data = array(
                    'name' => $topic,
                    'creator_uid' => $row['id']
                );

                return $this->db->insert('topic', $data);
            }
        }

        public function right_to_insert_topic($topic)
        {
            $this->db->from('topic');
            $this->db->where('name', $topic);

            $query = $this->db->get();
            return $query->row_array();
        }

        public function retrieve_topic($name)
        {
            $this->db->select('name,description,subscribers,header_image,user.username,reported,topic.created');
            $this->db->from('topic');
            $this->db->join('user', 'topic.creator_uid = user.id');
            $this->db->where('name', $name);

            $query = $this->db->get();
            return $query->row_array();
        }
    }
