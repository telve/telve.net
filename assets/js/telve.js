// Header - logo
$('#turkish-coffee').click(function() {
	window.location = 'https://tr.wikipedia.org/wiki/T%C3%BCrk_kahvesi';
});

$('#site-logo').click(function() {
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
$(document).ready(function() {
	var rightContentWidth = $('#right-content').width()
	$('.close-sidebar').click(function() {
		$('.close-sidebar').hide();
		$('.show-sidebar').show();
		$('#right-content').animate({
			width: $(window).width() - 400
		}, 'fast').prev().hide('fast');
	});

	$('.show-sidebar').click(function() {
		$('.show-sidebar').hide();
		$('.close-sidebar').show();
		$('#right-content').animate({
			width: $(window).width() * 92 / 100 - 400
		}, 'fast').prev().show('fast');
	});
});

// JavaScript under link/index
function up(id) {
	if (is_user_logged_in) {
		$.ajax({
			type: "POST",
			url: base_url + 'comments/up',
			data: {
				'id': id
			},
			success: function(data) {
				if (data == 1) {
					$("#link-score-" + id).html(parseInt($("#link-score-" + id).html()) + 1);
					var parent = $('#up-' + id)[0];
					$('i', parent).css('color', 'green');
				} else {
					alertify.warning(data);
				}
			}
		});
	}
}

function down(id) {
	if (is_user_logged_in) {
		$.ajax({
			type: "POST",
			url: base_url + 'comments/down',
			data: {
				'id': id
			},
			success: function(data) {
				if (data == 1) {
					$("#link-score-" + id).html(parseInt($("#link-score-" + id).html()) - 1);
					var parent = $('#down-' + id)[0];
					$('i', parent).css('color', 'red');
				} else {
					alertify.warning(data);
				}
			}
		});
	}
}

function share_link(obj) {
	if ($(obj).text() == 'paylaş') {
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
		$(obj).parent().siblings().fadeIn("slow", "swing");
		$(obj).html('iptal<span class="glyphicon glyphicon-remove" style="font-size:12px;"></span>');
	} else {
		$(obj).parent().siblings().fadeOut("slow", "swing").promise().done(function() {
			$(obj).parent().siblings().remove();
		});
		$(obj).html('paylaş<span class="glyphicon glyphicon-share" style="font-size:12px;"></span>');
	}
}

function share_topic(obj) {
	if ($(obj).text() == 'paylaş') {
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
		$(obj).parent().siblings().fadeIn("slow", "swing");
		$(obj).html('iptal<span class="glyphicon glyphicon-remove" style="font-size:12px;"></span>');
	} else {
		$(obj).parent().siblings().fadeOut("slow", "swing").promise().done(function() {
			$(obj).parent().siblings().remove();
		});
		$(obj).html('paylaş<span class="glyphicon glyphicon-share" style="font-size:12px;"></span>');
	}
}
$(document).ready(function() {
	$("#reg_username").change(function() {
		//alert('ok');
	});
});

// JavaScript under comments/view
function up_on_view(obj) {
	if (is_user_logged_in) {
		$.ajax({
			type: "POST",
			url: base_url + 'comments/up',
			data: {
				'id': obj.id
			},
			success: function(data) {
				if (data == 1) {
					$("#link-score-" + obj.id).html(parseInt($("#link-score-" + obj.id).html()) + 1);
					$('i', obj).css('color', 'green');
				} else {
					alertify.warning(data);
				}
			}
		});
	}
}

function down_on_view(obj) {
	if (is_user_logged_in) {
		$.ajax({
			type: "POST",
			url: base_url + 'comments/down',
			data: {
				'id': obj.id
			},
			success: function(data) {
				if (data == 1) {
					$("#link-score-" + obj.id).html(parseInt($("#link-score-" + obj.id).html()) - 1);
					$('i', obj).css('color', 'red');
				} else {
					alertify.warning(data);
				}
			}
		});
	}
}

function rply_up(obj) {
	if (is_user_logged_in) {
		$.ajax({
			type: "POST",
			url: base_url + 'comments/rply_up',
			data: {
				'id': obj.id
			},
			error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
			success: function(data) {
				if (data == 1) {
					$("#reply-score-" + obj.id).html(parseInt($("#reply-score-" + obj.id).html()) + 1);
					$('i', obj).css('color', 'green');
				} else {
					alertify.warning(data);
				}
			}
		});
	}
}

function rply_down(obj) {
	if (is_user_logged_in) {
		$.ajax({
			type: "POST",
			url: base_url + 'comments/rply_down',
			data: {
				'id': obj.id
			},
			error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
			success: function(data) {
				if (data == 1) {
					$("#reply-score-" + obj.id).html(parseInt($("#reply-score-" + obj.id).html()) - 1);
					$('i', obj).css('color', 'red');
				} else {
					alertify.warning(data);
				}
			}
		});
	}
}
$(document).ready(function() {

	$("#hide_link").click(function() {
		$(".link").fadeOut(800);
	});

});

function submit_comment(obj) {
	if (is_user_logged_in) {
		var content = $("#content").val();
		var pid = $("#pid").val();

		$.ajax({
			type: "POST",
			url: base_url + 'comments/reply_ajax',
			data: {
				'content': content,
				'pid': pid,
				'is_parent_link': 1,
				'link_id': $('.digg > div > a')[0].id
			},
			error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
			success: function(data) {
				if (data) {
					data = JSON.parse(data);
					if (data['status'] == '1') {
						var md = window.markdownit(); // get a markdown instance
						$("#content").val('');
						comment = "<li><!--One reply from the reply tree of this post-->\
        										<div id='yorum-" + data['id'] + "' class='row-fluid reply-wrapper'>\
        											<div class='8'>\
        \
        												<div class='reply-header'>\
        													<a class='reply-up login-required' title='evet' href='javascript:void(0)' id='" + data['id'] + "' onclick='rply_up(this)'><i class='glyphicon glyphicon-arrow-up' style='color:black;'></i></a>\
        													<a class='color-gray' title='küçült' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>\
        													<a class='reply-user-link' href='" + base_url + "kullanici/" + username + "/" + "'>" + username + "</a>&nbsp;&nbsp;<span id='reply-score-" + data['id'] + "'>0</span> puan&nbsp;&nbsp;az önce gönderildi\
                                  &nbsp;<span class='color-gray'>(<a class='color-gray' title='yanıt sayısı'> 0 <span class='glyphicon glyphicon-comment' style='font-size:10px;'></span> </a>)</small></span>\
        												</div>\
        \
        												<a class='reply-down login-required' title='hayır' href='javascript:void(0)' id='" + data['id'] + "' onclick='rply_down(this)'><i class='glyphicon glyphicon-arrow-down' style='color:black;'></i></a>\
        												<div class='reply-content'>\
                                	<span>" + telveflavor(md.render(content)) + "</span>\
        												</div>\
				\
																<div class='reply-functions hide_function'>\
		              								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a class='color-gray' id='" + data['id'] + "' href='javascript:void(0)' onclick='favourite_reply(this)' class='login-required'>favori<span class='glyphicon glyphicon-star-empty'></span></a>\
		              								&nbsp;&nbsp;&nbsp;&nbsp;<a class='color-gray' href='javascript:void(0)' onclick='report_reply(\"" + data['id'] + "\")' class='login-required'>şikayet<span class='glyphicon glyphicon-flag'></span></a>\
		              								&nbsp;&nbsp;&nbsp;&nbsp;</small><a class='color-gray' href='javascript:void(0)' onclick='set_reply(this)' id='" + data['id'] + "'><small>yanıt<span class='glyphicon glyphicon-share-alt special-reply-icon'></span></small></a>\
		                              &nbsp;&nbsp;&nbsp;&nbsp;</small><a class='color-gray' href='javascript:void(0)' onclick='share_reply(this)' id='" + data['id'] + "'><small>paylaş<span class='glyphicon glyphicon-share'></span></small></a>\
			              						</div>\
				\
						        					</div>\
						        				</div>\
						        				<!--One reply from the reply tree of this post--></li>";
						$(obj).nextAll('ul').prepend(comment);
						$('.live-preview2').empty();
						alertify.success('Yorumunuz başarıyla gönderildi.');
					} else {
						alertify.error(data['msg']);
					}
				} else {
					alertify.error("Dinamik bağlantı hatası.");
				}
			}
		});
	}
};


function set_reply(obj) {
	if ($(obj).nextAll().is("ul")) {
		$(obj).nextAll("ul").children("div").children("#content").focus();
	} else { //This can not be used directly reply_item['id']
		replyForm = "<ul style='list-style-type:none; margin-left:14px; padding-left:.8em; border-left:solid 1px rgba(0, 0, 0, .2);'>\
									<div style='border-top:solid 8px rgba(255, 255, 255, .3); width:100%;'></div>&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows='4' class='span6 reply-textarea' name='content' id='content' onfocus='first_of_all_login()' style='font-weight:normal;color:black;' placeholder='yanıtınız... Markdown formatında' /></textarea><div class='live-preview3'></div><br />\
									<input type='hidden' name='pid' id='pid' value='" + obj.id + "' />\
									<div style='width:51%;'><a class='link-to-guide pull-right' style='font-weight:normal;' href='" + base_url + "sayfalar/markdown_rehberi'>Markdown rehberi</a></div>\
									&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onclick='submit_comment_reply(this)' style='margin-top:10px;'>gönder</button>&nbsp;&nbsp;<button type='button' onclick='cancel_reply(this)' style='margin-top:10px;'>iptal</button>\
								</ul>";
		$(obj).nextAll().after(replyForm);
		$(obj).nextAll("ul").children("div").children("#content").focus();

		$(document).ready(function() {
			var md = window.markdownit(); // get a markdown instance
			$('textarea.reply-textarea').keyup(function() {
				var html = telveflavor(md.render($(this).val())); // parse the markdown into html
				$('.live-preview3').html(html);
			});
		});
	}
}

function cancel_reply(obj) {
	//alert($(obj).parent());
	$(obj).parent().remove(); //Deletes the selected element and its child elements
	//$(obj).parent().siblings(".").remove();
}

function submit_comment_reply(obj) {
	if (is_user_logged_in) {
		var content = $(obj).siblings("#content").val();
		var pid = $(obj).siblings("#pid").val();
		$.ajax({
			type: "POST",
			url: base_url + 'comments/reply_ajax',
			data: {
				'content': content,
				'pid': pid,
				'is_parent_link': 0,
				'link_id': $('.digg > div > a')[0].id
			},
			error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
			success: function(data) {
				if (data) {
					data = JSON.parse(data);
					if (data['status'] == '1') {
						var md = window.markdownit(); // get a markdown instance
						update_reply = "<li><!--One reply from the reply tree of this post-->\
														<div id='yorum-" + data['id'] + "' class='row-fluid reply-wrapper'>\
															<div class='8'>\
				\
																<div class='reply-header'>\
																	<a class='reply-up login-required' title='evet' href='javascript:void(0)' id='" + data['id'] + "' onclick='rply_up(this)'><i class='glyphicon glyphicon-arrow-up' style='color:black;'></i></a>\
																	<a class='color-gray' title='küçült' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>\
																	<a class='reply-user-link' href='" + base_url + "kullanici/" + username + "/" + "'>" + username + "</a>&nbsp;&nbsp;<span id='reply-score-" + data['id'] + "'>0</span> puan&nbsp;&nbsp;az önce gönderildi\
																	&nbsp;<span class='color-gray'>(<a class='color-gray' title='yanıt sayısı'> 0 <span class='glyphicon glyphicon-comment' style='font-size:10px;'></span> </a>)</small></span>\
																</div>\
				\
																<a class='reply-down login-required' title='hayır' href='javascript:void(0)' id='" + data['id'] + "' onclick='rply_down(this)'><i class='glyphicon glyphicon-arrow-down' style='color:black;'></i></a>\
																<div class='reply-content'>\
																	<span>" + telveflavor(md.render(content)) + "</span>\
																</div>\
				\
																<div class='reply-functions hide_function'>\
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a class='color-gray' id='" + data['id'] + "' href='javascript:void(0)' onclick='favourite_reply(this)' class='login-required'>favori<span class='glyphicon glyphicon-star-empty'></span></a>\
																	&nbsp;&nbsp;&nbsp;&nbsp;<a class='color-gray' href='javascript:void(0)' onclick='report_reply(\"" + data['id'] + "\")' class='login-required'>şikayet<span class='glyphicon glyphicon-flag'></span></a>\
																	&nbsp;&nbsp;&nbsp;&nbsp;</small><a class='color-gray' href='javascript:void(0)' onclick='set_reply(this)' id='" + data['id'] + "'><small>yanıt<span class='glyphicon glyphicon-share-alt special-reply-icon'></span></small></a>\
																	&nbsp;&nbsp;&nbsp;&nbsp;</small><a class='color-gray' href='javascript:void(0)' onclick='share_reply(this)' id='" + data['id'] + "'><small>paylaş<span class='glyphicon glyphicon-share'></span></small></a>\
																</div>\
				\
															</div>\
														</div>\
														<!--One reply from the reply tree of this post--></li>";
						if (!$(obj).parent().parent().parent().parent().next().is('ul')) {
							$(obj).parent().parent().parent().parent().after("<ul style='list-style-type:none; margin-left:14px; padding-left:.8em; border-left:solid 1px rgba(0, 0, 0, .2);'></ul>")
						}
						$(obj).parent().parent().parent().parent().nextAll('ul').prepend(update_reply);
						$(obj).parent().remove();
						alertify.success('Yanıtınız başarıyla gönderildi.');
					} else {
						alertify.error(data['msg']);
					}
				} else {
					alertify.error("Dinamik bağlantı hatası.");
				}
			}
		});
	} else {
		$('#myModal').modal('toggle');
		return false; //cancel the event
	}
}

function share_reply(obj) {
	var parser = document.createElement('a');
	parser.href = window.location.href;
	var reply_url = parser.protocol + '//' + parser.hostname + parser.pathname + '?nolimit=1#yorum-' + obj.id;
	//window.prompt("Aşağıdaki bağlantıyı kopyalayıp istediğiniz yerde paylaşabilirsiniz:", reply_url);
	//window.location.href = reply_url;
	alertify.prompt("Yorumu paylaş", "Aşağıdaki bağlantı otomatik olarak panoya kopyalanacaktır:", reply_url,
	  function(evt, value ){
	    alertify.success('Yorumun bağlantısı panoya başarıyla kopyalandı');
	  },
	  function(){
	    alertify.warning('Yorumun bağlantısı panoya kopyalanamamış olabilir');
	  }
	);
	setTimeout(function(){
		document.execCommand('copy');
	}, 500);
	setTimeout(function(){
		document.execCommand('copy');
	}, 1000);
	setTimeout(function(){
		document.execCommand('copy');
	}, 1500);
	setTimeout(function(){
		document.execCommand('copy');
	}, 2000);
}

function switch_state(obj) {
	if ($(obj).text() == "[–]") {
		$(obj).text("[+]");
		$(obj).parent().parent().find('.reply-up').hide('slow');
		$(obj).parent().parent().find('.reply-down').hide('slow');
		$(obj).parent().parent().find('.reply-content').hide('slow');
		$(obj).parent().parent().find('.reply-functions').hide('slow');
		$(obj).parent().parent().parent().nextAll('ul').hide('slow');
	} else {
		$(obj).text("[–]");
		$(obj).parent().parent().find('.reply-up').show('slow');
		$(obj).parent().parent().find('.reply-down').show('slow');
		$(obj).parent().parent().find('.reply-content').show('slow');
		$(obj).parent().parent().find('.reply-functions').show('slow');
		$(obj).parent().parent().parent().nextAll('ul').show('slow');
	}
}

// JavaScript under submit/link
function set_topic(obj) { //Function name can not be topic, with the previous id, class conflict
	$(".topic").val(obj.text)
}
$(document).ready(function() {
	$("#get_title").click(function() {
		var url = $("#url").val();
		//alert(url);

		$.ajax({
			type: "POST",
			url: base_url + 'submit/get_title',
			data: {
				'url': url
			},
			error: function(xhr, status, error) {
				alertify.error('HATA OLUŞTU: ' + xhr.responseText);
			},
			success: function(data) {
				//alert(data);
				$("#title").val(data);
			}
		});
	});
});

// JavaScript under user/register
$(document).ready(function() {
	$("#reg_username").keyup(function() {
		var username = $(this).val();
		//alert(username);
		$.ajax({
			type: "POST",
			url: base_url + 'user/is_username_available',
			data: {
				'username': username
			},
			error: function(xhr, status, error) {
				alertify.error('HATA OLUŞTU: ' + xhr.responseText);
			},
			success: function(msg) {
				$("#chk_msg").html(msg);
			}
		});
	});
});

// JavaScript under submit/link - tab switching
$(document).ready(function() {
	$('#myTab a').click(function(e) {
		e.preventDefault();
		$(this).tab('show');
	});
});

// JavaScript for subscriptions
function subscribe(obj) {
	if (is_user_logged_in) {
		$.ajax({
			type: "POST",
			url: base_url + 'subscriptions/subscribe',
			data: {
				'topic': obj.id
			},
			success: function(data) {
				if (data == 1) {
					$('a.btn#' + obj.id).text('Abonelikten çık');
					$('a.btn#' + obj.id).attr('class', 'btn btn-small btn-danger');
					$('a.btn#' + obj.id).attr('onclick', 'unsubscribe(this);');
				} else {
					alertify.warning(data);
				}
			}
		});
	}
}

function unsubscribe(obj) {
	if (is_user_logged_in) {
		$.ajax({
			type: "POST",
			url: base_url + 'subscriptions/unsubscribe',
			data: {
				'topic': obj.id
			},
			success: function(data) {
				if (data == 1) {
					$('a.btn#' + obj.id).text('Abone ol');
					$('a.btn#' + obj.id).attr('class', 'btn btn-small btn-success');
					$('a.btn#' + obj.id).attr('onclick', 'subscribe(this);');
				} else {
					alertify.warning(data);
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
			data: {
				'name': topic_name
			},
			success: function(data) {
				if (data == 1) {
					alertify.warning(topic_name + ' konusuyla ilgili şikayetiniz alındı.')
				} else {
					alertify.warning(data);
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
			data: {
				'id': link_id
			},
			success: function(data) {
				if (data[0] == '1') {
					alertify.warning('"' + data.substring(2) + '" başlıklı paylaşımla ilgili şikayetiniz alındı.')
				} else {
					alertify.warning(data);
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
			data: {
				'id': reply_id
			},
			success: function(data) {
				if (data[0] == '1') {
					alertify.warning('"' + data.substring(2) + '" isimli kullanıcının yorumu/yanıtı ile ilgili şikayetiniz alındı.')
				} else {
					alertify.warning(data);
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
			data: {
				'id': obj.id
			},
			success: function(data) {
				if (data == 1) {
					$(obj).html('favori<span class="glyphicon glyphicon-star" style="font-size:13px;"></span>');
					$(obj).attr('onclick', 'unfavourite_link(this);');
				} else {
					alertify.warning(data);
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
			data: {
				'id': obj.id
			},
			success: function(data) {
				if (data == 1) {
					$(obj).html('favori<span class="glyphicon glyphicon-star-empty" style="font-size:13px;"></span>');
					$(obj).attr('onclick', 'favourite_link(this);');
				} else {
					alertify.warning(data);
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
			data: {
				'id': obj.id
			},
			success: function(data) {
				if (data == 1) {
					$(obj).html('favori<span class="glyphicon glyphicon-star"></span>');
					$(obj).attr('onclick', 'unfavourite_reply(this);');
				} else {
					alertify.warning(data);
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
			data: {
				'id': obj.id
			},
			success: function(data) {
				if (data == 1) {
					$(obj).html('favori<span class="glyphicon glyphicon-star-empty"></span>');
					$(obj).attr('onclick', 'favourite_reply(this);');
				} else {
					alertify.warning(data);
				}
			}
		});
	}
}

// Function for testing analyze_url function
function analyze_url_test(url) {
	$.ajax({
		type: "POST",
		url: base_url + 'submit/analyze_url_test',
		data: {
			'url': url
		},
		success: function(data) {
			console.log(data);
		}
	});
}

$('form').submit(function() {
	$(this).find(':submit').attr('disabled', 'disabled');
});

$(document).ready(function() {
	var md = window.markdownit(); // get a markdown instance
	$('textarea#text').keyup(function() {
		var html = telveflavor(md.render($(this).val())); // parse the markdown into html
		$('.live-preview').html(html);
	});
});

$(document).ready(function() {
	var md = window.markdownit(); // get a markdown instance
	$('textarea#content').keyup(function() {
		var html = telveflavor(md.render($(this).val())); // parse the markdown into html
		$('.live-preview2').html(html);
	});
});

$(document).ready(function() {
	$('.video-wrapper').click(function() {
		if ($(this).children("video").get(0).paused) {
			$(this).children("video").get(0).play();
			$(this).children(".playpause").fadeOut("fast");
		} else {
			$(this).children("video").get(0).pause();
			$(this).children(".playpause").fadeIn("fast");
		}
	});
});

// Notifications
var notification_rows = 10;
var notification_offset = 0;

function notification_loader(notifications, data) {
	var objective = "";
	var objective_link = "";
	var verb = "";
	for (var i = 0; i < data.length; i++) {
		switch (data[i]['item_type']) {
			case "0":
				objective = "şu gönderinize";
				objective_link = base_url + "t/-/yorumlar/" + data[i]['link_id_0'] + "/";
				switch (data[i]['action_type']) {
					case "0":
						verb = " evet oyu verdi.";
						break;
					case "1":
						verb = " hayır oyu verdi.";
						break;
					case "2":
						objective = "şu gönderinizi";
						verb = " favorilerine ekledi.";
						break;
					case "3":
						verb = " yorum yaptı.";
						break;
				}
				break;
			case "1":
				objective = "şu yorumunuza";
				objective_link = base_url + "t/-/yorumlar/" + data[i]['link_id_1'] + "/?nolimit=1#yorum-" + data[i]['reply_id'];
				switch (data[i]['action_type']) {
					case "0":
						verb = " evet oyu verdi.";
						break;
					case "1":
						verb = " hayır oyu verdi.";
						break;
					case "2":
						objective = "şu yorumunuzu";
						verb = " favorilerine ekledi.";
						break;
					case "3":
						verb = " yanıt yazdı.";
						break;
				}
				break;
		}

		var notification = " \
		<li> \
			<div class='notification'> \
				<a href='" + base_url + "kullanici/" + data[i]['username'] + "/" + "'>" + data[i]['username'] + "</a> kullanıcısı <a href='" + objective_link + "'>" + objective + "</a>" + verb + " \
				<hr> \
				<p class='time'>" + data[i]['created'] + "</p> \
			</div> \
		</li> \
		";
		$(notifications).find('ul .drop-content').append(notification);
		$(notifications).find('ul .drop-content li:last-child').hide();
		$(notifications).find('ul .drop-content li:last-child').delay(i*200).fadeIn("slow");
	}
}

$(document).ready(function() {
	$('#notifications').click(function() {
		if(!$(this).hasClass('open')) {
			$(this).find('ul').css('visibility',"visible");
			$(this).find('ul .drop-content').empty();
			var notifications = this;
			$.ajax({
				type: "GET",
				url: base_url + 'comments/notifications?rows=' + notification_rows + '&offset=' + notification_offset,
				data: {},
				success: function(data) {
					if (data) {
						data = JSON.parse(data);
						if (data.length == 0) {
							var no_notification = " \
							<li> \
								<div class='notification'> \
									Henüz bir bildirim yok \
								</div> \
							</li> \
							";
							$(notifications).find('ul .drop-content').append(no_notification);
						}
						notification_loader(notifications, data);
						notification_offset = 10;
						$('b.notification-count').text('0');
					} else {
						alertify.error("Dinamik bağlantı hatası.");
					}
				}
			});
		}
	});
});

(function poll() {
   setTimeout(function() {
       $.ajax({ url: base_url + 'comments/get_unread_notification_count', success: function(data) {
           $('b.notification-count').text(data);
       }, dataType: "json", complete: poll });
    }, 5000);
})();

var scroll_threshold = 450;
$(document).ready(function() {
	$('div.drop-content').scroll(function() {
		if($('div.drop-content').scrollTop() > scroll_threshold) {
			scroll_threshold += 450;
			var notifications = $('#notifications');
			$.ajax({
				type: "GET",
				url: base_url + 'comments/notifications?rows=' + notification_rows + '&offset=' + notification_offset,
				data: {},
				success: function(data) {
					if (data) {
						data = JSON.parse(data);
						notification_loader(notifications, data);
						notification_offset += 10;
						$('b.notification-count').text('0');
					} else {
						alertify.error("Dinamik bağlantı hatası.");
					}
				}
			});
   	}
	});
});

$('body').on('click', function (e) {
	notification_offset = 0;
	if (!$('#notifications *').is(e.target)) {
		$('#notifications ul').css('visibility',"hidden");
	}
});

// Highlight the reply
$(document).ready(function() {
	var parser = document.createElement('a');
	parser.href = window.location.href;
	if (parser.hash.startsWith('#yorum-')) {
		$(parser.hash + ' > div.span8').css('background-color', '#fafad2');
		$(parser.hash + ' > div.span8').animate({
			backgroundColor: "#fff"
		}, 2000 );
	}
});

// Recent links
$(document).ready(function() {
	$("a.link-title, div.link-actions > strong > a:first-child").click(function() {
		var recent_links = Cookies.get('recent_links');
		var recent_titles = Cookies.get('recent_titles');
		var recent_links_str = "";
		var recent_titles_str = "";
		if (recent_links) {
			recent_links = recent_links.split('`');
			recent_titles = recent_titles.split('`');

			var index = recent_links.indexOf(this.href);
			if (index > -1) {
				recent_links.splice(index, 1);
				recent_titles.splice(index, 1);
			}

			recent_links.unshift(this.href);
			if ($(this).hasClass('link-title')) {
				recent_titles.unshift(this.text);
			} else {
				recent_titles.unshift($(this).parent().parent().parent().parent().find('a.link-title')[0].text);
			}
			recent_links_str = recent_links[0];
			recent_titles_str = recent_titles[0];
			for (i = 1; i < 8; i++) {
				if (recent_links[i]) {
					recent_links_str += '`' + recent_links[i];
					recent_titles_str += '`' + recent_titles[i];
				}
			}
			Cookies.set('recent_links', recent_links_str);
			Cookies.set('recent_titles', recent_titles_str);
		} else {
			Cookies.set('recent_links', this.href);
			if ($(this).hasClass('link-title')) {
				Cookies.set('recent_titles', this.text);
			} else {
				Cookies.set('recent_titles', $(this).parent().parent().parent().parent().find('a.link-title')[0].text);
			}
		}
	});
});

$(document).ready(function() {
	var recent_links = Cookies.get('recent_links');
	var recent_titles = Cookies.get('recent_titles');
	if (recent_links) {
		$('#recent-links').css('padding', '5px 5px 5px 5px');
		recent_links = recent_links.split('`');
		recent_titles = recent_titles.split('`');
		for (i = 0; i < recent_links.length; i++) {
			$('#recent-links').append('<div><a href="' + recent_links[i] + '"><span>&#9830;</span> ' + recent_titles[i] + '</a></div>');
		}
	}
});
