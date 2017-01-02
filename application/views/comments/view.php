<?php $this->load->helper('human_timing'); ?><!--Format the time-->

<div class="container-fluid">
    <div class="row-fluid"><!-- style="background-color:#9bb;"-->
        <div class="span9">

			<!-- row-fluid > link -->
            <div class="row-fluid" style="margin:8px 0;">
                <div id="link">
    				<style type="text/css">/*Need to be improved*/
                        div.digg {/*background-color:#ffff99;*/height:40px;width:30px;float:left;text-align:center;}
                        div.picontainer {/*background-color:#369;*/height:80px;width:90px;float:left;text-align:center;}
    					div.middle {/*background-color:#369;height:80px;width:80px;*/float:left;text-align:center;}/*Adaptive picture size*/
                    </style>

					<div class="digg">
						<div><a href="javascript:void(0);" id="<?php echo $link_item['id'];?>" onclick="up(this);" class="login-required"><i class="icon-thumbs-up"></i></a></div>
						<strong><div id="show-<?php echo $link_item['id'];?>"><?php echo $link_item['score'];?></div></strong>
						<div><a href="javascript:void(0);" id="<?php echo $link_item['id'];?>" onclick="down(this);" class="login-required"><i class="icon-thumbs-down"></i></a></div>
					</div>

					<div class="picontainer">
						<div class="middle">
                            <?php if (empty($link_item['url'])) { ?>
                            	<a href="<?php echo base_url("comments/view")."/".$link_item['id']."/";?>"><img class="media-object" src="<?php echo base_url('assets/img/icons/17837.png');?>" width="70" height="70" style="max-height: 70px;"/></a>
    						<?php } else { ?>
    							<a href="<?php echo $link_item['url'];?>"><img class="media-object" src="<?php echo $link_item['picurl'];?>" onError="this.src='<?php echo base_url('assets/img/icons/1715.png');?>';" width="70" height="70" style="max-height: 70px;"/></a>
    						<?php }?>
						</div>
					</div>


                    <div style="margin-left: 120px;"><!--span10 pull-left-->
                        <?php if (empty($link_item['url'])) { ?>
                            <div><strong><a style="text-decoration: none;color: blue;" href="<?php echo base_url("comments/view")."/".$link_item['id']."/";?>"><?php echo $link_item['title']?></a></strong>&nbsp; &nbsp;<span style="color:#888;">(<span style="color:#888;">text post</span>)</span></div>
                        <?php } else { ?>
                            <div><strong><a style="text-decoration: none;color: blue;" href="<?php echo $link_item['url'];?>"><?php echo $link_item['title']?></a></strong>&nbsp; &nbsp;<span style="color:#888;">(<a style="color:#888;" href="<?php echo base_url().'domain/'.$link_item['domain'].'/';?>"><?php echo $link_item['domain'];?></a>)</span></div>
                        <?php }?>
						<div>
							<small style="color:#888;">submitted <?php echo human_timing($link_item['created']);?>&nbsp;&nbsp;by：<a style="color: #369;" href="#"><?php echo $link_item['username']?></a>&nbsp;&nbsp;to：<a style="color: #369;" href="#"><?php echo $link_item['topic']?></a></small>
						</div>
                        <div>
                            <?php echo $link_item['text'];?>
                        </div>
						<div>
							<div><strong>
								<a style="color:#888;line-height: 1.6em;" href="<?php echo base_url("comments/view")."/".$link_item['id']."/";?>"><?php echo $link_item['comments']?> comments</a>
								&nbsp; &nbsp;<a style="color:#888;line-height: 1.6em;" href="#">share&#9974;</a>&nbsp; &nbsp;<a style="color:#888;line-height: 1.6em;" href="#">favorite&#9733;</a>&nbsp; &nbsp;<a style="color:#888;line-height: 1.6em;" id="hide_link" href="javascript:void(0)">hide&#9737;</a>&nbsp; &nbsp;<a style="color:#888;line-height: 1.6em;" href="#">report&#9873;</a>
							</div></strong>
						</div>
                    </div>

				</div>
			</div>
            <!-- row-fluid > link -->

			<!-- Comments block -->
    		<div>
                <!-- Horizontal dashed dotted line and submit text box -->
                <?php
                $this->load->helper('get_param');
                if($link_item['comments'] == 0) {
                    echo 'No comments (yet)';
                } else if ( ($link_item['comments'] < 20) || $this->input->get('nolimit') ) {
                    echo 'all '.$link_item['comments'].' comments';
                } else {
                    echo 'only 20 comments';
                    echo '&nbsp; &nbsp;<small><a href="'.append_get_param('nolimit=1').'">display all '.$link_item['comments'].'</a></small>';
                }
                ?>
                <div>
                    <div style="border-top:dashed 1px #000000;width:100%;"> </div><!--Draw a dashed dotted line-->
                    <div><small style="color:#888;">
                        <div class="dropdown">
                            sorting:
                            <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="">
                                <?php
                                if ($this->input->get('sort')) {
                                    echo $this->input->get('sort');
                                } else {
                                    echo "hot";
                                }
                                ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li><a tabindex="-1" href="<?php echo base_url("comments/view")."/".$link_item['id']."/";?>">hot</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sort=top'); ?>">top</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sort=new'); ?>">new</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sort=controversial'); ?>">controversial</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sort=old'); ?>">old</a></li>
                            </ul>
                        </div>
                    </small>
                        <div>
                            <br>
                            <textarea rows="4" class="span6" name="content" id="content" onfocus="first_of_all_login()"/></textarea><br />
			                <input type="hidden" name="pid" id="pid" value="<?php echo $link_item['id']?>" />
            				<!--<button class="btn btn-primary  pull-left" type="submit" name="submit" >submit</button>-->
                            <!--<div id="error_msg"></div>-->
                            <button type="submit" id="submit_reply" class="login-required">submit</button>
                <!-- Horizontal dashed dotted line and submit text box -->
                            <br/>
                            <!--Newly submitted replies-->
                            <div id="update_reply" style="margin: 0 0 10px 25px;"></div>
                            <!-- Comment tree -->
                            <?php echo $tree;?>
                            <!-- Comment tree -->

        				</div>
		            </div>
			  </div>
              <!-- <div style="margin: 0 0 10px 25px;"> <a href="#load_more">Load more (192)</a> Each loads 20 </div> -->
			</div>
		</div>





<script type="text/javascript">
		$(document).ready(function(){

        //Default post mode submission
		//$(".show").load("<?php echo base_url('comments/show_load');?>",{'id':$(".show").val()},function(data){alert(data);});

		$("#hide_link").click(function(){
            $("#link").fadeOut(800);
        });

        $("#submit_reply").click(function(){
            if (<?php echo $is_user_logged_in;?>) {
                var content = $("#content").val();
                var pid = $("#pid").val();
                var commts = parseInt("<?php echo $link_item['comments'];?>")+1;

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('comments/reply_ajax');?>",
                    data: { 'content' : content, 'pid' :pid },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    },
                    success: function(data){

                        if (data == 1) {
                            $("#content").val('');
                            update_reply = "<!--One reply from the reply tree of this post-->\
                            <div>\
            				<div class='row-fluid' style='font-weight: bold;'>\
            \
            					<div class='span12'>\
            						<style>\
            \
                                    </style>\
            \
            						<div id='switch' style='margin-bottom:4px;color: #888; margin-top:8px;'>\
            \
            							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='color: gray;' id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>\
            \
                                        <a style='color: #369;font-weight: bold;' href='#'><?php echo $link_item['username'];?></a>&nbsp;&nbsp;<span id='show-0'>0</span> points&nbsp;&nbsp;submitted just a moment ago\
                                        &nbsp;<span style='color: gray;'>\
            								(<a style='color: gray;' class='hide_rply' href=''> your comment </a>)</small></span>\
            						</div>\
            \
            						<div class='hide_content' style='margin-bottom:6px;'>\
            \
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" + content + "</span>\
                                        <!--<input type='hidden' class='show' value='0'/>-->\
            						</div>\
            \
            					</div>\
            \
            				</div>\
            \
            				</div>\
            				<!--One reply from the reply tree of this post-->";
                            $("#update_reply").html(update_reply);
                        } else {
                            alert(data);
                        }


                    }
                });
            }

        });
    });

    function up(obj){
        if (<?php echo $is_user_logged_in;?>) {
            $.ajax({
                   type: "POST",
                   url: "<?php echo base_url('comments/up');?>",
                   data: { 'id' : obj.id },
                   success: function(data) {
                       if (data == 1) {
                           $("#show-"+obj.id).html(parseInt($("#show-"+obj.id).html())+1);
                       } else {
                           alert(data);
                       }
                   }
            });
        }
    }

    function down(obj){
        if (<?php echo $is_user_logged_in;?>) {
            $.ajax({
                   type: "POST",
                   url: "<?php echo base_url('comments/down');?>",
                   data: { 'id' : obj.id },
                   success: function(data) {
                       if (data == 1) {
                           $("#show-"+obj.id).html(parseInt($("#show-"+obj.id).html())-1);
                       } else {
                           alert(data);
                       }
                   }
            });
        }
    }

    function rply_up(obj){
        if (<?php echo $is_user_logged_in;?>) {
            $.ajax({
                   type: "POST",
                   url: "<?php echo base_url('comments/rply_up');?>",
                   data: { 'id' : obj.id },
                   error: function(xhr, status, error) {
                       console.log(xhr.responseText);
                   },
                   success:function(data){
                      if (data == 1) {
                          $("#show-"+obj.id).html(parseInt($("#show-"+obj.id).html())+1);
                      } else {
                          alert(data);
                      }
                   }
            });
        }
    }

    function rply_down(obj){
        if (<?php echo $is_user_logged_in;?>) {
            $.ajax({
                   type: "POST",
                   url: "<?php echo base_url('comments/rply_down');?>",
                   data: { 'id' : obj.id },
                   error: function(xhr, status, error) {
                       console.log(xhr.responseText);
                   },
                   success:function(data){
                      if (data == 1) {
                          $("#show-"+obj.id).html(parseInt($("#show-"+obj.id).html())-1);
                      } else {
                          alert(data);
                      }
                   }
            });
        }
    }

    function set_reply(obj){
        if($(obj).nextAll().is("div"))
		{
			$(obj).nextAll("div").children("#content").focus();
		}
		else                   //This can not be used directly reply_item['id']
		{
			replyForm = "<div><div style='border-top:dashed 8px #fff;width:100%;'></div>&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows='4' class='span6' name='content' id='content' onfocus='first_of_all_login()'/></textarea><br />"+
				"<input type='hidden' name='pid' id='pid' value='"+obj.id+"' />"+
                "&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onclick='submit_comment_reply(this)'>submit</button>&nbsp;&nbsp;<button type='button' onclick='cancel_reply(this)'>cancel</button></div>";
			$(obj).after(replyForm);
			$(obj).nextAll("div").children("#content").focus();
		}
    }

    /*
	function show_reply(obj){
		//alert(obj.id);
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('comments/show');?>",
			data:{'id':obj.id},
			error:function(){
				alert("error");
			},
			success:function(json_data){


				var json=eval(json_data); //JSON string will be resolved into JSON data format

				$.each(json, function(k)   //Iterate over the jQuery object and execute the function for each matching element
				{

					//json[k]['id'];
					alert(decodeURI(json[k]['content']));
				});

			}
		});
	}
    */

    function cancel_reply(obj){
        //alert($(obj).parent());
        $(obj).parent().remove(); //Deletes the selected element and its child elements
        $(obj).parent().siblings(".").remove();
    }

    function submit_comment_reply(obj){
        if (<?php echo $is_user_logged_in;?>) {
            var content = $(obj).siblings("#content").val();
            var pid = $(obj).siblings("#pid").val();
            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('comments/reply_ajax');?>",
                    data: { 'content' : content, 'pid' : pid },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    },
                    success:function(data){

                        if (data == 1) {

                            update_reply = "<!--One reply from the reply tree of this post-->\
                            <ul style='list-style-type:none'><li><!--Draw a dividing line-->\
    				            <div style='border-top:dashed 8px #fff;width:100%;'> </div>\
            				<div class='row-fluid'>\
            \
            					<div class='span12'>\
            						<style>\
            \
                                    </style>\
            \
            						<div id='switch' style='margin-bottom:4px;color: #888; margin-top:8px;'>\
            \
            							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='color: gray;' id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>\
            \
                                        <a style='color: #369;font-weight: bold;' href='#'><?php echo $link_item['username'];?></a>&nbsp;&nbsp;<span id='show-0'>0</span> points&nbsp;&nbsp;submitted just a moment ago\
                                        &nbsp;<span style='color: gray;'>\
            								(<a style='color: gray;' class='hide_rply' href=''> your comment </a>)</small></span>\
            						</div>\
            \
            						<div class='hide_content' style='margin-bottom:6px;'>\
            \
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" + content + "</span>\
                                        <!--<input type='hidden' class='show' value='0'/>-->\
            						</div>\
            \
            					</div>\
            \
            				</div>\
            \
            				</div></li></ul>\
            				<!--One reply from the reply tree of this post-->";
                            $(obj).parent().after(update_reply);
                            $(obj).parent().hide();
                        } else {
                            alert(data);
                        }


                    }
            });
        } else {
            $('#myModal').modal('toggle');
            return false; //cancel the event
        }
    }

    function switch_state(obj){
        if($(obj).text()=="[–]")
		{
			$(obj).text("[+]");
			$(obj).parent().siblings(".hide_content").hide().siblings(".hide_function").hide();
            $(obj).siblings(".hide_up").html("&nbsp;&nbsp;&nbsp;&nbsp;");
            $(obj).siblings(".hide_rply").hide();
            $(obj).parent().parent().parent().parent().nextAll("ul").hide('fast');
		}
		else
		{
			$(obj).text("[–]");
			$(obj).parent().siblings(".hide_content").show().siblings(".hide_function").show();
            $(obj).siblings(".hide_up").html("<i class='icon-thumbs-up'></i>");
            $(obj).parent().parent().parent().parent().nextAll("ul").show('fast');
		}
    }
</script>
