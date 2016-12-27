<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
        <ul class="nav nav-tabs" id="myTab">
          <!--<li><a href="#link">        </a></li>-->
		  <li class="active"><a style="background-color:#5f99cf;color:#fff" href="#link">Submit a link</a></li>
          <li><a href="#status">Submit a text</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="link">

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
                    <input type="text" class="span12" id="category" value="<?php echo set_value('category');?>" name="category" placeholder="the category of the link..."/><br />
                    <div style="color:red"><?php echo form_error('category');?></div>
                    <!--显示热门分类-->
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
                    <br/><br/>
                    <label for="captcha">Verification code</label>
                    <input type="text" name="captcha" placeholder="enter the four characters in the figure above"/>
                    <div style="color:red;"><?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?></div>
                     </td></tr></table>

                    <button class="btn btn-primary  pull-left" type="submit" name="submit" >Submit</button>

                </fieldset>
                </form>

            </div>
            <div class="tab-pane" id="status">
                <?php echo form_open('status/create');?>



                <fieldset>
                <legend>Release status</legend>


                    <?php echo validation_errors();?>


                    <label for="content">Title</label>
                    <textarea rows="2" class="span12" name="title" placeholder="the title of the link"/></textarea><br />

                    <label for="reason">Content (optional)</label>
                    <textarea rows="4" class="span12" name="content" placeholder="your reasons for sharing..."/></textarea><br />

                    <label for="category">Choose a category</label>
                    <input type="text" class="span12" name="category" placeholder="the category of the link"/><br />
                    <!--显示热门分类-->

                    <!--此处需要一个验证码-->

                    <button class="btn btn-primary  pull-left" type="submit" name="submit" >Submit</button>

                </fieldset>
                </form>
            </div>
        </div>

		<!--Tab切换-->
        <script>
            $('#myTab a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            })
        </script>

    </div>
    <div class="span3 pull-right">
        <div class="pull-right"><?php echo $this->session->userdata('username');?>(<abbr title="链接积分"><strong>1</strong></abbr>) | <a title="没有新消息" href="<?php echo base_url('message/inbox');?>"><i class="icon-envelope"></i></a> | <strong><a href="#">偏好</a></strong> | <a href="<?php echo base_url("user/logout");?>">退出</a> </div>
        <br>
        <hr>
        <div>
            <input type="text" class="span12" placeholder="关键词搜索">
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function set_category(obj) { //函数名不能为category，与前面的id、class冲突
        $("#category").val(obj.text)
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
