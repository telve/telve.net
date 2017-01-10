<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
        <ul class="nav nav-tabs form-tabs" id="myTab">
		  <li class="active"><a style="background-color:#5f99cf;color:#fff" href="#link">Reset your password</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="link">

                <?php echo form_open('password');?>
                <fieldset>
                    <table class="table table-bordered submit-form"><tr><td>

                    <label for="title">Username</label>
                    <input class="span12" id="username" name="username" placeholder="enter your username"/><br />
                    <div style="color:red"><?php echo form_error('username');?></div>
                    </td></tr></table>

                    <button class="btn btn-primary  pull-left" type="submit" name="submit" >Email me</button>
                </fieldset>
                </form>
            </div>
        </div>

    </div>
