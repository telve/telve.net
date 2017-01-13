<?php
	class Topic_model extends CI_Model{

		public function __construct()
		{
			$this->load->database();
		}

		public function insert_topic()
        {
			$topic = str_replace(' ', '', $this->input->post('topic'));
			$topic = preg_replace('/[^a-zA-Z0-9]+/', '', $topic);
			$topic = strtoupper($topic);

			if (!$this->right_to_insert_topic($topic)) {
				$data = array(
	                'name' => $topic
				);

	            return $this->db->insert('topic',$data);
			}
        }

		public function right_to_insert_topic($topic)
		{
			$this->db->from('topic');
			$this->db->where('name',$topic);

			$query = $this->db->get();
            return $query->row_array();
		}

    }
?>
