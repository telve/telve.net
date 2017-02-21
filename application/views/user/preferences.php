<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
    <?php echo form_open('tercihler');?>
    <fieldset>

        <ul class="nav nav-tabs form-tabs" id="myTab">
		  <li class="active"><a style="background-color:#5f99cf;color:#fff" href="#link">Bildirimler</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="link">
                <table class="table table-bordered submit-form"><tr><td>
                    <label for="enable_email_notification" style="display:inline-block;">E-posta bildirimleri aktif edilsin mi?</label>
                    <input type="checkbox" name="enable_email_notification" value="1" style="margin-bottom:5px;margin-left:10px;" checked="checked"><br />
                    <div style="color:red"><?php echo form_error('username');?></div>
                    </td></tr>
                </table>
            </div>
        </div>

        <ul class="nav nav-tabs form-tabs" id="myTab">
		  <li class="active"><a style="background-color:#5f99cf;color:#fff" href="#link">Şifre değişikliği</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="link">
                <table class="table table-bordered submit-form">
                <tr>
                    <td>
                        <label for="password">Şifre</label>
            			<input type="password" name="password" value="<?php echo set_value('password');?>" placeholder="bir şifre belirleyin"/><br />
            			<div style="color:red;"><?php echo form_error('password');?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="passconf">Şifrenizi doğrulayın</label>
            			<input type="password" name="passconf" value="<?php echo set_value('passconf');?>" placeholder="belirlediğiniz şifreyi tekrar girin"/><br />
            			<div style="color:red;"><?php echo form_error('passconf');?></div><br />
                    </td>
                </tr>
                </table>

                <button class="btn btn-primary btn-blue  pull-left" type="submit" name="submit" >Kaydet</button>
            </div>
        </div>

    </fieldset>
    </form>
    </div>
