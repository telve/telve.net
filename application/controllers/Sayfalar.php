<?php
	class Sayfalar extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
		}

		public function blog()
		{
			$this->data['title'] = 'Blog';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/blog',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function reklam_ver()
		{
			$this->data['title'] = 'Reklam ver';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/reklam_ver',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function kariyer()
		{
			$this->data['title'] = 'Kariyer';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/kariyer',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function kullanici_sozlesmesi()
		{
			$this->data['title'] = 'Kullanıcı Sözleşmesi';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/kullanici_sozlesmesi',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function gizlilik_politikasi()
		{
			$this->data['title'] = 'Gizlilik Politikası';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/gizlilik_politikasi',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function site_kurallari()
		{
			$this->data['title'] = 'Site Kuralları';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/site_kurallari',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function sss()
		{
			$this->data['title'] = 'Sıkça Sorulan Sorular';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/sss',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function bize_ulasin()
		{
			$this->data['title'] = 'Bize ulaşın';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/bize_ulasin',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function iphone()
		{
			$this->data['title'] = 'Telve Apple Store Uygulaması';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/iphone',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function android()
		{
			$this->data['title'] = 'Telve Google Play Store Uygulaması';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/android',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function altin()
		{
			$this->data['title'] = 'telvealtın';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/altin',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

		public function sponsor()
		{
			$this->data['title'] = 'telvesponsor';
			$this->load->view('templates/header',$this->data);
			$this->load->view('sayfalar/sponsor',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

	}
?>
