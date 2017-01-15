// Header - logo
$('#turkish-coffee').click(function(){
    window.location = 'https://tr.wikipedia.org/wiki/T%C3%BCrk_kahvesi';
});

$('#site-logo').click(function(){
    window.location = base_url;
});

// Login related
$(document).ready(function() {
    $('.login-required').click(function() {
        if (!is_user_logged_in) {
            $('#myModal').modal('toggle');
            return false; //cancel the event
        }
    });
});
function first_of_all_login() {
    if (!is_user_logged_in) {
        $('#myModal').modal('toggle');
    }
}

// Sidebar (left)
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

// JavaScript under link/index
function up(id){
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/up',
               data: {'id' : id },
               success: function(data) {
                   if (data == 1) {
                       $("#show-"+id).html(parseInt($("#show-"+id).html())+1);
                       var parent = $('#up-'+id)[0];
                       $('i', parent).css('color', 'green');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}
function down(id){
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/down',
               data: {'id' : id },
               success: function(data) {
                   if (data == 1) {
                       $("#show-"+id).html(parseInt($("#show-"+id).html())-1);
                       var parent = $('#down-'+id)[0];
                       $('i', parent).css('color', 'red');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}

function set_share(obj){
    if($(obj).text()=='share')
    {
        replyForm = "<div class='share' style='margin-top:18px;'><form class='form-horizontal' action='" + base_url + 'share' + "' method='post' accept-charset='utf-8'>"+

          "<div class='control-group'>"+
            "<label class='control-label' for='toEmail'>email address to be sent</label>"+
            "<div class='controls'>"+
              "<input class='span8' type='text' name='toEmail' value='" + set_value_toEmail + "'>"+
              "<span style='color:red;' class='help-inline'>" + form_error_toEmail + "</span>"+
            "</div>"+
          "</div>"+

          "<div class='control-group'>"+
            "<label class='control-label' for='fromName'>your name</label>"+
            "<div class='controls'>"+
              "<input class='span8' type='text' name='fromName' value='" + set_value_fromName + "'>"+
              "<span style='color:red;' class='help-inline'>" + from_error_fromName + "</span>"+
            "</div>"+
          "</div>"+

          "<div class='control-group'>"+
            "<label class='control-label' for='fromEmail'>your email</label>"+
            "<div class='controls'>"+
              "<input class='span8' type='text' name='fromEmail' value='" + set_value_fromEmail + "'>"+
              "<span style='color:red;' class='help-inline'>" + form_error_fromEmail + "</span>"+
            "</div>"+
          "</div>"+

          "<div class='control-group'>"+
            "<label class='control-label' for='message'>your message</label>"+
            "<div class='controls'>"+
              "<textarea rows=3 class='span8' type='text' name='message'>" + set_value_message + "</textarea>"+
              "<span style='color:red;' class='help-inline'>" + form_error_message + "</span>"+
            "</div>"+
          "</div>"+

          "<div class='control-group'>"+
            "<div class='controls'>"+
              "<img src='" + base_url + 'user/captcha' + "' />"+
            "</div>"+
          "</div>"+

          "<div class='control-group'>"+
            "<label class='control-label' for='captcha'>verification code</label>"+
            "<div class='controls'>"+
              "<input class='span8' type='text' name='captcha' placeholder='enter the four characters in the figure above'>"+
              "<span style='color:red;' class='help-inline'>" + form_error_captcha + "</span>"+
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
        $(obj).html('cancel<span class="glyphicon glyphicon-remove" style="font-size:12px;"></span>');
        //$(obj).nextAll("div").children("#content").focus();
    } else {

        $(obj).parent().siblings(".share").remove();
        $(obj).html('share<span class="glyphicon glyphicon-share" style="font-size:12px;"></span>');
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
            type: "POST",
            url: base_url + 'comments/reply_ajax',
            data: { 'content': content, 'pid': pid },
            error: function() {
                alert("error");
            },
            success: function(data) {
                if (data) {
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

// JavaScript under comments/view
function up_on_view(obj){
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/up',
               data: { 'id' : obj.id },
               success: function(data) {
                   if (data == 1) {
                       $("#show-"+obj.id).html(parseInt($("#show-"+obj.id).html())+1);
                       $('i', obj).css('color', 'green');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}
function down_on_view(obj){
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/down',
               data: { 'id' : obj.id },
               success: function(data) {
                   if (data == 1) {
                       $("#show-"+obj.id).html(parseInt($("#show-"+obj.id).html())-1);
                       $('i', obj).css('color', 'red');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}

function rply_up(obj){
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/rply_up',
               data: { 'id' : obj.id },
               error: function(xhr, status, error) {
                   console.log(xhr.responseText);
               },
               success:function(data){
                  if (data == 1) {
                      $("#show-"+obj.id).html(parseInt($("#show-"+obj.id).html())+1);
                      $('i', obj).css('color', 'green');
                  } else {
                      alert(data);
                  }
               }
        });
    }
}
function rply_down(obj){
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/rply_down',
               data: { 'id' : obj.id },
               error: function(xhr, status, error) {
                   console.log(xhr.responseText);
               },
               success:function(data){
                  if (data == 1) {
                      $("#show-"+obj.id).html(parseInt($("#show-"+obj.id).html())-1);
                      $('i', obj).css('color', 'red');
                  } else {
                      alert(data);
                  }
               }
        });
    }
}
$(document).ready(function(){

	$("#hide_link").click(function(){
        $("#link").fadeOut(800);
    });

    $("#submit_reply").click(function(){
        if (is_user_logged_in) {
            var content = $("#content").val();
            var pid = $("#pid").val();

            $.ajax({
                type: "POST",
                url: base_url + 'comments/reply_ajax',
                data: { 'content' : content, 'pid' : pid, 'is_parent_link' : 1 },
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
                                    <a style='color: #369;font-weight: bold;' href='#'>" + link_username + "</a>&nbsp;&nbsp;<span id='show-0'>0</span> points&nbsp;&nbsp;submitted just a moment ago\
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


function set_reply(obj){
    if($(obj).nextAll().is("div")) {
		$(obj).nextAll("div").children("#content").focus();
	} else { //This can not be used directly reply_item['id']
		replyForm = "<div><div style='border-top:solid 8px rgba(255, 255, 255, .3); width:100%;'></div>&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows='4' class='span6' name='content' id='content' onfocus='first_of_all_login()' style='font-weight:normal;color:black;'/></textarea><br />"+
			"<input type='hidden' name='pid' id='pid' value='"+obj.id+"' />"+
            "&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onclick='submit_comment_reply(this)' style='margin-top:10px;'>submit</button>&nbsp;&nbsp;<button type='button' onclick='cancel_reply(this)' style='margin-top:10px;'>cancel</button></div>";
		$(obj).after(replyForm);
		$(obj).nextAll("div").children("#content").focus();
	}
}

function cancel_reply(obj){
    //alert($(obj).parent());
    $(obj).parent().remove(); //Deletes the selected element and its child elements
    $(obj).parent().siblings(".").remove();
}

function submit_comment_reply(obj){
    if (is_user_logged_in) {
        var content = $(obj).siblings("#content").val();
        var pid = $(obj).siblings("#pid").val();
        $.ajax({
                type: "POST",
                url: base_url + 'comments/reply_ajax',
                data: { 'content' : content, 'pid' : pid, 'is_parent_link' : 0 },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
                success:function(data){

                    if (data == 1) {

                        update_reply = "<!--One reply from the reply tree of this post-->\
                        <ul style='list-style-type:none'><li><!--Draw a dividing line-->\
				            <div style='border-top:solid 8px rgba(255, 255, 255, .3); width:100%;'> </div>\
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
                                    <a style='color: #369;font-weight: bold;' href='#'>" + link_username + "</a>&nbsp;&nbsp;<span id='show-0'>0</span> points&nbsp;&nbsp;submitted just a moment ago\
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
        $(obj).siblings(".hide_up").html("<i class='glyphicon glyphicon-arrow-up' style='color:black;'></i>");
        $(obj).parent().parent().parent().parent().nextAll("ul").show('fast');
	}
}

// JavaScript under submit/link
function set_topic(obj) { //Function name can not be topic, with the previous id, class conflict
    $(".topic").val(obj.text)
}
$(document).ready(function(){
    $("#get_title").click(function(){
        var url = $("#url").val();
        //alert(url);

        $.ajax({
            type: "POST",
            url: base_url + 'submit/get_title',
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
});

// JavaScript under user/register
$(document).ready(function(){
    $("#reg_username").keyup(function(){
        var username = $(this).val();
        //alert(username);
        $.ajax({
            type: "POST",
            url: base_url + 'user/is_username_available',
            data: { 'username': username },
            error: function() {
                alert("error");
            },
            success: function(msg) {
                $("#chk_msg").html(msg);
            }
        });
    });
});

// JavaScript under submit/link - tab switching
$(document).ready(function(){
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});

// JavaScript for subscriptions
function subscribe(obj){
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'subscriptions/subscribe',
               data: { 'topic' : obj.id },
               success: function(data) {
                   if (data == 1) {
                       $('a.btn#'+obj.id).text('Unsubscribe');
                       $('a.btn#'+obj.id).attr('class', 'btn btn-small btn-danger');
                       $('a.btn#'+obj.id).attr('onclick', 'unsubscribe(this);');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}
function unsubscribe(obj){
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'subscriptions/unsubscribe',
               data: { 'topic' : obj.id },
               success: function(data) {
                   if (data == 1) {
                       $('a.btn#'+obj.id).text('Subscribe');
                       $('a.btn#'+obj.id).attr('class', 'btn btn-small btn-success');
                       $('a.btn#'+obj.id).attr('onclick', 'subscribe(this);');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}

// REPORT
function report_topic(topic_name) {
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'subscriptions/report_topic',
               data: { 'name' : topic_name },
               success: function(data) {
                   if (data == 1) {
                       alert('Topic ' + topic_name + ' reported.')
                   } else {
                       alert(data);
                   }
               }
        });
    }
}
function report_link(link_id) {
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/report_link',
               data: { 'id' : link_id },
               success: function(data) {
                   if (data[0] == '1') {
                       alert('Post with title "' + data.substring(2) + '" reported.')
                   } else {
                       alert(data);
                   }
               }
        });
    }
}
function report_reply(reply_id) {
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/report_reply',
               data: { 'id' : reply_id },
               success: function(data) {
                   if (data[0] == '1') {
                       alert('Comment of user "' + data.substring(2) + '" reported.')
                   } else {
                       alert(data);
                   }
               }
        });
    }
}
