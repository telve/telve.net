<div class="row-fluid">
		<div class="span11 pull-right">
			<?php echo form_open('user/register');?>

			<br>
			<fieldset>
			<legend>Create a new account</legend>

            <label for="username">Username</label>
			<input id="reg_username" type="text" name="username" value="<?php echo set_value('username');?>" placeholder="choose a username"/>&nbsp;&nbsp;<span id="chk_msg"></span><br />
			<div style="color:red;"><?php echo form_error('username');?></div>

			<label for="email">Email (used to retrieve password)</label>
			<input type="text" name="email" value="<?php echo set_value('email');?>" placeholder="enter email address"/><br />
            <!--<span class="help-block">我们不会主动给你发送邮件。</span>-->
			<div style="color:red;"><?php echo form_error('email');?></div>

			<label for="password">Password</label>
			<input type="password" name="password" value="<?php echo set_value('password');?>" placeholder="enter password"/><br />
			<div style="color:red;"><?php echo form_error('password');?></div>

            <label for="passconf">Confirm</label>
			<input type="password" name="passconf" value="<?php echo set_value('passconf');?>" placeholder="re-enter the password"/><br />
			<div style="color:red;"><?php echo form_error('passconf');?></div>

            <img src="<?php echo base_url('user/captcha');?>" />
            <label for="captcha">Verification code</label>
            <input type="text" name="captcha" placeholder="enter the four characters in the figure above"/>
            <div style="color:red;"><?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?></div>

            <label class="checkbox">
                <input type="checkbox" name="remember"/> remember me
            </label>

			<button class="btn btn-primary" type="submit" name="submit" >Submit</button>

            <!--错误提示<span id="msg"></span>-->

			</fieldset>
			</form>

		</div>
</div>



<script type="text/javascript">
   $(document).ready(function(){
        $("#reg_username").keyup(function(){
            var username = $(this).val();
            //alert(username);
            $.ajax({
                type:"POST",
                url:"<?php echo base_url('user/chk_username');?>",
                data:{'username':username},
                error:function(){
                    alert("error");
                },
                success:function(msg){
                    $("#chk_msg").html(msg);
                }
            });
        });
   });
</script>
