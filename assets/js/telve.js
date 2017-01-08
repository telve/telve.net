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
