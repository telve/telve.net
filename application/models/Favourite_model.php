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

		public function insert_favourite_reply()
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

            return $this->db->insert('favourite_reply',$data);
        }

		public function delete_favourite_reply()
        {
            $this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

            $this->db->where('uid', $row['id']);
            $this->db->where('reply_id', $id);

            return $this->db->delete('favourite_reply');
        }

		public function right_to_unfavourite_reply()
		{
			$this->db->where('username',$this->session->userdata('username'));
            $this->db->select('id');
            $this->db->limit(1);
            $query = $this->db->get('user');
            $row = $query->row_array();

			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

			$this->db->from('favourite_reply');
			$this->db->where('uid',$row['id']);
			$this->db->where('reply_id',$id);

			$query = $this->db->get();
            return $query->row_array();
		}

		public function increase_reply_favorited()
		{
			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

            $this->db->where('id',$id);
			$this->db->set('favorited', 'favorited+1', FALSE);
			$this->db->update('reply');
		}

		public function decrease_reply_favorited()
		{
			$id = $this->input->post('id');
			$id = $this->hashids->decode($id)[0];

            $this->db->where('id',$id);
			$this->db->set('favorited', 'favorited-1', FALSE);
			$this->db->update('reply');
		}

    }
?>
