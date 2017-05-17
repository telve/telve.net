<?php
	class Utilities extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
            $this->load->model('link_model');
			$this->load->library('hashids');
			$this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
			$this->load->library('image_lib');
			$this->load->library('simple_html_dom');
		}

		public function download_all_topic_images()
		{
			if ($this->input->is_cli_request()) {
	            $topics_array = $this->link_model->retrieve_all_topics();
	            foreach ($topics_array as &$topic) {
					echo $topic['topic'];
					echo "<br>\n";
	                echo $topic['header_image'];
	                echo "<br>\n\n";
					$ext = pathinfo(parse_url($topic['header_image'], PHP_URL_PATH), PATHINFO_EXTENSION);
					copy($topic['header_image'], 'assets/img/topics/'.$topic['topic'].'.'.$ext);
	            }
			}

        }

		public function download_all_link_images()
		{
			if ($this->input->is_cli_request()) {
	            $links_array = $this->link_model->retrieve_all_links();
	            foreach ($links_array as &$link) {
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
			}

        }

		public function spider()
		{
			if ($this->input->is_cli_request()) {

				$url = "https://www.youtube.com/feed/trending";

				$curl = curl_init();
			    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			    curl_setopt($curl, CURLOPT_HEADER, false);
			    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			    curl_setopt($curl, CURLOPT_URL, $url);
			    curl_setopt($curl, CURLOPT_REFERER, $url);
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
			    $curl_result = curl_exec($curl);
			    curl_close($curl);

				$html = new Simple_html_dom();
				$html->load($curl_result);

				foreach($html->find('a.yt-uix-tile-link') as $element) {
       				echo "https://www.youtube.com".$element->href."\n";
				}

			}
		}

	}
?>
