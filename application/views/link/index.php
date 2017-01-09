<?php $this->load->helper('human_timing'); ?><!--Format the time-->

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
		$currentPage = floor(($offset/$per_page) + 1);
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

									<div><a href="javascript:void(0)" id="up-<?php echo $link_item['id'];?>" class="login-required" onclick="up('<?php echo $link_item['id'];?>')"><i class="glyphicon glyphicon-arrow-up" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ($link_item['up_down'] == 1 ? 'color:green;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>

									<strong><div class="text-center" style="line-height: 1.6em;font-weight: bold; margin-bottom:2px;" id="show-<?php echo $link_item['id'];?>"><?php echo $link_item['score'];?></div></strong>

									<div><a href="javascript:void(0)" id="down-<?php echo $link_item['id'];?>" class="login-required" onclick="down('<?php echo $link_item['id'];?>')"><i class="glyphicon glyphicon-arrow-down" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ( (!($link_item['up_down'] == '') && ($link_item['up_down'] == 0)) ? 'color:red;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>

								</div>
                            </div>

                        </div>

						<?php if (empty($link_item['url'])) { ?>
                        	<div class="middle"><a href="<?php echo base_url("")."t/".$link_item['topic']."/comments/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><img class="media-object" src="<?php echo base_url('assets/img/icons/17837.png');?>" width="70" height="70" style="max-height: 70px;"/></a></div>
						<?php } else { ?>
							<div class="middle"><a href="<?php echo $link_item['url'];?>"><img class="media-object" src="<?php echo $link_item['picurl'];?>" onError="this.src='<?php echo base_url('assets/img/icons/1715.png');?>';" width="70" height="70" style="max-height: 70px;"/></a></div>
						<?php }?>

                        <div class="row-fluid">
                            <div class="span8">
								<?php if (empty($link_item['url'])) { ?>
		                        	<div>&nbsp;&nbsp;<strong><a style="text-decoration: none;color: blue;" href="<?php echo base_url("")."t/".$link_item['topic']."/comments/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><?php echo $link_item['title']?></a></strong>&nbsp; &nbsp;<span style="color:#888;">(<span style="color:#888;">text post</span>)</span></div>
								<?php } else { ?>
									<div>&nbsp;&nbsp;<strong><a style="text-decoration: none;color: blue;" href="<?php echo $link_item['url'];?>"><?php echo $link_item['title']?></a></strong>&nbsp; &nbsp;<span style="color:#888;">(<a style="color:#888;" href="<?php echo base_url().'domain/'.$link_item['domain'].'/';?>"><?php echo $link_item['domain'];?></a>)</span></div>
								<?php }?>
                                <div>&nbsp;
                                    <small style="color:#888;">submitted <?php echo human_timing($link_item['created']);?>&nbsp;&nbsp;by <a style="color: #369;" href="#"><?php echo $link_item['username']?></a>&nbsp;&nbsp;to <a style="color: #369;" href="#"><?php echo $link_item['topic']?></a></small>
                                </div>
                                <div>
                                    <div style="font-size:13px;">&nbsp;
                                        <strong><a style="color:#888;line-height: 1.6em;" href="<?php echo base_url("")."t/".$link_item['topic']."/comments/".$link_item['id']."/".$link_item['seo_segment']."/";?>"> <?php echo $link_item['comments'];?>&nbsp;comments<span class="glyphicon glyphicon-comment" style="font-size:11px;"></span></a>
										&nbsp;&nbsp;
                                        <a style="color:#888;line-height: 1.6em;" href="#">report<span class="glyphicon glyphicon-flag" style="font-size:12px;"></span></a>
                                        &nbsp;&nbsp;
                                        <a class="sharer" style="color:#888;line-height: 1.6em;" href="javascript:void(0)" onclick="set_share(this)">share<span class="glyphicon glyphicon-share" style="font-size:12px;"></span></a></strong>
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
