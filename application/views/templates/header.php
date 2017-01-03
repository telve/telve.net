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
        <link href="<?php echo base_url("assets/css/style.css");?>" rel="stylesheet" type="text/css">
    	<style type="text/css">
    		/*
            body{
    			padding-top:30px;
    			padding-bottom:40px;
    		}
            */
    	</style>
    </head>

    <body>
	       <div class=".navbar-inverse" style="background-color: #f0f0f0;text-transform: uppercase;border-bottom: 1px solid gray;height: 20px;line-height: 18px; overflow: hidden;"><!--navbar navbar-fixed-top-->
               <div>
                   <ul>
                       <div class="dropdown" style="width: 90%;">
                           <a class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="#">My Subscriptions<b class="caret"></b></a>
                           <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Science and Technology</a></li>
                               <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="icon-picture"></i> Images</a></li>
                               <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="icon-video"></i> Videos</a></li>
                               <li role="presentation" class="divider"></li>
                               <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="icon-edit"></i> Edit the subscription</a></li>
                           </ul>
                           &nbsp;&nbsp;
                           <a style="color:red;" href="<?php echo base_url('');?>">Front</a> -
                           <a href="<?php echo base_url('').'t/ALL/';?>">All</a> -
                           <a href="<?php echo base_url('').'t/RANDOM/';?>">Random</a> &nbsp;|&nbsp;
                           <?php foreach($topics as $topic): ?>
                               <a href="<?php echo base_url('').'t/'.$topic['topic'].'/';?>"><?php echo $topic['topic']; ?></a> -
                           <?php endforeach ?>

                       </div>
                       <a href="#" style="float: right; position: absolute; top: 0px; right: 10px;">More >></a>
                </ul>
            </div>
        </div>

        <script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>
        <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

        <?php //echo $base_url;?>
        <ul class="nav nav-tabs" style="background:#CEE3F8;">
            <li><a class="text-center" style="float:left;width:120px;" href="<?php echo base_url("");?>">front</a></li>
            <li<?php if ( ($this->uri->segment($sn) == 'hot') || ($this->uri->segment($sn) == '') ) echo ' class="active"' ?>><a <?php if ( ($this->uri->segment($sn) == 'hot') || ($this->uri->segment($sn) == '') ) echo 'style="color:red;"' ?> href="<?php echo $base_url;?>">hot</a></li>
            <li<?php if ($this->uri->segment($sn) == 'new') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'new') echo 'style="color:red;"' ?> href="<?php echo $base_url.'new/';?>">new</a></li>
            <li<?php if ($this->uri->segment($sn) == 'rising') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'rising') echo 'style="color:red;"' ?> href="<?php echo $base_url.'rising/';?>">rising</a></li>
            <li<?php if ($this->uri->segment($sn) == 'controversial') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'controversial') echo 'style="color:red;"' ?> href="<?php echo $base_url.'controversial/';?>">controversial</a></li>
            <li<?php if ($this->uri->segment($sn) == 'top') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'top') echo 'style="color:red;"' ?> href="<?php echo $base_url.'top/';?>">top</a></li>
            <li<?php if ($this->uri->segment($sn) == 'wiki') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'wiki') echo 'style="color:red;"' ?> href="<?php echo base_url("wiki/index");?>">wiki</a></li>
            <!--Want to join? immediately <a href="#myModal" data-toggle="modal">Register or login</a>-->
            <li style="float:right;width:300px;"><?php echo $login_info;?></a></li>
       </ul>
