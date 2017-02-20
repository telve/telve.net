<?php

class Password extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('string');
    }

    public function index()
    {
        $this->data['title'] = 'Şifrenizi sıfırlayın';


        $this->form_validation->set_rules('email','<b>E-posta</b>','required|valid_email|xss_clean');

		if($this->form_validation->run() === FALSE){

            $this->load->view('templates/header',$this->data);
            $this->load->view('submit/password');
            $this->load->view('templates/side');
            $this->load->view('templates/footer');

		} else {

            $this->load->view('templates/header',$this->data);

			if ($this->user_model->check_email()) {

                $token = random_string('alnum', 24);
                $this->user_model->insert_password_reset($token);

                $to_email = $this->input->post('email');
		        $email_subject = "Şifre sıfırlama";
		        $email_msg = "Şifrenizi sıfırlamak için aşağıdaki bağlantıya tıklayınız:
				<br><br>
				<a href='http://telve.net/sifre-sifirla?token=".$token."'>http://telve.net/sifre-sifirla?token=".$token."</a>
				<br><br>
				<a href='http://telve.net/sifre-sifirla?token=".$token."'><img width='200px' src='http://telve.net/assets/img/logo/twitter-logo.png'/></a>
				<br><br>
				<i>*Bu e-postaya cevap yazmanıza gerek yoktur.</i>";
				$smtp_config = Array(
		            'protocol' => $this->config->item('smtp_protocol'),
		            'smtp_host' => $this->config->item('smtp_host'),
		            'smtp_port' => $this->config->item('smtp_port'),
		            'smtp_user' => $this->config->item('smtp_user'),
		            'smtp_pass' => $this->config->item('smtp_pass'),
		            'charset' => 'utf8',
		            'mailtype' => 'html',
					'newline' => "\r\n",
		        );
		        $this->load->library('email', $smtp_config);
		        $this->email->from($this->config->item('smtp_user'), $this->config->item('smtp_from_name'));
				$this->email->to($to_email);
		        $this->email->subject($email_subject);
		        $this->email->message($email_msg);
				$this->email->send();

				$this->session->set_flashdata('password_reset_is_successful',1);
        		redirect(''); //default: hot/index

            } else {
                echo "
                <script type='text/javascript'>
                    setTimeout(function(){
                        alertify.error('E-posta adresi veritabanımızda bulunamadı!');
                    }, 1000);
                </script>
                ";
            }

            $this->load->view('submit/password');
            $this->load->view('templates/side');
            $this->load->view('templates/footer');
		}


    }

    public function reset()
    {
        $password_reset = $this->user_model->retrieve_password_reset($this->input->get('token'));
        //echo md5($this->input->get('token'));
        //echo $password_reset['email'];
        if ($password_reset) {

            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password','<b>Şifre</b>','trim|required|min_length[6]|matches[passconf]|xss_clean');
    			$this->form_validation->set_rules('passconf','<b>Şifrenizi doğrulayın</b>','required|xss_clean');

                if (!($this->form_validation->run() === FALSE)) {
    				$this->user_model->password_reset_update_user($password_reset['email']);
                    $this->session->set_flashdata('password_reset_is_complete',1);
            		redirect('giris');
    			}
            }

            $this->data['title'] = 'Şifre sıfırlama ekranı';
            $this->load->view('templates/header',$this->data);
            $this->load->view('submit/password_reset');
            $this->load->view('templates/footer');
        } else {
            redirect('');
        }
    }

}
?>
