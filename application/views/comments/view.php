<?php require "formatTime.php";?><!--Format the time-->

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
						<div><a href="javascript:void(0);" id="<?php echo $link_item['id'];?>" onclick="up(this);"><i class="icon-thumbs-up"></i></a></div>
						<strong><div id="show-<?php echo $link_item['id'];?>"><?php echo $link_item['score'];?></div></strong>
						<div><a href="javascript:void(0);" id="<?php echo $link_item['id'];?>" onclick="down(this);"><i class="icon-thumbs-down"></i></a></div>
					</div>

					<div class="picontainer">
						<div class="middle">
                            <?php if (empty($link_item['url'])) { ?>
                            	<a href="<?php echo base_url("comments/view")."/".$link_item['id'];?>"><img class="media-object" src="<?php echo base_url('assets/img/icons/17837.png');?>" width="70" height="70" /></a>
    						<?php } else { ?>
    							<a href="<?php echo $link_item['url'];?>"><img class="media-object" src="<?php echo $link_item['picurl'];?>" onError="this.src='<?php echo base_url('assets/img/icons/1715.png');?>';" width="70" height="70" /></a>
    						<?php }?>
						</div>
					</div>


                    <div><!--span10 pull-left-->
                        <?php if (empty($link_item['url'])) { ?>
                            <div><strong><a style="text-decoration: none;color: blue;" href="<?php echo base_url("comments/view")."/".$link_item['id'];?>"><?php echo $link_item['title']?></a></strong>&nbsp; &nbsp;<span style="color:#888;">(<span style="color:#888;">text post</span>)</span></div>
                        <?php } else { ?>
                            <div><strong><a style="text-decoration: none;color: blue;" href="<?php echo $link_item['url'];?>"><?php echo $link_item['title']?></a></strong>&nbsp; &nbsp;<span style="color:#888;">(<a style="color:#888;" href="<?php echo base_url().'domain/'.$link_item['domain'].'/';?>"><?php echo $link_item['domain'];?></a>)</span></div>
                        <?php }?>
						<div>
							<small style="color:#888;">submitted<?php formatTime($link_item['created']);?>&nbsp;&nbsp;by：<a style="color: #369;" href="#"><?php echo $link_item['username']?></a>&nbsp;&nbsp;to：<a style="color: #369;" href="#"><?php echo $link_item['category']?></a></small>
						</div>
						<div>
							<div><strong>
								<a style="color:#888;line-height: 1.6em;" href="<?php echo base_url("comments/view")."/".$link_item['id']?>"><?php echo $link_item['comments']?> comments</a>
								&nbsp; &nbsp;<a style="color:#888;line-height: 1.6em;" href="#">share it</a>&nbsp; &nbsp;<a style="color:#888;line-height: 1.6em;" href="#">collection</a>&nbsp; &nbsp;<a style="color:#888;line-height: 1.6em;" id="hide_link" href="javascript:void(0)">hide</a>&nbsp; &nbsp;<a style="color:#888;line-height: 1.6em;" href="#">report</a>
							</div></strong>
						</div>
                    </div>

				</div>
			</div>
            <!-- row-fluid > link -->

			<!-- Comments block -->
    		<div>
                <!-- Horizontal dashed dotted line and submit text box -->
                Top 200 comments  <small><a href="javascript:void(0)">display all 336</a></small>
                <div>
                    <div style="border-top:dashed 1px #000000;width:100%;"> </div><!--Draw a dashed dotted line-->
                    <div><small style="color:#888;">Sorting: <a href="javascript:void(0)">the best</a> (drop-down selection)</small>
                        <div>
                            <br>
                            <textarea rows="4" class="span6" name="content" id="content"/></textarea><br />
			                <input type="hidden" name="pid" id="pid" value="<?php echo $link_item['id']?>" />
            				<!--<button class="btn btn-primary  pull-left" type="submit" name="submit" >submit</button>-->
                            <!--<div id="error_msg"></div>-->
                            <button type="submit" id="submit_reply">submit</button>
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
              <div style="margin: 0 0 10px 25px;"> <a href="#load_more">Load more (192)</a> Each loads 20 </div>
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
                        update_reply = "<div class='row-fluid'>"+

					"<div class='span12'>"+
						"<style>"+

                            "/*#minus { color:#369;font-size:16px;}"+

                            "#switch a:hover{ color:#fff;background:#369;text-decoration: none;}*/"+

                        "</style>"+

						"<div id='switch'>"+
							"<a class='hide_up' href='javascript:void(0)' id='<?php //echo $reply_item['id'];?>' onclick='rply_up(this)'><i class='icon-thumbs-up'></i></a>"+

							"&nbsp;<a id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[-]</a>&nbsp;<small>"+

                            "<a href='#'><?php //echo $reply_item['username']?></a>&nbsp;&nbsp;<span id='show-<?php //echo $reply_item['id'];?>'><?php //echo $reply_item['score'];?></span>points&nbsp;&nbsp;published on <?php //formatTime($reply_item['created']);?>"+
                            "&nbsp;"+
								"(<a class='hide_rply' href='<?php //echo base_url('comments/view').'/'.$reply_item['id']?>'> <?php //echo $reply_item['comments']?> reply</a>)</small>"+
						"</div>"+

						"<div class='hide_content'>"+
                            "<a href='javascript:void(0)' id='<?php //echo $reply_item['id'];?>' onclick='rply_down(this)'><i class='icon-thumbs-down'></i></a>"+

                            "&nbsp;<span>"+content+"</span>"+
                            "<!--<input type='hidden' class='show' value='<?php //echo $reply_item['id']?>'/>-->"+
						"</div>"+

						"<div class='hide_function'>"+
							"<div>"+
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a href='#'>collection</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'>report</a>&nbsp;&nbsp;&nbsp;&nbsp;</small><a href='javascript:void(0)' onclick='set_reply(this)' id='<?php //echo $reply_item['id']?>'><small>{reply}</small></a><!--&nbsp;&nbsp;"+
								"<small><a href='javascript:void(0)' id='<?php //echo $reply_item['id']?>' onclick='show_reply(this)'>show comments</a></small>-->"+
							"</div>"+

                            "<!--Draw a dividing line-->"+
				            "<div style='border-top:dashed 8px #fff;width:100%;'> </div>"+
						"</div>"+
					"</div>"+

				"</div>";
                        $("#update_reply").html(update_reply);
                    } else {
                        alert(data);
                    }


                }
            });

        });
    });

    function up(obj){
        //alert(obj.id);
        var upped=parseInt($("#show-"+obj.id).html())+1;
        $.ajax({
               type:"POST",
               url:"<?php echo base_url('comments/up');?>",
               data:{ 'score' : upped,'id' : obj.id },
               success:function(){
                  var scoreHTML = "";
                  scoreHTML = upped;
                  $("#show-"+obj.id).html(scoreHTML);
               }
        });
    }

    function down(obj){
        //alert(obj.id);
        var upped=parseInt($("#show-"+obj.id).html())-1;
        $.ajax({
               type:"POST",
               url:"<?php echo base_url('comments/down');?>",
               data:{ 'score' : upped,'id' : obj.id },
               success:function(){
                  var scoreHTML = "";
                  scoreHTML = upped;
                  $("#show-"+obj.id).html(scoreHTML);
               }
        });
    }

    function rply_up(obj){
        //alert(obj.id);
        var upped=parseInt($("#show-"+obj.id).html())+1;
        $.ajax({
               type:"POST",
               url:"<?php echo base_url('comments/rply_up');?>",
               data:{ 'score' : upped,'id' : obj.id },
               error:function(){
                    alert("error");
               },
               success:function(){
                  var scoreHTML = "";
                  scoreHTML = upped;
                  $("#show-"+obj.id).html(scoreHTML);
               }
        });
    }

    function rply_down(obj){
        //alert(obj.id);
        var upped=parseInt($("#show-"+obj.id).html())-1;
        $.ajax({
               type:"POST",
               url:"<?php echo base_url('comments/rply_down');?>",
               data:{ 'score' : upped,'id' : obj.id },
               success:function(){
                  var scoreHTML = "";
                  scoreHTML = upped;
                  $("#show-"+obj.id).html(scoreHTML);
               }
        });
    }

    function set_reply(obj){
        if($(obj).nextAll().is("div"))
		{
			$(obj).nextAll("div").children("#content").focus();
		}
		else                   //This can not be used directly reply_item['id']
		{
			replyForm = "<div><div style='border-top:dashed 8px #fff;width:100%;'></div>&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows='4' class='span6' name='content' id='content'/></textarea><br />"+
				"<input type='hidden' name='pid' id='pid' value='"+obj.id+"' />"+
                "&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onclick='submit_reply(this)'>submit</button>&nbsp;&nbsp;<button type='button' onclick='cancel_reply(this)'>cancel</button></div>";
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

    function submit_reply(obj){
        var content = $(obj).siblings("#content").val();
        var pid = $(obj).siblings("#pid").val();
        $.ajax({
                type:"POST",
                url:"<?php echo base_url('comments/reply_ajax');?>",
                data:{'content':content,'pid':pid},
                error:function(){
                    alert("error");
                },
                success:function(data){

                    //$("#error_msg").html("<span style='color:red'>Here to say something</span>");
                    if(data){

                        update_reply = "<ul style='list-style-type:none'><li><!--Draw a dividing line-->"+
				            "<div style='border-top:dashed 8px #fff;width:100%;'> </div>"+
							"<div class='row-fluid'>"+

					"<div class='span12'>"+
						"<style>"+

                            "/*#minus { color:#369;font-size:16px;}"+

                            "#switch a:hover{ color:#fff;background:#369;text-decoration: none;}*/"+

                        "</style>"+

						"<div id='switch'>"+
							"<a class='hide_up' href='javascript:void(0)' id='<?php //echo $reply_item['id'];?>' onclick='rply_up(this)'><i class='icon-thumbs-up'></i></a>"+

							"&nbsp;<a id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[-]</a>&nbsp;<small>"+

                            "<a href='#'><?php //echo $reply_item['username']?></a>&nbsp;&nbsp;<span id='show-<?php //echo $reply_item['id'];?>'><?php //echo $reply_item['score'];?></span>points&nbsp;&nbsp;published on <?php //formatTime($reply_item['created']);?>"+
                            "&nbsp;"+
								"(<a class='hide_rply' href='<?php //echo base_url('comments/view').'/'.$reply_item['id']?>'> <?php //echo $reply_item['comments']?> reply</a>)</small>"+
						"</div>"+

						"<div class='hide_content'>"+
                            "<a href='javascript:void(0)' id='<?php //echo $reply_item['id'];?>' onclick='rply_down(this)'><i class='icon-thumbs-down'></i></a>"+

                            "&nbsp;<span>"+content+"</span>"+
                            "<!--<input type='hidden' class='show' value='<?php //echo $reply_item['id']?>'/>-->"+
						"</div>"+

						"<div class='hide_function'>"+
							"<div>"+
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a href='#'>collection</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'>report</a>&nbsp;&nbsp;&nbsp;&nbsp;</small><a href='javascript:void(0)' onclick='set_reply(this)' id='<?php //echo $reply_item['id']?>'><small>{reply}</small></a><!--&nbsp;&nbsp;"+
								"<small><a href='javascript:void(0)' id='<?php //echo $reply_item['id']?>' onclick='show_reply(this)'>show comments</a></small>-->"+
							"</div>"+
						"</div>"+
					"</div>"+

				"</div></li></ul>";
                        $(obj).parent().after(update_reply);
                        $(obj).parent().hide();
                    }


                }
            });
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
