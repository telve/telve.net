<?php
	class Utilities extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
            $this->load->model('link_model');
			$this->load->library('hashids');
			$this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
		}

		public function download_all_topic_images()
		{
			if (($this->config->item('utilities_enabled'))) {
	            $topics_array = $this->link_model->retrieve_all_topics();
	            foreach ($topics_array as &$topic) {
					echo $topic['topic'];
					echo "<br>";
	                echo $topic['header_image'];
	                echo "<br>";
					$ext = pathinfo($topic['header_image'], PATHINFO_EXTENSION);
					//echo $ext;
					copy($topic['header_image'], 'assets/img/topics/'.urlencode($topic['topic']).'.'.$ext);
					//file_put_contents('assets/img/topics/'.$topic['topic'].'.'.$ext, file_get_contents($topic['header_image']));

	            }
			} else {
				echo "Utilities are not enabled!";
			}

        }

		public function download_all_link_images()
		{
			if (($this->config->item('utilities_enabled'))) {
	            $links_array = $this->link_model->retrieve_all_links();
	            foreach ($links_array as &$link) {
					echo $link['title'];
					echo "<br>";
	                echo $link['picurl'];
	                echo "<br>";
					$ext = pathinfo($link['picurl'], PATHINFO_EXTENSION);
					//echo $ext;
					copy($link['picurl'], 'assets/img/link_thumbnails/'.$this->hashids->encode($link['id']).'.'.$ext);
					//file_put_contents('assets/img/topics/'.$topic['topic'].'.'.$ext, file_get_contents($topic['header_image']));

	            }
			} else {
				echo "Utilities are not enabled!";
			}

        }

	}
?>
