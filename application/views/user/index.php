<?php
	$this->load->helper('human_timing');
	$this->load->library('hashids');
	$this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
?><!--Format the time-->

<?php echo $toggle_sidebar ?>

<div class="container-fluid">
	<div class="row-fluid">

	<?php echo $sidebar ?>

    	<div id="right-content" class="span8"><!-- style="background:#abb;"-->

			<br>

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

		<?php if ($link_item['is_link_for_union'] == 1) { ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="link"><!--background-color:#fbb;-->
                    <div class="row-fluid">

                        <div class="left" style="width:50px;"><!-- style="background-color:#3bb;"-->
                            <div class="row-fluid">

                                <div class="digg">
									<div><a href="javascript:void(0)" title="evet" id="up-<?php echo $link_item['id'];?>" class="login-required" onclick="up('<?php echo $link_item['id'];?>')"><i class="glyphicon glyphicon-arrow-up" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ($link_item['up_down'] == 1 ? 'color:green;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>
									<strong><div class="text-center score" id="show-<?php echo $link_item['id'];?>"><?php echo $link_item['score'];?></div></strong>
									<div><a href="javascript:void(0)" title="hayır" id="down-<?php echo $link_item['id'];?>" class="login-required" onclick="down('<?php echo $link_item['id'];?>')"><i class="glyphicon glyphicon-arrow-down" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ( (!($link_item['up_down'] == '') && ($link_item['up_down'] == 0)) ? 'color:red;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>
								</div>
                            </div>
                        </div>

						<div class="middle">
							<?php if (empty($link_item['url'])) { ?>
	                        	<a href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><img class="media-object link-thumbnail" src="<?php echo base_url('assets/img/icons/17837.png');?>"/></a>
							<?php } else { ?>
								<a href="<?php echo $link_item['url'];?>"><img class="media-object link-thumbnail" src="<?php echo $link_item['picurl'];?>" onError="this.src='<?php echo base_url('assets/img/icons/1715.png');?>';"/></a>
							<?php }?>
						</div>

                        <div class="row-fluid">
                            <div class="span8" style="margin-left: 15px;">
								<?php if (empty($link_item['url'])) { ?>
		                        	<div class="link-title"><strong><a class="link-title" href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><?php echo $link_item['title']?></a></strong>&nbsp;&nbsp;&nbsp;<span class="link-domain">(metin türünde)</span></div>
								<?php } else { ?>
									<div class="link-title"><strong><a class="link-title" href="<?php echo $link_item['url'];?>"><?php echo $link_item['title']?></a></strong>&nbsp;&nbsp;&nbsp;<span class="link-domain">(<a href="<?php echo base_url().'alan-adi/'.$link_item['domain'].'/';?>"><?php echo $link_item['domain'];?></a>)</span></div>
								<?php }?>
                                <div style="line-height: 14px;">
                                    <small class="details"><?php echo human_timing($link_item['created']);?> gönderildi&nbsp;&nbsp;<a href="<?php echo base_url('').'kullanici/'.$link_item['username'].'/';?>"><?php echo $link_item['username']?></a> tarafından&nbsp;&nbsp;<a href="<?php echo base_url('').'t/'.$link_item['topic'].'/';?>"><?php echo $link_item['topic']?></a> konusuna</small>
                                </div>
                                <div>
                                    <div class="link-actions"><strong>
                                        <a href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>" class="comments"> <?php echo $link_item['comments'];?>&nbsp;yorum<span class="glyphicon glyphicon-comment" style="font-size:11px;"></span></a>
										&nbsp;&nbsp;
                                        <a href="javascript:void(0)" onclick="report_link('<?php echo $link_item['id'];?>')" class="login-required">şikayet<span class="glyphicon glyphicon-flag" style="font-size:12px;"></span></a>
                                        &nbsp;&nbsp;
                                        <a href="javascript:void(0)" onclick="share_link(this)">paylaş<span class="glyphicon glyphicon-share" style="font-size:12px;"></span></a>
                                    </strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
					</div><!--/left-->
                </div>
            </div><!--/row-fluid-->
			<br>

		<?php } else if ($link_item['is_link_for_union'] == 0) {

			$ago = human_timing($link_item['created']);
			if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) {
				$up_style = ($link_item['up_down'] == 1 ? 'color:green;' : 'color:black;');
				$down_style = ( (!($link_item['up_down'] == '') && ($link_item['up_down'] == 0)) ? 'color:red;' : 'color:black;');
			} else {
				$up_style = 'color:black;';
				$down_style = 'color:black;';
			}

			$favourite_onclick = ( isset($link_item['is_favorited']) ? 'unfavourite_reply(this)' : 'favourite_reply(this)' );
			$favourite_html = ( isset($link_item['is_favorited']) ? 'favourite<span class="glyphicon glyphicon-star"></span>' : 'favourite<span class="glyphicon glyphicon-star-empty"></span>' );

			echo "<!--One reply from the reply tree of this post-->
			<div class='row-fluid'>

				<div class='span12'>
					<style>

					</style>

					<div id='switch' style='margin-bottom:4px;color: #888;'>
						<a class='hide_up login-required' href='javascript:void(0)' id='".$link_item['id']."' onclick='rply_up(this)'><i class='glyphicon glyphicon-arrow-up' style='".$up_style."'></i></a>

						<a style='color: gray;' id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>

						<a style='color: #369;font-weight: bold;' href='".base_url('user/').$link_item['username'].'/'."'>".$link_item['username']."</a>&nbsp;&nbsp;<span id='show-".$link_item['id']."'>".$link_item['score']."</span> points&nbsp;&nbsp;submitted ".$ago."
						&nbsp;<span style='color: gray;'>
							(<a style='color: gray;' class='hide_rply'> ".$link_item['comments']." <span class='glyphicon glyphicon-comment' style='font-size:10px;'></span> </a>)
							&nbsp;
							<a style='color: gray;' class='hide_rply' href='".base_url("")."t/".$link_item['topic']."/comments/".$this->hashids->encode($link_item['url'])."/".$link_item['seo_segment']."/"."'>link<span class='glyphicon glyphicon-link' style='font-size:10px;'></span></a>
							</span></small>
					</div>

					<div class='hide_content' style='margin-bottom:6px;'>
						<a class='login-required' href='javascript:void(0)' id='".$link_item['id']."' onclick='rply_down(this)'><i class='glyphicon glyphicon-arrow-down' style='".$down_style."'></i></a>

						<span style='display:inline-block;'>".markdown($link_item['text'])."</span>
						<!--<input type='hidden' class='show' value='".$link_item['id']."'/>-->
					</div>

					<div class='hide_function' style='margin-bottom: 15px; margin-top: -15px;'>
						<div style='color: #888;font-weight: bold;padding: 0 1px;'>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a style='color: #888;' id='".$link_item['id']."' href='javascript:void(0)' onclick='".$favourite_onclick."' class='login-required'>".$favourite_html."</a>
							&nbsp;&nbsp;&nbsp;&nbsp;<a style='color: #888;' href='javascript:void(0)' onclick='report_reply(\"".$link_item['id']."\")' class='login-required'>report<span class='glyphicon glyphicon-flag'></span></a>
							&nbsp;&nbsp;&nbsp;&nbsp;</small><a style='color: #888;' href='javascript:void(0)' onclick='set_reply(this)' id='".$link_item['id']."'><small>reply<span class='glyphicon glyphicon-share-alt special-reply-icon'></span></small></a>
						</div>
					</div>
				</div>

			</div>
			<!--One reply from the reply tree of this post-->";

		} ?>

        <?php endforeach?>

		<br>
        <?php echo $this->pagination->create_links(); ?>
    </div>
