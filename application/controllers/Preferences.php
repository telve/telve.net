<?php

class Preferences extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['title'] = 'Tercihler';

		$this->load->view('templates/header',$this->data);
		$this->load->view('user/preferences');
        $this->load->view('templates/side');
		$this->load->view('templates/footer');

		$this->form_validation->set_rules('username','<b>Kullanıcı adı</b>','trim|required|max_length[255]|xss_clean');

		if($this->form_validation->run() === FALSE){

			//$this->load->view('templates/header');//,$this->data
			//$this->load->view('submit/password');
			//$this->load->view('templates/footer');

		} else {

			$this->link_model->get_email();

			$this->load->view('templates/header',$this->data);
			$this->load->view('submit/success');
			$this->load->view('templates/footer');
		}


    }

    public function sendmail()
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.163.com',
            'smtp_port' => 25,
            'smtp_user' => 'lizhijun20@126.com',
            'smtp_pass' => 'lizhijun09',
            'charset' => 'GBK',
            'mailtype' => 'html',
        );
        // $config_ssl = Array(
        // 'protocol' => 'smtp',
        // 'smtp_host' => 'ssl://smtp.gmail.com',
        // 'smtp_port' => '465',
        // 'smtp_user' => '123@gmail.com',
        // 'smtp_pass' => '123',
        // 'mailtype' => 'html',
        // );

        $this->load->library('email', $config);

        $this->email->set_newline("rn");
        $from_name = "YES"; //Sender name
        $email_subject ="Registering";
        $email_msg="
        Hi, register! Hello! Please pay attention to check!";
        //Solve the garbled problem
        //$from_name = iconv('UTF-8','GBK',$from_name);
        //$email_subject = iconv('UTF-8','GBK',$email_subject);
        //$email_msg = iconv('UTF-8','GBK',$email_msg);
        //Package to send information

        $this->email->from('admin@91toutiao.com', $from_name);
        //$this->email->reply_to('you@example.com', 'Your Name'); //Mail reply address
        $this->email->to('lizhijun20@126.com');
        //$this->email->cc('another@another-example.com'); //Cc
        //$this->email->bcc('them@their-example.com'); //Bcc

        $this->email->subject($email_subject); //the subject of the email
        $this->email->message($email_msg); //the body part of the email
        $this->email->attach('./uploads/create_thumb.png'); //Add attachments

        if (!$this->email->send())
        {
            show_error($this->email->print_debugger());
            //return false;
        }
        else
        {
            echo"OK";
            //return true;
        }
    }
}
?>
