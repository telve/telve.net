<?php
    class Notification_model extends CI_Model
		{
				public function __construct()
        {
            $this->load->database();
            $this->load->library('hashids');
            $this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
        }

        public function insert_notification($item_type, $action_type)
        {
            // $item_type - 0: link, 1: reply
            // $action_type - 0: upvote, 1: downvote, 2: favorite, 3: got a comment/reply

            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

            if ($action_type == 3) {
                $id = $this->input->post('pid');
            } else {
                $id = $this->input->post('id');
            }
            $id = $this->hashids->decode($id)[0];

            $data = array(
                'uid' => $row['id'],
                'item_type' => $item_type,
                'action_type' => $action_type,
                'item_id' => $id,
                'unread' => 1
            );

            return $this->db->insert('notification', $data);
        }

		}
