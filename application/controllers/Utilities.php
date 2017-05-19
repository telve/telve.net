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
			$this->load->helper('curl');
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

				while (true) {

					$domains = ["youtube.com","sabah.com.tr","onedio.com","haber7.com","ensonhaber.com","milliyet.com.tr","yenisafak.com","hurriyet.com.tr","kizlarsoruyor.com","internethaber.com","mynet.com","twitter.com"];
					$selected_domain = $domains[array_rand($domains)];

					#$selected_domain = "twitter.com";
					echo $selected_domain."\n";

					switch ($selected_domain) {
						case "youtube.com":
							$url = "https://www.youtube.com/feed/trending?gl=TR";
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
						case "yenisafak.com":
							$url = "http://www.yenisafak.com/Rss";
							break;
						case "hurriyet.com.tr":
							$url = "http://www.hurriyet.com.tr/rss/anasayfa";
							break;
						case "kizlarsoruyor.com":
							$url = "http://www.kizlarsoruyor.com/rss";
							break;
						case "internethaber.com":
							$url = "http://www.internethaber.com/rss";
							break;
						case "mynet.com":
							$url = "http://www.mynet.com/haber/rss/son-dakika";
							break;
						case "twitter.com":
							$html = new Simple_html_dom();
							$html->load(using_curl("http://twitturk.com/twituser/trends/topic"));
							$topics = $html->find('li.topic > a');
							$random_topic = $topics[rand(0,count($topics)-1)]->innertext;
							$url = "https://queryfeed.net/twitter?q=".$random_topic."&title-type=user-name-both&geocode=39.116424%2C35.288086%2C813km&omit-direct=on&omit-retweets=on";
							break;
					}

					$html = new Simple_html_dom();
					$html->load(using_curl($url));

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
							break;
						case "haber7.com":
							$xml = simplexml_load_string($html);
							$selected_item = rand(1,count($xml->channel->item));
							$submit_url = $xml->channel->item[$selected_item]->link;
							$submit_topic = $xml->channel->item[$selected_item]->category;
							if ($submit_topic == "ADVERTORIAL") continue;
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
						case "yenisafak.com":
							$xml = simplexml_load_string($html);
							$selected_item = rand(1,count($xml->channel->item));
							$submit_url = $xml->channel->item[$selected_item]->link;
							$submit_topic = $xml->channel->item[$selected_item]->category;
							break;
						case "hurriyet.com.tr":
							$xml = simplexml_load_string($html);
							$selected_item = rand(1,count($xml->channel->item));
							$submit_url = $xml->channel->item[$selected_item]->link;
							$submit_topic = $xml->channel->item[$selected_item]->category;
							break;
						case "kizlarsoruyor.com":
							$xml = simplexml_load_string($html);
							$selected_item = rand(1,count($xml->channel->item));
							$submit_url = $xml->channel->item[$selected_item]->link;
							$submit_topic = explode(' ',trim($xml->channel->item[$selected_item]->category))[0];
							break;
						case "internethaber.com":
							$xml = simplexml_load_string($html);
							$submit_url = $xml->channel->item[rand(1,count($xml->channel->item))]->link;
							$submit_topic = "HABER";
							break;
						case "mynet.com":
							$xml = simplexml_load_string($html);
							$selected_item = rand(1,count($xml->channel->item));
							$submit_url = $xml->channel->item[$selected_item]->link;
							$submit_topic = $xml->channel->item[$selected_item]->subcategory;
							break;
						case "twitter.com":
							$xml = simplexml_load_string($html);
							$submit_url = $xml->channel->item[rand(1,count($xml->channel->item))]->link;
							$submit_topic = "SOSYAL";
							break;
					}
					if ($submit_topic == "Gündem") $submit_topic = "Haber";

					$submit_title = get_title($submit_url);

					if ( (strlen($submit_url) == 0) || (strlen($submit_title) == 0) ) {
						continue;
					}

					echo "Title:\t".$submit_title."\n";
					echo "URL:\t".$submit_url."\n";
					echo "Topic:\t".$submit_topic."\n";

					$insert_id = $this->link_model->insert_link_cli($submit_title,$submit_url,$submit_topic);
					$this->topic_model->insert_topic_cli($submit_topic);

					echo "Record inserted with ID: ".$insert_id."\n\n";

					sleep(300); // Wait 5 minutes

				}

			}
		}

	}
?>
