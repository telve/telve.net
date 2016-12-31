<div class="span3" style="float:right;margin-top:11px;">
    <div>
        <input type="text" class="span12" placeholder="Search">
    </div>

    <!--
    <table class="table table-bordered">
    <tr><td>
        <!--<form class="form-inline">--//>
          <?php echo form_open('user/login');?>
          <input type="text" class="span6" name="username" placeholder="username">
          <input type="password" class="span6 pull-right" name="password" placeholder="password">
          <br><br>
          <label class="checkbox span4">
            <input type="checkbox">remember me
          </label>

          <a class="checkbox" href="/password">forgot password?</a>
          <button type="submit" class="btn pull-right">log in</button>
        </form>
    </tr></td>
    </table>
    -->
    <?php echo $login_form;?>

    <a class="btn btn-block btn-info login-required" href="<?php echo base_url("submit");?>">Submit a new link</a>
    <br>
    <a class="btn btn-block btn-info login-required" href="<?php echo base_url("submit")."?text=true";?>">Submit a new text post</a>
</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.login-required').click(function() {
            if (!<?php echo $is_user_logged_in;?>) {
                $('#myModal').modal('toggle');
                return false; //cancel the event
            }
        });
    });
    function first_of_all_login() {
        if (!<?php echo $is_user_logged_in;?>) {
            $('#myModal').modal('toggle');
        }
    }
</script>
