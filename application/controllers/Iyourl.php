<?php
	class Iyourl extends MY_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('get_model');
		}

		public function index()
		{
            $this->load->library('pagination');

            $config['base_url'] = base_url('iyourl/index');

            $config['total_rows'] = count($this->get_model->get_link_count());
            $config['per_page'] = 10;
            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = 'Previous page';
            $config['next_link'] = 'Next page';
            $config['full_tag_close'] = '</p>';
            $config['display_pages'] = FALSE; // 不显示“数字”链接
            $config['first_link'] = FALSE;// 不显示起始链接
            $config['last_link'] = FALSE;
            $this->pagination->initialize($config);

            $this->data['title'] = '首页';
            $this->data['link'] = $this->get_model->get_link($id = FALSE,$config['per_page'],$this->uri->segment(3));

			$this->load->view('templates/header',$this->data);
			$this->load->view('iyourl/index',$this->data);
			$this->load->view('templates/footer');
		}

        public function latest()
		{
			$this->load->helper('url');
			$this->load->library('pagination');

            $config['base_url'] = base_url('iyourl/latest');

            $config['total_rows'] = count($this->get_model->get_latest());
            $config['per_page'] = 4;

            //$config['use_page_numbers'] = TRUE; //启用use_page_numbers后显示的是当前页码

            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = 'Previous page';
            $config['next_link'] = 'Next page';
            $config['full_tag_close'] = '</p>';

            $config['display_pages'] = FALSE; // 不显示“数字”链接
            $config['first_link'] = FALSE;// 不显示起始链接
            $config['last_link'] = FALSE;

            $this->pagination->initialize($config);
			$this->data['submit'] = $this->submit_model->get_latest($id = FALSE,$config['per_page'],$this->uri->segment(3)); //最新

			$this->data['title'] = '最新';

			$this->load->view('templates/header',$this->data);
			$this->load->view('submit/latest',$this->data);
			$this->load->view('templates/footer');
		}

        public function rising()
        {

        }

        public function controversial()
        {

        }

        public function top()
        {
            $this->load->helper('url');
			$this->load->library('pagination');

            $config['base_url'] = base_url('submit/top');

            $config['total_rows'] = count($this->submit_model->get_top());
            $config['per_page'] = 4;

            //$config['use_page_numbers'] = TRUE; //启用use_page_numbers后显示的是当前页码

            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = 'Previous page';
            $config['next_link'] = 'Next page';
            $config['full_tag_close'] = '</p>';

            $config['display_pages'] = FALSE; // 不显示“数字”链接
            $config['first_link'] = FALSE;// 不显示起始链接
            $config['last_link'] = FALSE;

            $this->pagination->initialize($config);
			$this->data['submit'] = $this->submit_model->get_top($id = FALSE,$config['per_page'],$this->uri->segment(3)); //最新

			$this->data['title'] = '得分';

			$this->load->view('templates/header',$this->data);
			$this->load->view('submit/top',$this->data);
			$this->load->view('templates/footer');
        }

        public function wiki()
        {

        }



        public function reply()
        {
            $this->load->helper(array('form','url')); //加载表单辅助函数和URL辅助函数
			$this->load->library('form_validation');

            $this->data['title'] = "首页";

			$this->form_validation->set_rules('content','Content','trim|required|min_length[5]|max_length[228]');
            $this->form_validation->set_rules('sid','Sid','required'); //必须要设置规则才能提交该值

            if($this->form_validation->run()===FALSE)
			{
				$this->load->view('templates/header',$this->data);
				$this->load->view('submit/success'); //
				$this->load->view('templates/footer');
			}
			else
			{
				$this->submit_model->set_reply();
				$this->load->view('templates/header',$this->data);
				$this->load->view('submit/success');
				$this->load->view('templates/footer');
			}
        }
	}

?>
