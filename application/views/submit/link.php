<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
        <?php echo validation_errors();?>
        <ul class="nav nav-tabs form-tabs" id="myTab">
          <?php if ($is_text_post) { ?>
              <li><a class="submit" href="#link">Bağlantı gönder</a></li>
              <li class="active"><a class="submit" href="#text">Metin gönder</a></li>
          <?php } else { ?>
              <li class="active"><a class="submit" href="#link">Bağlantı gönder</a></li>
              <li><a class="submit" href="#text">Metin gönder</a></li>
          <?php };?>
        </ul>

        <div class="tab-content">
            <?php if ($is_text_post) { ?>
                <div class="tab-pane" id="link">
            <?php } else { ?>
                <div class="tab-pane active" id="link">
            <?php };?>
                <?php echo form_open('gonder');?>
                <fieldset>

                    <table class="table table-bordered submit-form"><tr><td>
                    <label for="title">Başlık</label>
                    <textarea rows="2" class="span12" id="title" name="title" value="<?php echo set_value('title');?>" placeholder="bağlantının başlığı..."/></textarea><br />
                    <div style="color:red"><?php echo form_error('title');?></div>
                    </td></tr></table>

                    <table class="table table-bordered submit-form"><tr><td>
                    <label for="url">URL (tam adresi)</label>
                    <input type="text" class="span12" name="url" id="url" value="<?php echo set_value('url');?>" placeholder="bağlantının URL'si http://... ile başlayan"/><br />
                    <div style="color:red"><?php echo form_error('url');?></div>

                    <a href="javascript:void(0)" class="btn btn-primary pull-right btn-blue" id="get_title">Başlık öner</a>
                    </td></tr></table>

                    <table class="table table-bordered submit-form"><tr><td>
                    <label for="topic">Bir konu seçin</label>
                    <input type="text" class="span12 topic" id="topic" value="<?php echo set_value('topic');?>" name="topic" placeholder="bağlantının konusu..."/><br />
                    <div style="color:red"><?php echo form_error('topic');?></div>
                    <!--Show popular topics-->
                    <div class="popular-topics">
                        <?php foreach($topics_for_header as $topic): ?>
                            <a href="javascript:void(0)" onclick="set_topic(this)"><?php echo $topic['topic']; ?></a>&nbsp;&nbsp;
                        <?php endforeach ?>
                    </div>
                    </td></tr></table>

                    <table class="table table-bordered submit-form"><tr><td>
                    <img src="<?php echo base_url('user/captcha');?>" />
                    <br/>
                    <label for="captcha">Doğrulama kodu</label>
                    <input type="text" name="captcha" placeholder="yukarıdaki dört karakteri buraya girin"/>
                    <div style="color:red;"><?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?></div>
                    </td></tr></table>

                    <button class="btn btn-primary btn-blue pull-left" type="submit" name="submit" >Gönder</button>

                </fieldset>
                </form>

            </div>

            <?php if ($is_text_post) { ?>
                <div class="tab-pane active" id="text">
            <?php } else { ?>
                <div class="tab-pane" id="text">
            <?php };?>
                <?php echo form_open('gonder');?>
                <fieldset>

                    <table class="table table-bordered submit-form"><tr><td>
                    <label for="title">Başlık</label>
                    <textarea rows="2" class="span12" id="title" name="title" value="<?php echo set_value('title');?>" placeholder="gönderinin başlığı..."/></textarea><br />
                    <div style="color:red"><?php echo form_error('title');?></div>
                    </td></tr></table>

                    <table class="table table-bordered submit-form"><tr><td>
                    <label for="text">Metin (isteğe bağlı)</label>
                    <textarea rows="5" class="span12" id="text" name="text" value="<?php echo set_value('text');?>" placeholder="gönderinin içeriği... Markdown formatında"/></textarea><br />
                    <a class="link-to-guide pull-right" href="https://vakademi.com.tr/home/category/yazilim/markdown-kullanim-rehberi/hosgeldiniz/">Markdown rehberi</a>
                    <div style="color:red"><?php echo form_error('title');?></div>
                    </td></tr></table>

                    <table class="table table-bordered submit-form"><tr><td>
                    <label for="topic">Bir konu seçin</label>
                    <input type="text" class="span12 topic" id="topic" value="<?php echo set_value('topic');?>" name="topic" placeholder="gönderinin konusu..."/><br />
                    <div style="color:red"><?php echo form_error('topic');?></div>
                    <!--Show popular topics-->
                    <div class="popular-topics">
                        <?php foreach($topics_for_header as $topic): ?>
                            <a href="javascript:void(0)" onclick="set_topic(this)"><?php echo $topic['topic']; ?></a>&nbsp;&nbsp;
                        <?php endforeach ?>
                    </div>
                    </td></tr></table>

                    <table class="table table-bordered submit-form"><tr><td>
                    <img src="<?php echo base_url('user/captcha');?>" />
                    <br/>
                    <label for="captcha">Doğrulama kodu</label>
                    <input type="text" name="captcha" placeholder="yukarıdaki dört karakteri buraya girin"/>
                    <div style="color:red;"><?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?></div>
                    </td></tr></table>

                    <button class="btn btn-primary btn-blue pull-left" type="submit" name="submit" >Gönder</button>

                </fieldset>
                </form>
            </div>
        </div>
    </div>
