<!--<p class="text-center"><img src="<?php echo base_url('logo.png');?>"></p>-->
<!--
<style type="text/css">
	.footer {
				color: gray;
				padding: 5px;
				margin: 15px;
				border: 1px solid #F0F0F0;
				display: inline-block;
				padding-top:14px;
	}
	.rounded {
				border-radius: 7px;
	}
	.col{float:left;width:184px;margin-left:16px;}
</style>
<div class="text-center" style="width: 960px;margin: 0 auto;">
<div class="footer rounded">
<div class="col">
	<ul style="padding-left: .8em;border-left: 1px solid #ccc;list-style-type:none;">
		<li class="flat-vert title">关于</li>
		<li><a href="http://www.reddit.com/blog/">博客</a></li>
		<li><span class="separator"></span><a href="http://www.reddit.com/about/">关于</a></li>
		<li><span class="separator"></span><a href="http://www.reddit.com/about/team/">团队</a></li>
	</ul>
</div>

<div class="col">
<ul style="padding-left: .8em;border-left: 1px solid #ccc;list-style-type:none;">
<li class="flat-vert title">帮助</li>
<li><span class="separator"></span><a href="http://www.reddit.com/wiki/faq">常见问题</a></li>
<li><span class="separator"></span><a href="http://www.reddit.com/rules/">使用规则</a></li><li><span class="separator"></span><a href="http://www.reddit.com/feedback/">联系我们</a></li></ul></div>

<div class="col"><ul style="padding-left: .8em;border-left: 1px solid #ccc;list-style-type:none;">
<li class="flat-vert title">工具</li>
<li><a href="http://i.reddit.com">APP</a></li><li><span class="separator"></span><a href="https://addons.mozilla.org/firefox/addon/socialite/">火狐扩展</a></li>
<li><span class="separator"></span><a href="https://chrome.google.com/webstore/detail/algjnflpgoopkdijmkalfcifomdhmcbe">Chrome 扩展</a></li>
</ul></div>
</div>
</div>
-->

<!--Login or register the pop-up dialog-->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="关闭">&times;</button>
        <h4 id="myModalLabel">You need to be logged in to submit things.</h4>
    </div>

    <div class="modal-body" style="margin-left:20px;">
        <div class="row-fluid">
            <div class="span4">
                <?php echo form_open('user/register');?>

                <fieldset>
                    <br/>
                    <strong><div style="font-size:18px">Create a new account</div></strong>
                    <br/>

                    <label for="username">Username</label>
        			<input id="reg_username" type="text" name="username" value="<?php echo set_value('username');?>" placeholder="choose a username"/><br />
        			<div style="color:red;"><?php echo form_error('username');?></div>

        			<label for="email">Email (used to retrieve password)</label>
        			<input type="text" name="email" value="<?php echo set_value('email');?>" placeholder="enter email address"/><br />
                    <!--<span class="help-block">We will not take the initiative to send you mail.</span>-->
        			<div style="color:red;"><?php echo form_error('email');?></div>

        			<label for="password">Password</label>
        			<input type="password" name="password" value="<?php echo set_value('password');?>" placeholder="enter password"/><br />
        			<div style="color:red;"><?php echo form_error('password');?></div>

                    <label for="passconf">Confirm password</label>
        			<input type="password" name="passconf" value="<?php echo set_value('passconf');?>" placeholder="re-enter the password"/><br />
        			<div style="color:red;"><?php echo form_error('passconf');?></div>

                    <img src="<?php echo base_url('user/captcha');?>" />
                    <label for="captcha">Verification code</label>
                    <input type="text" name="captcha" placeholder="enter the four characters in the figure above"/>
                    <div style="color:red;"><?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?></div>

                    <label class="checkbox">
                        <input type="checkbox" name="remember"/> remember me
                    </label>
        			<br/>
        			<button class="btn btn-primary btn-blue" type="submit" name="submit" >Submit</button>

                    <!--Error message<span id="msg"></span>-->

                </fieldset>
            </form>
        </div>




		<div class="span3">
			<div class="row-fluid">
				<div class="span11">
					<br />
					<br />
					<h5>Privacy Policy</h5>
					<ul>
						<li>We promise never to collect data about you and your use of the site.</li>
						<li>We will keep your personal information confidential.</li>
						<li>We promise never to reveal your privacy information.</li>
						<li>Except as required by law, we promise never to disclose your privacy information.</li>
					</ul>
					<p>For more information, please visit <a href="#">Privacy Policy</a>.</p>
				</div>
				<div class="span1"><!--Draw a vertical dividing line-->
					<table style="border-right:2px solid #ddd; height:530px; margin-left:20px;">
						<tr><td >&nbsp;</td></tr>
					</table>
				</div>
			</div>
		</div>

		<div class="span5">
			<?php echo form_open('user/login');?>
            <br/>
			<fieldset style="margin-left:20px;">
                <strong><div style="font-size:18px">Log in</div></strong>
                <small>Already have an account and want to sign in?</small>
                <br/><br/>

    			<label for="username">Username</label>
    			<input type="text" name="username" placeholder="username"/><br />
    			<?php echo form_error('username');?>

    			<label for="password">Password</label>
    			<input type="password" name="password" placeholder="password"/><br />
    			<?php echo form_error('password');?>

                <label class="checkbox">
                    <input type="checkbox" name="remember"/> remember me
                </label>

                <a class="checkbox" href="recover_pwd">forgot password?</a>
                <br/><br/>
    			<button class="btn btn-primary btn-blue" type="submit" name="submit" >Log in</button>

			</fieldset>
        </form>
    </div>
</div>
</div>
</div>

<p class="text-center" style="color:gray;">
Copyright &copy; 2016&nbsp;&nbsp;telve.net&nbsp;&nbsp;All Rights Reserved.
</p>

<script src="<?php echo base_url("assets/js/telve.js");?>"></script>

</body>
</html>
