<?php

	class MY_Controller extends CI_Controller{

		public function __construct()
		{
			parent::__construct();

			if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
				$this->data['login_info'] = "<div class='pull-right'>".$this->session->userdata('username')."(<abbr title='Link integration'><strong>1</strong></abbr>) | <a href='#'><i class='icon-envelope'></i></a> | <strong><a href='#'>Preference</a></strong> | <a href='".base_url('user/logout')."'>Log out</a> </div><br />";

				$this->data['login_form'] = ""; //The login form is not displayed
				$this->data['is_user_logged_in'] = 1;
				$this->data['toggle_sidebar'] = '<div id="toggle-sidebar">
					<a style="display: none;" class="close-sidebar" href="javascript:void(0)" title="close"><span class="glyphicon glyphicon-indent-right"></span></a>
					<a class="show-sidebar" href="javascript:void(0)" title="Your subscriptions"><span class="glyphicon glyphicon-indent-left"></span></a>
				</div>';
				$this->data['sidebar'] = '<div id="sidebar" class="span1"><!-- background-color:#cbb;-->
				  <ul style="list-style-type:none">
				    <li><a href="#">Subscribe</a></li>
					<li><a href="#">News</a></li>
					<li><a href="#">Images</a></li>
					<li><a href="#">Test</a></li>
					<li><a href="#">Create</a></li>
					<li><a href="#">Find</a></li>
					<li><a href="#">My Favorites</a></li>
				  </ul>
				</div>';
			} else {
				$this->data['login_info'] = "<a href='#myModal' data-toggle='modal'><span style='color:gray;'>Want to join?</span> Log in or sign up <span style='color:gray;'>in seconds</span></a>";
				$this->data['login_form'] = "
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
				$this->data['is_user_logged_in'] = 0;
				$this->data['toggle_sidebar'] = '';
				$this->data['sidebar'] = '';
			}

			$this->load->model('link_model');
			$this->data['topics'] = $this->link_model->retrieve_topics();

			$this->data['base_url'] = base_url("");
			$this->data['sn'] = 1;

		}

	}

?>
