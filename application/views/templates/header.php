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
	       <div class=".navbar-inverse" style="background-color: #f0f0f0;text-transform: uppercase;border-bottom: 1px solid gray;height: 20px;line-height: 18px;"><!--navbar navbar-fixed-top-->
               <div>
                   <ul>
                       <div class="dropdown">
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
                           <a href="#">All</a> -
                           <a href="#">Random</a> |
                           <a href="<?php echo base_url('imgur');?>">Pics</a> -
                           <a href="#">Funny</a> -
                           <a href="#">Game</a> -
                           <a href="#">AskTelve</a> -
                           <a href="#">WorldNews</a> -
                           <a href="#">News</a> -
                           <a href="#">Science and Technology</a> -
                           <a href="#">Education</a> -
                           <a href="#">Music</a> -
                           <a href="#">Movies</a> -
                           <a href="#">Gifs</a> -
                           <a href="#">Popular</a> -
                           <a href="#">Art</a> -
                           <a href="#">Books</a> -
                           <a href="#">Literature</a> -
                           <a href="#">Finance and Economics</a> -
                           <a href="#">More>></a>

                </ul>
            </div>
        </div>

        <script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>
        <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

        <ul class="nav nav-tabs" style="background:#CEE3F8;">
            <li><a class="text-center" style="float:left;width:120px;" href="<?php echo base_url("");?>">front</a></li>
            <li<?php if ( ($this->uri->segment(1) == 'hot') || !$this->uri->segment(1) ) echo ' class="active"' ?>><a <?php if ( ($this->uri->segment(1) == 'hot') || !$this->uri->segment(1) ) echo 'style="color:red;"' ?> href="<?php echo base_url("");?>">hot</a></li>
            <li<?php if ($this->uri->segment(1) == 'new') echo ' class="active"' ?>><a <?php if ($this->uri->segment(1) == 'new') echo 'style="color:red;"' ?> href="<?php echo base_url("new");?>">new</a></li>
            <li<?php if ($this->uri->segment(1) == 'rising') echo ' class="active"' ?>><a <?php if ($this->uri->segment(1) == 'rising') echo 'style="color:red;"' ?> href="<?php echo base_url("rising");?>">rising</a></li>
            <li<?php if ($this->uri->segment(1) == 'controversial') echo ' class="active"' ?>><a <?php if ($this->uri->segment(1) == 'controversial') echo 'style="color:red;"' ?> href="<?php echo base_url("controversial");?>">controversial</a></li>
            <li<?php if ($this->uri->segment(1) == 'top') echo ' class="active"' ?>><a <?php if ($this->uri->segment(1) == 'top') echo 'style="color:red;"' ?> href="<?php echo base_url("top");?>">top</a></li>
            <li<?php if ($this->uri->segment(1) == 'wiki') echo ' class="active"' ?>><a <?php if ($this->uri->segment(1) == 'wiki') echo 'style="color:red;"' ?> href="<?php echo base_url("wiki/index");?>">wiki</a></li>
            <!--Want to join? immediately <a href="#myModal" data-toggle="modal">Register or login</a>-->
            <li style="float:right;width:300px;"><?php echo $login_info;?></a></li>
       </ul>
