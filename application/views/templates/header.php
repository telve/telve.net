<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <meta name="description" content="User-generated news links. Votes promote stories to the front page." />
        <meta name="keywords" content="telve, social, news, links, comment" />
        <link rel="shortcut icon" href="<?php echo base_url("favicon.ico");?>" type="image/x-icon" >
        <link rel="icon" href="<?php echo base_url("favicon.ico");?>" type="image/x-icon" >
        <link href="<?php echo base_url("assets/css/bootstrap.css");?>" rel="stylesheet" media="screen">
        <link href="<?php echo base_url("assets/glyphicons/css/bootstrap.css");?>" rel="stylesheet" media="screen">
        <link href="<?php echo base_url("assets/css/telve.css");?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/style.css");?>" rel="stylesheet" type="text/css">

        <script type="text/javascript">
            var base_url = "<?php echo base_url('');?>";
            var is_user_logged_in = "<?php echo $is_user_logged_in;?>";
            is_user_logged_in = parseInt(is_user_logged_in);
            var username = "<?php echo $this->session->userdata('username'); ?>";
        </script>
    </head>

    <body>
	       <div class="navbar-inverse"><!--navbar navbar-fixed-top-->
               <div id="no-more">
                   <a href="#">
                       <div id="bullhorn-announcement">
                           <div class="scroll-left">
                               <span>İNTERNETİN ÖN SAYFASINA HOŞ GELDİNİZ</span>
                           </div>
                       </div>
                       <span class="glyphicon glyphicon-bullhorn special-bullhorn-icon"></span>
                   </a>

                   &nbsp;&nbsp;
                   <a <?php if(!in_array($this->uri->segment(1),$front_forbidden)) echo 'style="color:red;"'; ?> href="<?php echo base_url('');?>">Ön</a> -
                   <a <?php if ('TÜMÜ' == urldecode($this->uri->segment(2))) echo 'style="color:red;"'; ?> href="<?php echo base_url('').'t/TÜMÜ/';?>">Tümü</a> -
                   <a href="<?php echo base_url('').'t/RASTGELE/';?>">Rastgele</a> &nbsp;|&nbsp;
                   <?php foreach($topics_for_header as $topic): ?>
                       <a <?php if ($topic['topic'] == $this->uri->segment(2)) echo 'style="color:red;"'; ?> href="<?php echo base_url('').'t/'.$topic['topic'].'/';?>"><?php echo $topic['topic']; ?></a> -
                   <?php endforeach ?>

               </div>
               <a id="more" <?php if ( ($this->uri->segment(1) == 'konular') || ($this->uri->segment(1) == 'aboneliklerim') ) echo 'style="color:red;"'; ?> href="<?php
               if ($is_user_logged_in)
                    echo base_url('aboneliklerim');
               else
                    echo base_url('konular'); ?>">Devamı<span class="glyphicon glyphicon-chevron-right"></span></a>
           </div>

        <script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>
        <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

        <ul id="header" class="nav nav-tabs">
            <!-- <li><img src="/assets/img/logo/<?php //echo rand(1,5);?>.png"/><img src="/assets/img/logo/telve.png"/></li> -->
            <li><img src="/assets/img/logo/turkish-coffee.png" id="turkish-coffee"/><img src="/assets/img/logo/telve.png" id="site-logo"/></li>

            <?php if ( ($this->uri->segment(1) == 't') || ($this->uri->segment(1) == 'domain') || ( ($this->uri->segment(1) == 'user') && ($this->uri->segment(2) != 'register') && ($this->uri->segment(2) != 'login') ) ) { ?>
                <li class="topic-title"><?php echo urldecode($this->uri->segment(2));?></li>
            <?php } ?>

            <?php if ( ($this->uri->segment(1) == 'user') && ($this->uri->segment(2) != 'register') && ($this->uri->segment(2) != 'login') ) { ?>
                <li<?php if ( ($this->uri->segment(3) == '') || is_numeric($this->uri->segment(3)) ) echo ' class="active"'; ?>><a <?php if ( ($this->uri->segment(3) == '') || is_numeric($this->uri->segment(3)) ) echo 'style="color:red;"'; ?> href="<?php echo base_url("user")."/".$this->uri->segment(2)."/"; ?>">overview</a></li>
                <li<?php if ($this->uri->segment(3) == 'submitted') echo ' class="active"'; ?>><a <?php if ($this->uri->segment(3) == 'submitted') echo 'style="color:red;"'; ?> href="<?php echo base_url("user")."/".$this->uri->segment(2)."/submitted/"; ?>">submitted</a></li>
                <li<?php if ($this->uri->segment(3) == 'comments') echo ' class="active"'; ?>><a <?php if ($this->uri->segment(3) == 'comments') echo 'style="color:red;"'; ?> href="<?php echo base_url("user")."/".$this->uri->segment(2)."/comments/"; ?>">comments</a></li>
                <?php if ($is_user_logged_in) { ?>
                    <li<?php if ($this->uri->segment(3) == 'upvoted') echo ' class="active"'; ?>><a <?php if ($this->uri->segment(3) == 'upvoted') echo 'style="color:red;"'; ?> href="<?php echo base_url("user")."/".$this->uri->segment(2)."/upvoted/"; ?>">upvoted</a></li>
                    <li<?php if ($this->uri->segment(3) == 'downvoted') echo ' class="active"'; ?>><a <?php if ($this->uri->segment(3) == 'downvoted') echo 'style="color:red;"'; ?> href="<?php echo base_url("user")."/".$this->uri->segment(2)."/downvoted/"; ?>">downvoted</a></li>
                    <li<?php if ($this->uri->segment(3) == 'favourites') echo ' class="active"'; ?>><a <?php if ($this->uri->segment(3) == 'favourites') echo 'style="color:red;"'; ?> href="<?php echo base_url("user")."/".$this->uri->segment(2)."/favourites/"; ?>">favourites</a></li>
                <?php } ?>
            <?php } else { ?>

                <li<?php if ( ($this->uri->segment($sn) == 'hot') || ($this->uri->segment($sn) == '') || is_numeric($this->uri->segment($sn)) ) echo ' class="active"' ?>><a <?php if ( ($this->uri->segment($sn) == 'hot') || ($this->uri->segment($sn) == '') || is_numeric($this->uri->segment($sn)) ) echo 'style="color:red;"' ?> href="<?php echo $base_url;?>">sıcak<span class="glyphicon glyphicon-fire"></span></a></li>
                <li<?php if ($this->uri->segment($sn) == 'yeni') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'yeni') echo 'style="color:red;"' ?> href="<?php echo $base_url.'yeni/';?>">yeni<span class="glyphicon glyphicon-gift"></span></a></li>
                <li<?php if ($this->uri->segment($sn) == 'yukselen') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'yukselen') echo 'style="color:red;"' ?> href="<?php echo $base_url.'yukselen/';?>">yükselen<span class="glyphicon glyphicon-signal"></span></a></li>
                <li<?php if ($this->uri->segment($sn) == 'tartismali') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'tartismali') echo 'style="color:red;"' ?> href="<?php echo $base_url.'tartismali/';?>">tartışmalı<span class="glyphicon glyphicon-comment"></span></a></li>
                <li<?php if ($this->uri->segment($sn) == 'zirve') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'zirve') echo 'style="color:red;"' ?> href="<?php echo $base_url.'zirve/';?>">zirve<span class="glyphicon glyphicon-circle-arrow-up"></span></a></li>
                <li<?php if ($this->uri->segment($sn) == 'viki') echo ' class="active"' ?>><a <?php if ($this->uri->segment($sn) == 'viki') echo 'style="color:red;"' ?> href="<?php echo $base_url.'viki/';?>">viki<span class="glyphicon glyphicon-education" style="font-size:14px;"></span></a></li>

                <?php if ($this->uri->segment(3) == 'comments') { ?>
                    <li class="active"><a style="color:red;" href="<?php echo base_url("")."t/".$link_item['topic']."/comments/".$link_item['id']."/".$link_item['seo_segment']."/";?>">comments</a></li>
                <?php } ?>

            <?php } ?>
            <?php echo $login_info;?>
       </ul>
