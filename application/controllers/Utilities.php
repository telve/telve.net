<?php
	class Utilities extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
            $this->load->model('link_model');
			$this->load->library('hashids');
			$this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
			$this->load->library('image_lib');
		}

		public function download_all_topic_images()
		{
			if (($this->config->item('utilities_enabled'))) {
	            $topics_array = $this->link_model->retrieve_all_topics();
	            foreach ($topics_array as &$topic) {
					echo $topic['topic'];
					echo "<br>\n";
	                echo $topic['header_image'];
	                echo "<br>\n\n";
					$ext = pathinfo(parse_url($topic['header_image'], PHP_URL_PATH), PATHINFO_EXTENSION);
					copy($topic['header_image'], 'assets/img/topics/'.$topic['topic'].'.'.$ext);
	            }
			} else {
				echo "Utilities are not enabled!";
			}

        }

		public function download_all_link_images()
		{
			if (($this->config->item('utilities_enabled'))) {
	            $links_array = $this->link_model->retrieve_all_links();
	            foreach (array_slice($links_array, 0, 3) as &$link) {
					echo $link['title'];
					echo "<br>\n";
	                echo $link['picurl'];
	                echo "<br>\n\n";
					$ext = pathinfo(parse_url($link['picurl'], PHP_URL_PATH), PATHINFO_EXTENSION);
					$target_path = 'assets/img/link_thumbnails/'.$this->hashids->encode($link['id']).'.'.$ext;
					copy($link['picurl'], $target_path);

					$config['image_library'] = 'gd2';
					$config['source_image'] = $target_path;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']         = 248;

					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
	            }
			} else {
				echo "Utilities are not enabled!";
			}

        }

	}
?>
