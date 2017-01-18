<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
        <ul class="nav nav-tabs form-tabs" id="myTab">
		  <li class="active"><a style="background-color:#5f99cf;color:#fff" href="#link">Notifications</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="link">

                <?php echo form_open('preferences');?>
                <fieldset>
                    <table class="table table-bordered submit-form"><tr><td>

                    <label for="enable_email_notification" style="display:inline-block;">Enable email notification?</label>
                    <input type="checkbox" name="enable_email_notification" value="1" style="margin-bottom:5px;margin-left:10px;" checked="checked"><br />
                    <div style="color:red"><?php echo form_error('username');?></div>
                    </td></tr></table>

                    <button class="btn btn-primary  pull-left" type="submit" name="submit" >Save</button>
                </fieldset>
                </form>
            </div>
        </div>

    </div>
