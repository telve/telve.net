<?php
	class Utilities extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
            $this->load->model('link_model');
			$this->load->model('topic_model');
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
				echo "\n";

				$domains = ["youtube.com","sabah.com.tr","onedio.com","haber7.com","ensonhaber.com","milliyet.com.tr"];
				$selected_domain = $domains[array_rand($domains)];

				#$selected_domain = "milliyet.com.tr";
				echo $selected_domain."\n";

				switch ($selected_domain) {
					case "youtube.com":
						$url = "https://www.youtube.com/feed/trending";
						break;
					case "sabah.com.tr":
						$url = "http://www.sabah.com.tr/rss/anasayfa.xml";
						break;
					case "onedio.com":
						$url = "https://onedio.com/support/rss.xml";
						break;
					case "haber7.com":
						$url = "http://sondakika.haber7.com/sondakika.rss";
						break;
					case "ensonhaber.com":
						$url = "http://www.ensonhaber.com/rss/ensonhaber.xml";
						break;
					case "milliyet.com.tr":
						$url = "http://www.milliyet.com.tr/rss/rssNew/gundemRss.xml";
						break;
				}

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

				switch ($selected_domain) {
					case "youtube.com":
						$items = $html->find('a.yt-uix-tile-link');
						$submit_url = "https://www.youtube.com".$items[array_rand($items)]->href;
						$submit_topic = "VİDEO";
						break;
					case "sabah.com.tr":
						$xml = simplexml_load_string($html);
						$submit_url = $xml->channel->item[rand(1,count($xml->channel->item))]->link;
						$submit_topic = "HABER";
						break;
					case "onedio.com":
						$xml = simplexml_load_string($html);
						$selected_item = rand(1,count($xml->channel->item));
						$submit_url = $xml->channel->item[$selected_item]->link;
						$submit_topic = $xml->channel->item[$selected_item]->category[1];
						if ($submit_topic == "Gündem") $submit_topic = "Haber";
						break;
					case "haber7.com":
						$xml = simplexml_load_string($html);
						$submit_url = $xml->channel->item[rand(1,count($xml->channel->item))]->link;
						$submit_topic = "HABER";
						break;
					case "ensonhaber.com":
						$xml = simplexml_load_string($html);
						$submit_url = $xml->channel->item[rand(1,count($xml->channel->item))]->link;
						$submit_topic = "HABER";
						break;
					case "milliyet.com.tr":
						$xml = simplexml_load_string($html);
						$submit_url = $xml->channel->item[rand(1,count($xml->channel->item))]->link;
						$submit_url = str_replace("http://secure.milliyet.com.tr/redirect/Default.aspx?l=","",$submit_url);
						$submit_url = urldecode($submit_url);
						$submit_url = str_replace("?utm_source=rss&amp;utm_medium=milliyetyasamoldrss","",$submit_url);
						$submit_topic = "HABER";
						break;
				}

				$submit_title = $this->get_title($submit_url);

				echo "Title:\t".$submit_title."\n";
				echo "URL:\t".$submit_url."\n";
				echo "Topic:\t".$submit_topic."\n";

				$insert_id = $this->link_model->insert_link_cli($submit_title,$submit_url,$submit_topic);
				$this->topic_model->insert_topic_cli($submit_topic);

				echo "Record inserted with ID: ".$insert_id."\n\n";


			}
		}

		public function get_title($url)
		{
			$parsed = parse_url($url);
		    $segment = explode('/', $parsed['path']);

			if ($parsed['host'] == 'mobile.twitter.com') {
				$url = 'https://twitter.com/'.$parsed['path'];
			}

			$html = new Simple_html_dom();
		    $html->load_file($url);
			$result = $html->find('title',0)->innertext;
			$result = trim(str_replace(array('&#039;','&#39;'),"'",$result));
			$result = trim(str_replace(array('&quot;'),'"',$result));
			$result = trim(str_replace(array('&#10;'),' ',$result));
			#$result = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result);
			#$result = preg_replace('/[^\r\n\t\x20-\x7E\xA0-\xFF]/', '', $result);
			#$result = html_entity_decode($result);
			#$result = utf8_encode($result);
			return $result;
        }

	}
?>
