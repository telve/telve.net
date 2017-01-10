<?php

	class MY_Controller extends CI_Controller{

		public function __construct()
		{
			parent::__construct();

			if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
				$this->data['login_info'] = "
				<li style='float:right; margin-right:15px;'>
					<a href='".base_url('user/logout')."'>
						logout <span class='glyphicon glyphicon-log-out'></span>
					</a>
				</li>
				<li style='float:right;'>
					<a href='#'>
						preferences<span class='glyphicon glyphicon-cog'></span>
					</a>
				</li>
				<li style='float:right;'>
					<a href='#'>
						<span class='glyphicon glyphicon-inbox'></span>
					</a>
				</li>
				<li style='float:right;'>
					<a href='#'>
						".$this->session->userdata('username')."<span class='glyphicon glyphicon-user'></span>
					</a>
				</li>
				";

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
				$this->data['login_info'] = "<li style='float:right;width:302px;margin-right:15px;'><a href='#myModal' data-toggle='modal'><span style='color:gray;'>Want to join?</span> Log in or sign up <span class='glyphicon glyphicon-log-in'></span> <span style='color:gray;'>&nbsp;in seconds</span></a></li>";
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
							<button type='submit' class='btn pull-right' style='margin-top:10px;'>log in</button>
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

			$this->data['front_forbidden'] = array('t','domain','submit','user','password');

		}

	}

?>
