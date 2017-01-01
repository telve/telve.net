<?php require "formatTime.php";?><!--Format the time-->

<style type="text/css">
	#right-content {
		background: none repeat scroll 0 0 white;
		color: black;
		float: left;
		padding-bottom: 10px;
		width: 72%;
	}

	#sidebar {
		display: none;
		float: left;
		width: 8%;
	}
	#toggle-sidebar {
		position: absolute;
		left: 0;
	}

	#toggle-sidebar .show-sidebar {
		background:#fff;
		border: 1px solid #D2D2D2;
		border-top:0;
		box-shadow: 0 0 1px #CCCCCC;
		color: #808080;
		cursor: pointer;
		float: left;
		font-family: Consolas,monospace;
		font-size: 12px;
		padding: 415px 3px;
		text-shadow: 0 -1px #333333, 0 1px #FFFFFF;
		text-decoration:none;
	}

	#toggle-sidebar .close-sidebar{
		background:#fff;
		border: 1px solid #D2D2D2;
		border-top:0;
		box-shadow: 0 0 1px #CCCCCC;
		color: #808080;
		cursor: pointer;
		float: left;
		margin-left:120px;
		font-family: Consolas,monospace;
		font-size: 12px;
		padding: 415px 3px;
		text-shadow: 0 -1px #333333, 0 1px #FFFFFF;
		text-decoration:none;
	}

	#toggle-sidebar a:hover {
		background:#F7F7F7;
		border: 1px solid #D2D2D2;
		border-top:0;
		box-shadow: 0 0 1px #CCCCCC;
		color: #808080;
		cursor: pointer;
		float: left;
		font-family: Consolas,monospace;
		font-size: 12px;
		padding: 415px 3px;
		text-shadow: 0 -1px #333333, 0 1px #FFFFFF;
		text-decoration:none;
	}

	#sidebar {
		list-style-type:none;
		background:#F7F7F7;
		background-image: -moz-linear-gradient(center top , #F8F8F8, #E8E8E8);
		border: 1px solid #D2D2D2;
		border-top:0;
		border-top:left;
		box-shadow: 0 0 1px #CCCCCC;
		height:851px;
	}
	#sidebar ul li {
		text-decoration:none;
		background:#E9F2FC;
		border:5px solid #E9F2FC;
		margin-top:28px;
	}
	#sidebar ul li a {
		text-decoration:none;
	}
	#sidebar ul li a:hover {
		text-decoration:none;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('.close-sidebar').click(function() {
		   $('.close-sidebar').hide();
		   $('.show-sidebar').show();
		   $('#right-content').animate({width: "72%"},'fast').prev().hide('fast');
		});

		$('.show-sidebar').click(function() {
		   $('.show-sidebar').hide();
		   $('.close-sidebar').show();
		   $('#right-content').animate({width: "64%"}, 'fast').prev().show('fast');
		});
	});
</script>

<?php echo $toggle_sidebar ?>

<div class="container-fluid">
  <div class="row-fluid">

	<?php echo $sidebar ?>

    <div id="right-content" class="span8"><!-- style="background:#abb;"-->

        <style type="text/css">
            div.left {/*background-color:#369;*/height:60px;width:50px;float:left;text-align:center;}
            div.rank {/*background-color:#ffff99;*/height:40px;width:20px;float:left;text-align:center;}
            div.digg {/*background-color:#ffff99;*/height:40px;width:20px;float:left;text-align:center;}
            div.middle {/*background-color:#369;height:80px;width:80px;*/float:left;text-align:center;}/*Adaptive picture size*/
        </style>

        <?php
		$item_counter = 0;
		if (count($link) == 0) {
			echo '<br><br><h2 style="margin-left: 50px;">No posts were found</h2>';
		}
		foreach($link as $link_item):
		$item_counter += 1;
		$currentPage = floor(($this->uri->segment(3)/$per_page) + 1);
		$rank = ($currentPage - 1) * 10 + $item_counter;
		?>


            <div class="row-fluid">
                <div class="span12">

                    <div class="link" style="margin-top:11px;"><!--background-color:#fbb;-->
                    <div class="row-fluid">
                        <div class="left"><!-- style="background-color:#3bb;"-->

                            <div class="row-fluid">
                                <div class="rank">
                                <div>  </div>
                                <div style="color: #c6c6c6;font-size: medium;text-align: right;margin-right:10px;">  <br /><?php echo $rank;?></div>
                                <div>  </div>
                                </div>
                                <div class="digg">

									<div><a href="javascript:void(0)" id="up-<?php echo $link_item['id'];?>" class="login-required" onclick="up(<?php echo $link_item['id'];?>)"><i class="icon-thumbs-up"></i></a></div>

									<strong><div class="text-center" style="line-height: 1.6em;font-weight: bold;" id="show-<?php echo $link_item['id'];?>"><?php echo $link_item['score'];?></div></strong>

									<div><a href="javascript:void(0)" id="down-<?php echo $link_item['id'];?>" class="login-required" onclick="down(<?php echo $link_item['id'];?>)"><i class="icon-thumbs-down"></i></a></div>

								</div>
                            </div>

                        </div>

						<?php if (empty($link_item['url'])) { ?>
                        	<div class="middle"><a href="<?php echo base_url("comments/view")."/".$link_item['id'];?>"><img class="media-object" src="<?php echo base_url('assets/img/icons/17837.png');?>" width="70" height="70" /></a></div>
						<?php } else { ?>
							<div class="middle"><a href="<?php echo $link_item['url'];?>"><img class="media-object" src="<?php echo $link_item['picurl'];?>" onError="this.src='<?php echo base_url('assets/img/icons/1715.png');?>';" width="70" height="70" /></a></div>
						<?php }?>

                        <div class="row-fluid">
                            <div class="span8">
								<?php if (empty($link_item['url'])) { ?>
		                        	<div>&nbsp;&nbsp;<strong><a style="text-decoration: none;color: blue;" href="<?php echo base_url("comments/view")."/".$link_item['id'];?>"><?php echo $link_item['title']?></a></strong>&nbsp; &nbsp;<span style="color:#888;">(<span style="color:#888;">text post</span>)</span></div>
								<?php } else { ?>
									<div>&nbsp;&nbsp;<strong><a style="text-decoration: none;color: blue;" href="<?php echo $link_item['url'];?>"><?php echo $link_item['title']?></a></strong>&nbsp; &nbsp;<span style="color:#888;">(<a style="color:#888;" href="<?php echo base_url().'domain/'.$link_item['domain'].'/';?>"><?php echo $link_item['domain'];?></a>)</span></div>
								<?php }?>
                                <div>&nbsp;
                                    <small style="color:#888;">submitted <?php formatTime($link_item['created']);?>&nbsp;&nbsp;by：<a style="color: #369;" href="#"><?php echo $link_item['username']?></a>&nbsp;&nbsp;&nbsp;to：<a style="color: #369;" href="#"><?php echo $link_item['category']?></a></small>
                                </div>
                                <div>
                                    <div>&nbsp;
                                        <strong><a style="color:#888;line-height: 1.6em;" href="<?php echo base_url("comments/view")."/".$link_item['id'];?>"> <?php echo $link_item['comments'];?>&nbsp;comments</a>
                                        &nbsp;&nbsp;
                                        <a class="sharer" style="color:#888;line-height: 1.6em;" href="javascript:void(0)" onclick="set_share(this)">share</a></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					</div><!--/left-->
                </div>
            </div><!--/row-fluid-->

        <?php endforeach?>

        <?php echo $this->pagination->create_links(); ?>
    </div>



<script type="text/javascript">
    function up(id){
		if (<?php echo $is_user_logged_in;?>) {
	        $.ajax({
	               type: "POST",
	               url: "<?php echo base_url('comments/up');?>",
	               data: {'id' : id },
	               success: function(data) {
					   if (data == 1) {
						   $("#show-"+id).html(parseInt($("#show-"+id).html())+1);
					   } else {
						   alert(data);
					   }
	               }
	        });
		}
	}
	function down(id){
		if (<?php echo $is_user_logged_in;?>) {
	        $.ajax({
	               type: "POST",
	               url: "<?php echo base_url('comments/down');?>",
	               data: {'id' : id },
				   success: function(data) {
					   if (data == 1) {
						   $("#show-"+id).html(parseInt($("#show-"+id).html())-1);
					   }
	               }
	        });
		}
	}
	function set_share(obj){

		if($(obj).text()=='share')
		{
			replyForm = "<div class='share' style='margin-top:18px;'><form class='form-horizontal' action='<?php echo base_url('share');?>' method='post' accept-charset='utf-8'>"+

			  "<div class='control-group'>"+
				"<label class='control-label' for='toEmail'>email address to be sent</label>"+
				"<div class='controls'>"+
				  "<input class='span8' type='text' name='toEmail' value='<?php echo set_value('toEmail');?>'>"+
				  "<span style='color:red;' class='help-inline'><?php echo form_error('toEmail');?></span>"+
				"</div>"+
			  "</div>"+

			  "<div class='control-group'>"+
				"<label class='control-label' for='fromName'>your name</label>"+
				"<div class='controls'>"+
				  "<input class='span8' type='text' name='fromName' value='<?php echo set_value('fromName');?>'>"+
				  "<span style='color:red;' class='help-inline'><?php echo form_error('fromName');?></span>"+
				"</div>"+
			  "</div>"+

			  "<div class='control-group'>"+
				"<label class='control-label' for='fromEmail'>your email</label>"+
				"<div class='controls'>"+
				  "<input class='span8' type='text' name='fromEmail' value='<?php echo set_value('fromEmail');?>'>"+
				  "<span style='color:red;' class='help-inline'><?php echo form_error('fromEmail');?></span>"+
				"</div>"+
			  "</div>"+

			  "<div class='control-group'>"+
				"<label class='control-label' for='message'>your message</label>"+
				"<div class='controls'>"+
				  "<textarea rows=3 class='span8' type='text' name='message'><?php echo set_value('message');?></textarea>"+
				  "<span style='color:red;' class='help-inline'><?php echo form_error('message');?></span>"+
				"</div>"+
			  "</div>"+

			  "<div class='control-group'>"+
				"<div class='controls'>"+
				  "<img src='<?php echo base_url('user/captcha');?>' />"+
				"</div>"+
			  "</div>"+

			  "<div class='control-group'>"+
				"<label class='control-label' for='captcha'>verification code</label>"+
				"<div class='controls'>"+
				  "<input class='span8' type='text' name='captcha' placeholder='enter the four characters in the figure above'>"+
			      "<span style='color:red;' class='help-inline'><?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?></span>"+
				"</div>"+
			  "</div>"+

			  "<div class='control-group'>"+
				"<div class='controls'>"+
				  "<button type='button' onclick='submit_share(this)'>submit</button>&nbsp;&nbsp;"+
				  "<button type='button' onclick='cancel_share(this)'>cancel</button>"+
				"</div>"+
			  "</div>"+

			"</form></div>";

			$(obj).parent().after(replyForm);
			$(obj).text('cancel');
			//$(obj).nextAll("div").children("#content").focus();
		} else {

			$(obj).parent().siblings(".share").remove();
			$(obj).text('share');
		}
    }
	function cancel_share(obj){

		$(obj).parent().parent().parent().parent().siblings("strong").children(".sharer").text("share");
		$(obj).parent().parent().parent().parent().remove().parent().remove();
    }
	function submit_share(obj){
        //var content = $(obj).siblings("#content").val();
        //var pid = $(obj).siblings("#pid").val();
        alert('Features are still being developed');
		$.ajax({
                type:"POST",
                url:"<?php echo base_url('comments/reply_ajax');?>",
                data:{'content':content,'pid':pid},
                error:function(){
                    alert("error");
                },
                success:function(data){

                    if(data){

                        update_reply = "The link has been shared";
                        $(obj).parent().after(update_reply);
                        $(obj).parent().hide();
                    }


                }
            });
    }

	$(document).ready(function(){
		$("#reg_username").change(function(){
			//alert('ok');
		});
	});
</script>
