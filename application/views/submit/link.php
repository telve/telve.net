<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
        <?php echo validation_errors();?>
        <ul class="nav nav-tabs" id="myTab">
          <?php if ($is_text_post) { ?>
              <li><a class="submit" href="#link">Submit a link</a></li>
              <li class="active"><a class="submit" href="#text">Submit a text</a></li>
          <?php } else { ?>
              <li class="active"><a class="submit" href="#link">Submit a link</a></li>
              <li><a class="submit" href="#text">Submit a text</a></li>
          <?php };?>
        </ul>

        <div class="tab-content">
            <?php if ($is_text_post) { ?>
                <div class="tab-pane" id="link">
            <?php } else { ?>
                <div class="tab-pane active" id="link">
            <?php };?>
                <?php echo form_open('submit');?>
                <fieldset>

                    <table style="background-color:#cee3f8" class="table table-bordered"><tr><td>
                    <label for="title">Title</label>
                    <textarea rows="2" class="span12" id="title" name="title" value="<?php echo set_value('title');?>" placeholder="the title of the link..."/></textarea><br />
                    <div style="color:red"><?php echo form_error('title');?></div>
                    </td></tr></table>

                    <table style="background-color:#cee3f8" class="table table-bordered"><tr><td>
                    <label for="url">URL</label>
                    <input type="text" class="span12" name="url" id="url" value="<?php echo set_value('url');?>" placeholder="the URL of the link..."/><br />
                    <div style="color:red"><?php echo form_error('url');?></div>

                    <a href="javascript:void(0)" class="btn btn-primary pull-right" id="get_title">Suggest title</a>
                    </td></tr></table>

                    <table style="background-color:#cee3f8" class="table table-bordered"><tr><td>
                    <label for="category">Choose a category</label>
                    <input type="text" class="span12 category" id="category" value="<?php echo set_value('category');?>" name="category" placeholder="the category of the link..."/><br />
                    <div style="color:red"><?php echo form_error('category');?></div>
                        <!--Show popular categories-->
                        <a href="javascript:void(0)" onclick="set_category(this)">PICS</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">FUNNY</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">GAME</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">ASKTELVE</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">WORLDNEWS</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">NEWS</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">SCIENCE AND TECHNOLOGY</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">EDUCATION</a>
                    </td></tr></table>

                    <table style="background-color:#cee3f8" class="table table-bordered"><tr><td>
                    <img src="<?php echo base_url('user/captcha');?>" />
                    <br/>
                    <label for="captcha">Verification code</label>
                    <input type="text" name="captcha" placeholder="enter the four characters in the figure above"/>
                    <div style="color:red;"><?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?></div>
                    </td></tr></table>

                    <button class="btn btn-primary  pull-left" type="submit" name="submit" >Submit</button>

                </fieldset>
                </form>

            </div>

            <?php if ($is_text_post) { ?>
                <div class="tab-pane active" id="text">
            <?php } else { ?>
                <div class="tab-pane" id="text">
            <?php };?>
                <?php echo form_open('submit');?>
                <fieldset>

                    <table style="background-color:#cee3f8" class="table table-bordered"><tr><td>

                    <label for="title">Title</label>
                    <textarea rows="2" class="span12" id="title" name="title" value="<?php echo set_value('title');?>" placeholder="the title of the post..."/></textarea><br />
                    <div style="color:red"><?php echo form_error('title');?></div>
                    </td></tr></table>

                    <table style="background-color:#cee3f8" class="table table-bordered"><tr><td>
                    <label for="text">Text (optional)</label>
                    <textarea rows="5" class="span12" id="text" name="text" value="<?php echo set_value('text');?>" placeholder="the content of the post..."/></textarea><br />
                    <div style="color:red"><?php echo form_error('title');?></div>
                    </td></tr></table>

                    <table style="background-color:#cee3f8" class="table table-bordered"><tr><td>
                    <label for="category">Choose a category</label>
                    <input type="text" class="span12 category" id="category" value="<?php echo set_value('category');?>" name="category" placeholder="the category of the link..."/><br />
                    <div style="color:red"><?php echo form_error('category');?></div>
                        <!--Show popular categories-->
                        <a href="javascript:void(0)" onclick="set_category(this)">PICS</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">FUNNY</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">GAME</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">ASKTELVE</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">WORLDNEWS</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">NEWS</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">SCIENCE AND TECHNOLOGY</a>&nbsp;&nbsp;
      					<a href="javascript:void(0)" onclick="set_category(this)">EDUCATION</a>
                    </td></tr></table>

                    <table style="background-color:#cee3f8" class="table table-bordered"><tr><td>
                    <img src="<?php echo base_url('user/captcha');?>" />
                    <br/>
                    <label for="captcha">Verification code</label>
                    <input type="text" name="captcha" placeholder="enter the four characters in the figure above"/>
                    <div style="color:red;"><?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?></div>
                    </td></tr></table>

                    <button class="btn btn-primary  pull-left" type="submit" name="submit" >Submit</button>

                </fieldset>
                </form>
            </div>
        </div>

		<!--Tab switching-->
        <script>
            $('#myTab a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            })
        </script>

    </div>


<script type="text/javascript">
    function set_category(obj) { //Function name can not be category, with the previous id, class conflict
        $(".category").val(obj.text)
    }

    $("#get_title").click(function(){
        var url = $("#url").val();
        //alert(url);

        $.ajax({
            type:"POST",
            url:"<?php echo base_url('submit/get_title');?>",
            data:{'url':url},
            error:function(){
                alert("error");
            },
            success:function(data){
                //alert(data);
                $("#title").val(data);
            }
        });
    });
</script>
