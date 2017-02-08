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
                       $("#link-score-"+id).html(parseInt($("#link-score-"+id).html())+1);
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
                       $("#link-score-"+id).html(parseInt($("#link-score-"+id).html())-1);
                       var parent = $('#down-'+id)[0];
                       $('i', parent).css('color', 'red');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}

function share_link(obj){
    if($(obj).text()=='paylaş')
    {
        replyForm = '<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="display:none;">\
                    <a class="a2a_dd" href="https://www.addtoany.com/share?linkurl=' + decodeURIComponent($(obj).parent().parent().find('.short-link')[0].href) + '&amp;linkname=' + $(obj).parent().parent().parent().parent().find('.link-title')[0].innerText + '"></a>\
                    <a class="a2a_button_facebook"></a>\
                    <a class="a2a_button_twitter"></a>\
                    <a class="a2a_button_google_plus"></a>\
                    <a class="a2a_button_google_gmail"></a>\
                    <a class="a2a_button_whatsapp"></a>\
                    <a class="a2a_button_facebook_messenger"></a>\
                    </div>\
                    <script>\
                    var a2a_config = a2a_config || {};\
                    a2a_config.locale = "tr";\
                    a2a_config.linkname = "' + $(obj).parent().parent().parent().parent().find('.link-title')[0].innerText + '";\
                    a2a_config.linkurl = "' + decodeURIComponent($(obj).parent().parent().find('.short-link')[0].href) + '";\
                    </script>\
                    <script async src="https://static.addtoany.com/menu/page.js"></script>';

        $(obj).parent().after(replyForm);
        $(obj).parent().siblings().fadeIn("slow","swing");
        $(obj).html('iptal<span class="glyphicon glyphicon-remove" style="font-size:12px;"></span>');
    } else {
        $(obj).parent().siblings().fadeOut("slow","swing").promise().done( function() {
            $(obj).parent().siblings().remove();
        });
        $(obj).html('paylaş<span class="glyphicon glyphicon-share" style="font-size:12px;"></span>');
    }
}
function share_topic(obj){
    if($(obj).text()=='paylaş')
    {
        replyForm = '<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="display:none;">\
                    <a class="a2a_dd" href="https://www.addtoany.com/share?linkurl=' + $(obj).parent().parent().parent().parent().find('a.link-title')[0].href + '&amp;linkname=' + $(obj).parent().parent().parent().parent().find('.link-title')[0].innerText + '"></a>\
                    <a class="a2a_button_facebook"></a>\
                    <a class="a2a_button_twitter"></a>\
                    <a class="a2a_button_google_plus"></a>\
                    <a class="a2a_button_google_gmail"></a>\
                    <a class="a2a_button_whatsapp"></a>\
                    <a class="a2a_button_facebook_messenger"></a>\
                    </div>\
                    <script>\
                    var a2a_config = a2a_config || {};\
                    a2a_config.locale = "tr";\
                    a2a_config.linkname = "' + $(obj).parent().parent().parent().parent().find('.link-title')[0].innerText + '";\
                    a2a_config.linkurl = "' + $(obj).parent().parent().parent().parent().find('a.link-title')[0].href + '";\
                    </script>\
                    <script async src="https://static.addtoany.com/menu/page.js"></script>';

        $(obj).parent().after(replyForm);
        $(obj).parent().siblings().fadeIn("slow","swing");
        $(obj).html('iptal<span class="glyphicon glyphicon-remove" style="font-size:12px;"></span>');
    } else {
        $(obj).parent().siblings().fadeOut("slow","swing").promise().done( function() {
            $(obj).parent().siblings().remove();
        });
        $(obj).html('paylaş<span class="glyphicon glyphicon-share" style="font-size:12px;"></span>');
    }
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
                       $("#link-score-"+obj.id).html(parseInt($("#link-score-"+obj.id).html())+1);
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
                       $("#link-score-"+obj.id).html(parseInt($("#link-score-"+obj.id).html())-1);
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
                      $("#reply-score-"+obj.id).html(parseInt($("#reply-score-"+obj.id).html())+1);
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
                      $("#reply-score-"+obj.id).html(parseInt($("#reply-score-"+obj.id).html())-1);
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
        $(".link").fadeOut(800);
    });

    $("#submit_reply").click(function(){
        if (is_user_logged_in) {
            var content = $("#content").val();
            var pid = $("#pid").val();

            $.ajax({
                type: "POST",
                url: base_url + 'comments/reply_ajax',
                data: { 'content' : content, 'pid' : pid, 'is_parent_link' : 1, 'link_id' : $('.digg > div > a')[0].id },
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
        							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='color: gray;' title='küçült' id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>\
        \
                                    <a style='color: #369;font-weight: bold;' href='" + base_url + "kullanici/" + username + "/" + "'>" + username + "</a>&nbsp;&nbsp;<span id='reply-score-0'>0</span> puan&nbsp;&nbsp;az önce gönderildi\
                                    &nbsp;<span style='color: gray;'>\
        								(<a style='color: gray;' class='hide_rply' href=''> senin yorumun </a>)</small></span>\
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
		replyForm = "<div><div style='border-top:solid 8px rgba(255, 255, 255, .3); width:100%;'></div>&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows='4' class='span6' name='content' id='content' onfocus='first_of_all_login()' style='font-weight:normal;color:black;' placeholder='yanıtınız... Markdown formatında' /></textarea><br />"+
			"<input type='hidden' name='pid' id='pid' value='"+obj.id+"' />"+
            '<div style="width:51%;"><a class="link-to-guide pull-right" style="font-weight:normal;" href="https://vakademi.com.tr/home/category/yazilim/markdown-kullanim-rehberi/hosgeldiniz/">Markdown rehberi</a></div>'+
            "&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onclick='submit_comment_reply(this)' style='margin-top:10px;'>gönder</button>&nbsp;&nbsp;<button type='button' onclick='cancel_reply(this)' style='margin-top:10px;'>iptal</button></div>";
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
                data: { 'content' : content, 'pid' : pid, 'is_parent_link' : 0, 'link_id' : $('.digg > div > a')[0].id },
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
        							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='color: gray;' title='küçült' id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>\
        \
                                    <a style='color: #369;font-weight: bold;' href='" + base_url + "kullanici/" + username + "/" + "'>" + username + "</a>&nbsp;&nbsp;<span id='reply-score-0'>0</span> puan&nbsp;&nbsp;az önce gönderildi\
                                    &nbsp;<span style='color: gray;'>\
        								(<a style='color: gray;' class='hide_rply' href=''> senin yanıtın </a>)</small></span>\
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
            error: function(xhr, status, error) {
                alert('HATA OLUŞTU: ' + xhr.responseText);
            },
            success: function(data){
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
            error: function(xhr, status, error) {
                alert('HATA OLUŞTU: ' + xhr.responseText);
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
                       $('a.btn#'+obj.id).text('Abonelikten çık');
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
                       $('a.btn#'+obj.id).text('Abone ol');
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
                       alert(topic_name + ' konusuyla ilgili şikayetiniz alındı.')
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
                       alert('"' + data.substring(2) + '" başlıklı paylaşımla ilgili şikayetiniz alındı.')
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
                       alert('"' + data.substring(2) + '" isimli kullanıcının yorumu/yanıtı ile ilgili şikayetiniz alındı.')
                   } else {
                       alert(data);
                   }
               }
        });
    }
}

// FAVOURITE
function favourite_link(obj) {
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/favourite_link',
               data: { 'id' : obj.id },
               success: function(data) {
                   if (data == 1) {
                       $(obj).html('favori<span class="glyphicon glyphicon-star" style="font-size:13px;"></span>');
                       $(obj).attr('onclick', 'unfavourite_link(this);');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}
function unfavourite_link(obj) {
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/unfavourite_link',
               data: { 'id' : obj.id },
               success: function(data) {
                   if (data == 1) {
                       $(obj).html('favori<span class="glyphicon glyphicon-star-empty" style="font-size:13px;"></span>');
                       $(obj).attr('onclick', 'favourite_link(this);');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}
function favourite_reply(obj) {
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/favourite_reply',
               data: { 'id' : obj.id },
               success: function(data) {
                   if (data == 1) {
                       $(obj).html('favori<span class="glyphicon glyphicon-star"></span>');
                       $(obj).attr('onclick', 'unfavourite_reply(this);');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}
function unfavourite_reply(obj) {
    if (is_user_logged_in) {
        $.ajax({
               type: "POST",
               url: base_url + 'comments/unfavourite_reply',
               data: { 'id' : obj.id },
               success: function(data) {
                   if (data == 1) {
                       $(obj).html('favori<span class="glyphicon glyphicon-star-empty"></span>');
                       $(obj).attr('onclick', 'favourite_reply(this);');
                   } else {
                       alert(data);
                   }
               }
        });
    }
}

// Function for testing analyze_url function
function analyze_url_test(url){
    $.ajax({
           type: "POST",
           url: base_url + 'submit/analyze_url_test',
           data: {'url' : url },
           success: function(data) {
               console.log(data);
           }
    });
}

$('form').submit(function(){
    $(this).find(':submit').attr('disabled','disabled');
});
