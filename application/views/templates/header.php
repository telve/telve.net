<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php //echo $title;?>telve: the front page of the internet</title>
        <meta name="description" content="User-generated news links. Votes promote stories to the front page." />
        <meta name="keywords" content="telve, social, news, links" />
        <link rel="shortcut icon" href="<?php echo base_url("favicon.ico");?>" type="image/x-icon" >
        <link rel="icon" href="<?php echo base_url("favicon.ico");?>" type="image/x-icon" >
        <link href="<?php echo base_url("assets/css/bootstrap.css");?>" rel="stylesheet" media="screen">
        <link href="<?php echo base_url("assets/glyphicons/css/bootstrap.css");?>" rel="stylesheet" media="screen">
        <link href="<?php echo base_url("assets/css/style.css");?>" rel="stylesheet" type="text/css">
    	<style type="text/css">
    		/*
            body{
    			padding-top:30px;
    			padding-bottom:40px;
    		}
            */
    	</style>
        <script type="text/javascript">
            var base_url = "<?php echo base_url('');?>";
            var is_user_logged_in = "<?php echo $is_user_logged_in;?>";
            is_user_logged_in = parseInt(is_user_logged_in);

            // Share form related
            var set_value_toEmail = "<?php echo set_value('toEmail');?>";
            var form_error_toEmail = "<?php echo form_error('toEmail');?>";
            var set_value_fromName = "<?php echo set_value('fromName');?>";
            var form_error_fromName = "<?php echo form_error('fromName');?>";
            var set_value_fromEmail = "<?php echo set_value('fromEmail');?>";
            var form_error_fromEmail = "<?php echo form_error('fromEmail');?>";
            var set_value_message = "<?php echo set_value('message');?>";
            var form_error_message = "<?php echo form_error('message');?>";
            var form_error_captcha = "<?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?>";
            var link_username = "<?php if (isset($link_item['username'])) echo $link_item['username'];?>";
        </script>
    </head>

    <body>
	       <div class=".navbar-inverse" style="background-color: #f0f0f0;text-transform: uppercase;border-bottom: 1px solid gray;height: 20px;line-height: 18px; overflow: hidden; white-space: nowrap;"><!--navbar navbar-fixed-top-->
               <div>
                       <div style="width:90%; overflow:hidden;">
                           <a href="#">
                               <div style="float:left; width:150px; overflow: hidden;">
                                   <div class="scroll-left" style="float:left; width:500px;">
                                       <span>Welcome to the front page of the internet</span>
                                   </div>
                               </div>
                               <span class="glyphicon glyphicon-bullhorn special-bullhorn-icon" style="font-size:16px; margin-top:1px; float:left;"></span>
                           </a>

                           &nbsp;&nbsp;
                           <a <?php if(!in_array($this->uri->segment(1),$front_forbidden)) echo 'style="color:red;"'; ?> href="<?php echo base_url('');?>">Front</a> -
                           <a <?php if ('ALL' == $this->uri->segment(2)) echo 'style="color:red;"'; ?> href="<?php echo base_url('').'t/ALL/';?>">All</a> -
                           <a href="<?php echo base_url('').'t/RANDOM/';?>">Random</a> &nbsp;|&nbsp;
                           <?php foreach($topics as $topic): ?>
                               <a <?php if ($topic['topic'] == $this->uri->segment(2)) echo 'style="color:red;"'; ?> href="<?php echo base_url('').'t/'.$topic['topic'].'/';?>"><?php echo $topic['topic']; ?></a> -
                           <?php endforeach ?>

                       </div>
                       <a href="#" style="float: right; position: absolute; top: 0px; right: 10px;">More<span class="glyphicon glyphicon-chevron-right" style="font-size:13px;"></span></a>
            </div>
        </div>

        <script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>
        <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

        <?php //echo $base_url;?>
        <ul class="nav nav-tabs" style="background:#CEE3F8;">
            <!-- <li><img src="/assets/img/logo/<?php //echo rand(1,5);?>.png" style="height:50px; margin-top:26px; margin-left:2px; position:relative; z-index:1; margin-bottom: -20px;"/><img src="/assets/img/logo/telve.png" style="height:40px; margin-top:36px; margin-right:10px; margin-left:-15px;"/></li> -->
            <li><img src="/assets/img/logo/turkish-coffee.png" id="turkish-coffee" style="height:40px; margin-top:36px; margin-left:2px; position:relative; z-index:1; margin-bottom: -50px;"/><img src="/assets/img/logo/telve.png" id="site-logo" style="height:30px; margin-top:46px; margin-right:10px; margin-left:-15px;"/></li>

            <?php if ( ($this->uri->segment(1) == 't') || ($this->uri->segment(1) == 'domain') ) { ?>
                <li class="topic-title"><?php echo $this->uri->segment(2);?></li>
            <?php }?>

            <li<?php if ( ($this->uri->segment($sn) == 'hot') || ($this->uri->segment($sn) == '') || is_numeric($this->uri->segment($sn)) ) echo ' class="active"' ?>><a <?php if ( ($this->uri->segment($sn) == 'hot') || ($this->uri->segment($sn) == '') || is_numeric($this->uri->segment($sn)) ) echo 'style="color:red;"' ?> href="<?php echo $base_url;?>">hot<span class="glyphicon glyphicon-fire" style="font-size:13px;"></span></a></li>
            <li<?php if ($this->uri->segment($sn) == 'new') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'new') echo 'style="color:red;"' ?> href="<?php echo $base_url.'new/';?>">new<span class="glyphicon glyphicon-gift" style="font-size:13px;"></span></a></li>
            <li<?php if ($this->uri->segment($sn) == 'rising') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'rising') echo 'style="color:red;"' ?> href="<?php echo $base_url.'rising/';?>">rising<span class="glyphicon glyphicon-signal" style="font-size:13px;"></span></a></li>
            <li<?php if ($this->uri->segment($sn) == 'controversial') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'controversial') echo 'style="color:red;"' ?> href="<?php echo $base_url.'controversial/';?>">controversial<span class="glyphicon glyphicon-comment" style="font-size:13px;"></span></a></li>
            <li<?php if ($this->uri->segment($sn) == 'top') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'top') echo 'style="color:red;"' ?> href="<?php echo $base_url.'top/';?>">top<span class="glyphicon glyphicon-circle-arrow-up" style="font-size:13px;"></span></a></li>
            <li<?php if ($this->uri->segment($sn) == 'wiki') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'wiki') echo 'style="color:red;"' ?> href="<?php echo base_url("wiki/index");?>">wiki<span class="glyphicon glyphicon-education" style="font-size:14px;"></span></a></li>

            <?php if ($this->uri->segment(3) == 'comments') { ?>
                <li class="active"><a style="color:red;" href="<?php echo base_url("")."t/".$link_item['topic']."/comments/".$link_item['id']."/".$link_item['seo_segment']."/";?>">comments</a></li>
            <?php }?>

            <!--Want to join? immediately <a href="#myModal" data-toggle="modal">Register or login</a>-->
            <?php echo $login_info;?>
       </ul>
