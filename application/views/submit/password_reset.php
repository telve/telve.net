<div class="row-fluid">
    <div class="span11 pull-right">
        <?php echo form_open('sifre-sifirla?token='.$this->input->get('token'));?>

            <br>
            <fieldset>
                <legend>Şifre sıfırlama ekranı</legend>

                <label for="password">Şifre</label>
                <input type="password" name="password" value="<?php echo set_value('password');?>" placeholder="bir şifre belirleyin"/><br />
                <div style="color:red;"><?php echo form_error('password');?></div>

                <label for="passconf">Şifrenizi doğrulayın</label>
                <input type="password" name="passconf" value="<?php echo set_value('passconf');?>" placeholder="belirlediğiniz şifreyi tekrar girin"/><br />
                <div style="color:red;"><?php echo form_error('passconf');?></div>

                <br>
                <button class="btn btn-primary btn-blue" type="submit" name="submit">Gönder</button>

                <!--Error message<span id="msg"></span>-->

              </fieldset>
        </form>
    </div>
</div>
