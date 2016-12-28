<?php
	class Home extends MY_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('link_model');
		}

		public function index()
		{
            $this->load->library('pagination');

            $config['base_url'] = base_url('home/index');

            $config['total_rows'] = count($this->link_model->get_link_count());
            $config['per_page'] = 10;
            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = 'Previous page';
            $config['next_link'] = 'Next page';
            $config['full_tag_close'] = '</p>';
            $config['display_pages'] = FALSE; //The "number" link is not displayed
            $config['first_link'] = FALSE; //The start link is not displayed
            $config['last_link'] = FALSE;
            $this->pagination->initialize($config);

            $this->data['title'] = 'Home';
            $this->data['link'] = $this->link_model->get_link($id = FALSE,$config['per_page'],$this->uri->segment(3));

			if(!empty($this->session->userdata['username']) && $this->session->userdata['username']){
				$this->data['toggle_sidebar'] = '<div id="toggle-sidebar">
					<a style="display: none;" class="close-sidebar" href="javascript:void(0)" title="折叠">X</a>
					<a class="show-sidebar" href="javascript:void(0)" title="展开" ><</a>
				</div>';
				$this->data['sidebar'] = '<div id="sidebar" class="span1"><!-- background-color:#cbb;-->
				  <ul style="list-style-type:none">
				    <li><a href="#">Subscribe</a></li>
					<li><a href="#">News</a></li>
					<li><a href="#">Images</a></li>
					<li><a href="#">Test</a></li>
					<li><a href="#">Create</a></li>
					<li><a href="#">Find</a></li>
					<li><a href="#">My Collection</a></li>
				  </ul>
				</div>';
			} else {
				$this->data['toggle_sidebar'] = '';
				$this->data['sidebar'] = '';
			}

			$this->load->view('templates/header',$this->data);
			$this->load->view('home/index',$this->data);
			$this->load->view('templates/side');
			$this->load->view('templates/footer');
		}

        public function latest()
		{
			$this->load->helper('url');
			$this->load->library('pagination');

            $config['base_url'] = base_url('home/latest');

            $config['total_rows'] = count($this->link_model->get_latest());
            $config['per_page'] = 4;

            //$config['use_page_numbers'] = TRUE; //use_page_numbers is enabled to display the current page number

            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = 'Previous page';
            $config['next_link'] = 'Next page';
            $config['full_tag_close'] = '</p>';

            $config['display_pages'] = FALSE; //The "number" link is not displayed
            $config['first_link'] = FALSE; //The start link is not displayed
            $config['last_link'] = FALSE;

            $this->pagination->initialize($config);
			$this->data['submit'] = $this->link_model->get_latest($id = FALSE,$config['per_page'],$this->uri->segment(3)); //Latest

			$this->data['title'] = 'Latest';

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

            $config['total_rows'] = count($this->link_model->get_top());
            $config['per_page'] = 4;

            //$config['use_page_numbers'] = TRUE; //use_page_numbers is enabled to display the current page number

            $config['full_tag_open'] = '<p>'; //class = "btn"
            $config['prev_link'] = 'Previous page';
            $config['next_link'] = 'Next page';
            $config['full_tag_close'] = '</p>';

            $config['display_pages'] = FALSE; //The "number" link is not displayed
            $config['first_link'] = FALSE; //The start link is not displayed
            $config['last_link'] = FALSE;

            $this->pagination->initialize($config);
			$this->data['submit'] = $this->link_model->get_top($id = FALSE,$config['per_page'],$this->uri->segment(3));

			$this->data['title'] = 'Top';

			$this->load->view('templates/header',$this->data);
			$this->load->view('submit/top',$this->data);
			$this->load->view('templates/footer');
        }

        public function wiki()
        {

        }



        public function reply()
        {
            $this->load->helper(array('form','url')); //Loads form helper functions and URL helper functions
			$this->load->library('form_validation');

            $this->data['title'] = "首页";

			$this->form_validation->set_rules('content','Content','trim|required|min_length[5]|max_length[228]');
            $this->form_validation->set_rules('sid','Sid','required'); //You must set up a rule to submit the value

            if($this->form_validation->run()===FALSE)
			{
				$this->load->view('templates/header',$this->data);
				$this->load->view('submit/success');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->link_model->set_reply();
				$this->load->view('templates/header',$this->data);
				$this->load->view('submit/success');
				$this->load->view('templates/footer');
			}
        }
	}

?>
