<?php $this->load->helper('human_timing'); ?><!--Format the time-->
<?php $this->load->helper('markdown'); ?>

<div class="container-fluid">
    <div class="row-fluid"><!-- style="background-color:#9bb;"-->
        <div id="right-content" class="span8">

			<!-- row-fluid > link -->
            <div class="row-fluid">
                <div class="span12">
                    <div class="link">
                    <div class="row-fluid">

                        <div class="left"><!-- style="background-color:#3bb;"-->
            				<div class="row-fluid">
                                <div class="rank">
                                </div>
            					<div class="digg">
            						<div><a href="javascript:void(0);" title="evet" id="<?php echo $link_item['id'];?>" class="login-required" onclick="up_on_view(this);"><i class="glyphicon glyphicon-arrow-up" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ($link_item['up_down'] == 1 ? 'color:green;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>
            						<strong><div class="text-center score" id="link-score-<?php echo $link_item['id'];?>"><?php echo $link_item['score'];?></div></strong>
            						<div><a href="javascript:void(0);" title="hayır" id="<?php echo $link_item['id'];?>" class="login-required" onclick="down_on_view(this);"><i class="glyphicon glyphicon-arrow-down" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ( (!($link_item['up_down'] == '') && ($link_item['up_down'] == 0)) ? 'color:red;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>
            					</div>
                            </div>
                        </div>

						<div class="middle">
                            <?php if (empty($link_item['url'])) { ?>
                            	<a href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><div class="link-thumbnail" style="background-image: url('<?php echo base_url('assets/img/icons/17837-rect.png');?>');"></div></a>
    						<?php } else {
                                $ext = pathinfo(parse_url($link_item['picurl'], PHP_URL_PATH), PATHINFO_EXTENSION);
                                ?>
    							<a href="<?php echo $link_item['url'];?>"><div class="link-thumbnail" style="background-image: url('<?php if (empty($link_item['picurl'])) echo base_url('assets/img/icons/1715-rect.png'); else echo base_url('assets/img/link_thumbnails/'.$link_item['id'].'_thumb.'.$ext);?>');"></div></a>
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
        							<small class="details"><a href="<?php echo base_url('').'kullanici/'.$link_item['username'].'/';?>"><?php echo $link_item['username']?></a> tarafından&nbsp;&nbsp;<a href="<?php echo base_url('').'t/'.$link_item['topic'].'/';?>"><?php echo $link_item['topic']?></a> konusuna&nbsp;&nbsp;<?php echo human_timing($link_item['created']);?> gönderildi</small>
        						</div>
                                <div>
                                    <?php echo markdown($link_item['text']);?>
                                </div>
                                <div>
                                    <?php echo $link_item['embed'];?>
                                </div>
        						<div>
        							<div class="link-actions"><strong>
        								<a href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>" class="comments"><?php echo $link_item['comments']?> yorum<span class="glyphicon glyphicon-comment" style="font-size:11px;"></span></a>
                                        <a href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/";?>" class="short-link"></a>
                                        &nbsp;&nbsp;
                                        <?php if (isset($link_item['is_favorited'])) { ;?>
                                            <a id="<?php echo $link_item['id'];?>" href="javascript:void(0)" onclick="unfavourite_link(this)" class="login-required">favori<span class="glyphicon glyphicon-star" style="font-size:13px;"></span></a>
                                        <?php } else { ?>
                                            <a id="<?php echo $link_item['id'];?>" href="javascript:void(0)" onclick="favourite_link(this)" class="login-required">favori<span class="glyphicon glyphicon-star-empty" style="font-size:13px;"></span></a>
                                        <?php } ?>
                                        &nbsp;&nbsp;
                                        <a href="javascript:void(0)" onclick="report_link('<?php echo $link_item['id'];?>')" class="login-required">şikayet<span class="glyphicon glyphicon-flag" style="font-size:12px;"></span></a>
                                        &nbsp;&nbsp;
                                        <a id="hide_link" href="javascript:void(0)">gizle<span class="glyphicon glyphicon-eye-close" style="font-size:12px;"></span></a>
                                        &nbsp;&nbsp;
                                        <a href="javascript:void(0)" onclick="share_link(this)">paylaş<span class="glyphicon glyphicon-share" style="font-size:12px;"></span></a>
        							</strong></div>
        						</div>
                            </div>
                        </div>
        			</div>
                    </div>
                </div>
			</div>
            <!-- row-fluid > link -->

			<!-- Comments block -->
    		<div id="comments-block">
                <!-- Horizontal solid line and submit text box -->
                <?php
                $this->load->helper('get_param');
                if($link_item['comments'] == 0) {
                    echo 'yorum yok (henüz)';
                } else if ( ($link_item['comments'] < 20) || $this->input->get('nolimit') ) {
                    echo '(hepsi) '.$link_item['comments'].' yorum';
                } else {
                    echo 'sadece 20 yorum';
                    echo '&nbsp; &nbsp;<small><a href="'.append_get_param('nolimit=1').'">'.$link_item['comments'].' yorumun hepsini görüntüle</a></small>';
                }
                ?>
                <div>
                    <div id="comments-solid-line"> </div><!--Draw a solid line-->
                    <div><small id="sorting-text">
                        <div class="dropdown">
                            sıralama:
                            <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="">
                                <?php
                                if ($this->input->get('sirala')) {
                                    echo $this->input->get('sirala');
                                } else {
                                    echo "sıcak";
                                }
                                ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li><a tabindex="-1" href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>">sıcak</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sirala=zirve'); ?>">zirve</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sirala=yeni'); ?>">yeni</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sirala=tartismali'); ?>">tartismali</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sirala=eski'); ?>">eski</a></li>
                            </ul>
                        </div>
                    </small>
                        <div>
                            <br>
                            <textarea rows="4" class="span6" name="content" id="content" onfocus="first_of_all_login()" placeholder="yorumunuz... Markdown formatında"/></textarea>
                            <div class="live-preview2"></div>
                            <br />
                            <input type="hidden" name="pid" id="pid" value="<?php echo $link_item['id']?>" />
                            <div style="width:49%;"><a class="link-to-guide pull-right" href="<?php echo base_url('sayfalar/markdown_rehberi');?>">Markdown rehberi</a></div>
            				<!--<button class="btn btn-primary  pull-left" type="submit" name="submit" >submit</button>-->
                            <!--<div id="error_msg"></div>-->
                            <button type="submit" id="submit_reply" class="login-required">gönder</button>
                <!-- Horizontal solid line and submit text box -->
                            <br/>
                            <!--Newly submitted replies-->
                            <div id="update_reply"></div>
                            <!-- Comment tree -->
                            <?php echo $tree;?>
                            <!-- Comment tree -->

        				</div>
		            </div>
			  </div>
              <!-- <div style="margin: 0 0 10px 25px;"> <a href="#load_more">Load more (192)</a> Each loads 20 </div> -->
			</div>
		</div>
