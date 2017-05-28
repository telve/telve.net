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
            $user = $query->row_array();

            if ($action_type == 3) {
                $id = $this->input->post('pid');
            } else {
                $id = $this->input->post('id');
            }
            $id = $this->hashids->decode($id)[0];

            $this->db->where('id', $id);
            $this->db->select('uid');
            $this->db->limit(1);
            if ($item_type == 0) {
                $query = $this->db->get('link');
            } else {
                $query = $this->db->get('reply');
            }
            $row = $query->row_array();
            $item_uid = $row['uid'];

            $data = array(
                'uid' => $user['id'],
                'item_type' => $item_type,
                'action_type' => $action_type,
                'item_id' => $id,
                'item_uid' => $item_uid,
                'unread' => 1
            );

            return $this->db->insert('notification', $data);
        }

        public function get_unread_notification_count()
        {
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $user = $query->row_array();

            $this->db->where('item_uid', $user['id']);
            $this->db->where('unread', 1);
            $query = $this->db->get('notification');
            return count($query->result_array());
        }

        public function retrieve_notifications()
        {
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $user = $query->row_array();

            $this->db->where('item_uid', $user['id']);
            $this->db->select('item_type,action_type,username,link.id as link_id_0, reply.link_id as link_id_1');
            $this->db->from('notification');
            $this->db->join('user', 'notification.uid = user.id');
            $this->db->join('link', 'notification.item_id = link.id', 'left');
            $this->db->join('reply', 'notification.item_id = reply.id', 'left');
            $query = $this->db->get();
            return $this->hash_multirow($query->result_array());
        }

        private function hash_multirow($multirow)
        {
            foreach ($multirow as &$row) {
                $row['link_id_0'] = $this->hashids->encode($row['link_id_0']);
                $row['link_id_1'] = $this->hashids->encode($row['link_id_1']);
            }
            unset($row);
            return $multirow;
        }

		}
