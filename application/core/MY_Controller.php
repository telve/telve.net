<?php

    class MY_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();

            if (!$this->input->is_cli_request()) {
                if ((!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") && ($this->config->item('https_enabled'))) {
                    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    redirect($url);
                    exit;
                }
            }

            if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
                $this->load->model('subscription_model');
                $this->load->model('notification_model');
                $this->data['subscriptions'] = $this->subscription_model->retrieve_only_subscribed();

                if (($this->uri->segment(1) == 'kullanici') && ($this->uri->segment(2) == $this->session->userdata('username'))) {
                    $user_tab_class = 'class="active"';
                    $user_tab_style = 'style="color:red;"';
                } else {
                    $user_tab_class = '';
                    $user_tab_style = '';
                }
                if ($this->uri->segment(1) == 'tercihler') {
                    $preferences_tab_class = 'class="active"';
                    $preferences_tab_style = 'style="color:red;"';
                } else {
                    $preferences_tab_class = '';
                    $preferences_tab_style = '';
                }
                $this->data['login_info'] = "
				<li style='float:right; margin-right:15px;'>
					<a href='".base_url('cikis')."'>
						çıkış <span class='glyphicon glyphicon-log-out'></span>
					</a>
				</li>
				<li style='float:right;' ".$preferences_tab_class.">
					<a href='".base_url('tercihler')."' ".$preferences_tab_style.">
						tercihler<span class='glyphicon glyphicon-cog'></span>
					</a>
				</li>
				<li style='float:right;'>
					<a href='#'>
						<span class='glyphicon glyphicon-inbox'></span><sup>".$this->notification_model->get_unread_notification_count()."</sup>
					</a>
				</li>
				<li style='float:right;' ".$user_tab_class.">
					<a href='".base_url('kullanici/').$this->session->userdata('username').'/'."' ".$user_tab_style.">
						".$this->session->userdata('username')."<span class='glyphicon glyphicon-user'></span>
					</a>
				</li>
				";

                $this->data['login_form'] = ""; //The login form is not displayed
                $this->data['is_user_logged_in'] = 1;
                $this->data['toggle_sidebar'] = '<div id="toggle-sidebar">
					<a style="display: none;" class="close-sidebar" href="javascript:void(0)" title="kapat"><span class="glyphicon glyphicon-indent-right"></span></a>
					<a class="show-sidebar" href="javascript:void(0)" title="abonelikleriniz"><span class="glyphicon glyphicon-indent-left"></span></a>
				</div>';
                $this->data['sidebar'] = '<div id="sidebar" class="span1"><!-- background-color:#cbb;-->
				  <ul style="list-style-type:none; margin:0;">';
                foreach ($this->data['subscriptions'] as $subscription) {
                    if ($subscription['topic'] == $this->uri->segment(2)) {
                        $style = 'style="color:red;"';
                    } else {
                        $style = '';
                    }
                    $this->data['sidebar'] .= '<li><a href="'.base_url("")."t/".$subscription['topic']."/".'" '.$style.'>'.$subscription['topic'].'</a></li>';
                }
                $this->data['sidebar'] .= '</ul>
				</div>';
            } else {
                $this->data['login_info'] = "<li style='float:right;margin-right:15px;'><a href='#myModal' data-toggle='modal'><span style='color:gray;'>Hâlâ üye değil misin?</span> Giriş yap veya üye ol <span class='glyphicon glyphicon-log-in'></span></a></li>";
                $this->data['login_form'] = "
					<table class='table table-bordered' style='margin-bottom:0px;'>
						<tr><td>
							".form_open('giris')."
							<input type='text' class='span6' name='username' placeholder='kullanıcı adı'>
							<input type='password' class='span6 pull-right' name='password' placeholder='şifre'>
							<br><br>
							<label class='checkbox span6'>
							<input type='checkbox'  name='remember'>beni hatırla
							</label>

							<a class='checkbox' href='".base_url("sifremi-unuttum")."'>şifremi unuttum?</a>
							<button type='submit' class='btn pull-right' style='margin-top:10px;'>giriş yap</button>
							</form>
						</tr></td>
					</table>

				";
                $this->data['is_user_logged_in'] = 0;
                $this->data['toggle_sidebar'] = '';
                $this->data['sidebar'] = '';
            }

            $this->load->model('link_model');
            $this->data['topics_for_header'] = $this->link_model->retrieve_topics_for_header();

            $this->data['base_url'] = base_url("");
            $this->data['sn'] = 1;

            $this->data['front_forbidden'] = array('t','alan-adi','gonder','kullanici','sifremi-unuttum','konular','aboneliklerim','arama','tercihler','giris','uye-ol','sayfalar');

            $this->data['title'] = 'telve: internetin ön sayfası';
            $this->data['og_image'] = base_url("assets/img/logo/twitter-logo.png");
            $this->data['description'] = 'Kullanıcılar tarafından paylaşılan bağlantılar. Oylamalar sonucunda paylaşımlar ön sayfaya çıkar.';

            $this->data['header_image'] = '';

            $this->data['all_topics'] = $this->link_model->retrieve_all_topics();

            if ($this->data['all_topics']) {
                if ($this->uri->segment(1) == 't') {
                    do {
                        $this->data['chosen_topic'] = $this->data['all_topics'][array_rand($this->data['all_topics'])];
                    } while ($this->data['chosen_topic'] == urldecode($this->uri->segment(2)));
                } else {
                    $this->data['chosen_topic'] = $this->data['all_topics'][array_rand($this->data['all_topics'])];
                }
            } else {
                $this->data['chosen_topic'] = null;
            }
        }
    }
