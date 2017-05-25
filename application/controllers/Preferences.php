<?php

class Preferences extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->data['title'] = 'Tercihler';

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', '<b>Şifre</b>', 'trim|required|min_length[6]|matches[passconf]|xss_clean');
            $this->form_validation->set_rules('passconf', '<b>Şifrenizi doğrulayın</b>', 'required|xss_clean');

            if (!($this->form_validation->run() === false)) {
                $this->user_model->change_password();
                $this->session->set_flashdata('password_reset_is_complete', 1);
                redirect('');
            }
        } else {
            $this->load->view('templates/header', $this->data);
            $this->load->view('user/preferences');
            $this->load->view('templates/side');
            $this->load->view('templates/footer');
        }
    }
}
