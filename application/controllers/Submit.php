<?php

	class Submit extends CI_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('submit_model');
			//$this->load->model('get_model');
		}

		public function index()
		{

			$data['title'] = "Submit";
			//$data['credit'] = $this->get_model->get_credit();

			$this->form_validation->set_rules('title','title','trim|required|max_length[255]');
            $this->form_validation->set_rules('url','URL','trim|required|max_length[255]');
            $this->form_validation->set_rules('category','category','trim|required|max_length[255]');
            $this->form_validation->set_rules('captcha','verification code','trim|required|exact_length[4]|strtolower');

			if(!empty($this->session->userdata['username']) && $this->session->userdata['username']){
				$data['login_info'] = "<div class='pull-right'>".$this->session->userdata('username')."(<abbr title='Link integration'><strong>1</strong></abbr>) | <a href='#'><i class='icon-envelope'></i></a> | <strong><a href='#'>Preference</a></strong> | <a href='".base_url('user/logout')."'>Log out</a> </div><br />";

				$data['login_form'] = "";//不显示登录表单
			}else{
				$data['login_info'] = "<a href='#myModal' data-toggle='modal'><span style='color:gray;'>Want to join?</span> Log in or sign up <span style='color:gray;'>in seconds</span></a>";
				$data['login_form'] = "
					<table class='table table-bordered'>
						<tr><td>
							".form_open('user/login')."
							<input type='text' class='span6' name='username' placeholder='username'>
							<input type='password' class='span6 pull-right' name='password' placeholder='password'>
							<br><br>
							<label class='checkbox span4'>
							<input type='checkbox'>remember me
							</label>

							<a class='checkbox' href='/password'>forgot password?</a>
							<button type='submit' class='btn pull-right'>log in</button>
							</form>
						</tr></td>
					</table>

				";
			}

			if($this->form_validation->run()===FALSE){

                $this->load->view('templates/header',$data);
				$this->load->view('submit/link');
				$this->load->view('templates/footer');
			}else{

                $this->submit_model->set_link();
				$this->load->view('templates/header',$data);
				$this->load->view('submit/success');
				$this->load->view('templates/footer');
			}

		}

        public function get_title(){

            //此处还需要判断post过来的字符串是否为网址或为空

            $html = file_get_contents($this->input->post("url"));
            $preg = "/<title>(.*?)<\/title>/si";
            preg_match($preg, $html, $arr);
            //echo trim(mb_convert_encoding($arr[1], "UTF-8", "GBK")); //GBK To UTF-8 编码转换
            //echo $arr[1]; //UTF-8
            echo $this->safeEncoding($arr[1]); //自动识别字符集并完成转码
        }

		public function status()
		{

			$data['title'] = "发布状态";

			$this->form_validation->set_rules('content','Content','trim|required|min_length[5]|max_length[228]');

			if(!empty($this->session->userdata['username']) && $this->session->userdata['username']){
				$data['login_info'] = "<div class='pull-right'>".$this->session->userdata('username')."(<abbr title='Link integration'><strong>1</strong></abbr>) | <a href='#'><i class='icon-envelope'></i></a> | <strong><a href='#'>Preference</a></strong> | <a href='".base_url('user/logout')."'>Log out</a> </div><br />";

				$data['login_form'] = "";//不显示登录表单
			}else{
				$data['login_info'] = "<a href='#myModal' data-toggle='modal'><span style='color:gray;'>Want to join?</span> Log in or sign up <span style='color:gray;'>in seconds</span></a>";
				$data['login_form'] = "
					<table class='table table-bordered'>
						<tr><td>
							".form_open('user/login')."
							<input type='text' class='span6' name='username' placeholder='username'>
							<input type='password' class='span6 pull-right' name='password' placeholder='password'>
							<br><br>
							<label class='checkbox span4'>
							<input type='checkbox'>remember me
							</label>

							<a class='checkbox' href='/password'>forgot password?</a>
							<button type='submit' class='btn pull-right'>log in</button>
							</form>
						</tr></td>
					</table>

				";
			}

			if($this->form_validation->run()===FALSE)
			{
				$this->load->view('templates/header',$data);
				$this->load->view('submit/status');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->submit_model->set_submit();
				$this->load->view('templates/header',$data);
				$this->load->view('submit/success');
				$this->load->view('templates/footer');
			}

		}

        private function safeEncoding($string,$outEncoding ='UTF-8')
        {
            $encoding = "UTF-8";
            for($i=0;$i<strlen($string);$i++)
            {
                if(ord($string{$i})<128)
                    continue;

                if((ord($string{$i})&224)==224)
                {
                    //第一个字节判断通过
                    $char = $string{++$i};
                    if((ord($char)&128)==128)
                    {
                        //第二个字节判断通过
                        $char = $string{++$i};
                        if((ord($char)&128)==128)
                        {
                            $encoding = "UTF-8";
                            break;
                        }
                    }
                }

                if((ord($string{$i})&192)==192)
                {
                    //第一个字节判断通过
                    $char = $string{++$i};
                    if((ord($char)&128)==128)
                    {
                        // 第二个字节判断通过
                        $encoding = "GB2312";
                        break;
                    }
                }
            }

            if(strtoupper($encoding) == strtoupper($outEncoding))
                return $string;
            else
                return iconv($encoding,$outEncoding,$string);
        }
	}

?>
