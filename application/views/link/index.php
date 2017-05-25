<?php $this->load->helper('human_timing'); ?><!--Format the time-->

<?php echo $toggle_sidebar ?>

<div class="container-fluid">
    <div class="row-fluid">

    <?php echo $sidebar ?>

        <div id="right-content" class="span8"><!-- style="background:#abb;"-->

        <?php
            $item_counter = 0;
            if (count($link) == 0) {
                echo '<br><br><h2 style="margin-left: 50px;">Hiç gönderi bulunamadı</h2>';
            }
            foreach($link as $link_item):
                $item_counter += 1;
                $currentPage = floor(($offset/$per_page) + 1);
                $rank = ($currentPage - 1) * 10 + $item_counter;
        ?>


        <div class="row-fluid">
            <div class="span12">
                <div class="link"><!--background-color:#fbb;-->
                    <div class="row-fluid">

                        <div class="left"><!-- style="background-color:#3bb;"-->
                            <div class="row-fluid">
                                <div class="rank">
                                    <div>  <br /><?php echo $rank;?></div>
                                </div>
                                <div class="digg">
                                    <div><a href="javascript:void(0)" title="evet" id="up-<?php echo $link_item['id'];?>" class="login-required" onclick="up('<?php echo $link_item['id'];?>')"><i class="glyphicon glyphicon-arrow-up" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ($link_item['up_down'] == 1 ? 'color:green;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>
                                    <strong><div class="text-center score" id="link-score-<?php echo $link_item['id'];?>"><?php echo $link_item['score'];?></div></strong>
                                    <div><a href="javascript:void(0)" title="hayır" id="down-<?php echo $link_item['id'];?>" class="login-required" onclick="down('<?php echo $link_item['id'];?>')"><i class="glyphicon glyphicon-arrow-down" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ( (!($link_item['up_down'] == '') && ($link_item['up_down'] == 0)) ? 'color:red;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>
                                </div>
                            </div>
                        </div>

                        <div class="middle">
                          <?php if (empty($link_item['url'])) { ?>
                              <a href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><div class="link-thumbnail" style="background-image: url('<?php echo base_url('assets/img/icons/17837-rect.png');?>');"></div></a>
                          <?php } else {
                              $ext = pathinfo(parse_url($link_item['picurl'], PHP_URL_PATH), PATHINFO_EXTENSION);
                              ?>
                              <?php if (!empty($link_item['embed'])) { ?>
                                  <a href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><div class="link-thumbnail" style="background-image: url('<?php if (empty($link_item['picurl'])) echo base_url('assets/img/icons/1715-rect.png'); else echo base_url('assets/img/link_thumbnails/'.$link_item['id'].'_thumb.'.$ext);?>');"></div></a>
                              <?php } else { ?>
                                  <a href="<?php echo $link_item['url'];?>"><div class="link-thumbnail" style="background-image: url('<?php if (empty($link_item['picurl'])) echo base_url('assets/img/icons/1715-rect.png'); else echo base_url('assets/img/link_thumbnails/'.$link_item['id'].'_thumb.'.$ext);?>');"></div></a>
                              <?php }?>
                          <?php }?>
                        </div>

                        <div class="row-fluid">
                            <div class="span8" style="margin-left: 15px;">
                            <?php if (empty($link_item['url'])) { ?>
                                <div class="link-title"><strong><a class="link-title" href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><?php echo $link_item['title']?></a></strong>&nbsp;&nbsp;&nbsp;<span class="link-domain">(metin türünde)</span></div>
                            <?php } else { ?>
                                <?php if (!empty($link_item['embed'])) { ?>
                                    <div class="link-title"><strong><a class="link-title" href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><?php echo $link_item['title']?></a></strong>&nbsp;&nbsp;&nbsp;<span class="link-domain">(<a href="<?php echo base_url().'alan-adi/'.$link_item['domain'].'/';?>"><?php echo $link_item['domain'];?></a>)</span></div>
                                <?php } else { ?>
                                    <div class="link-title"><strong><a class="link-title" href="<?php echo $link_item['url'];?>"><?php echo $link_item['title']?></a></strong>&nbsp;&nbsp;&nbsp;<span class="link-domain">(<a href="<?php echo base_url().'alan-adi/'.$link_item['domain'].'/';?>"><?php echo $link_item['domain'];?></a>)</span></div>
                                <?php }?>
                            <?php }?>

                            <div style="line-height: 14px;">
                                <small class="details"><a href="<?php echo base_url('').'kullanici/'.$link_item['username'].'/';?>"><?php echo $link_item['username']?></a> tarafından&nbsp;&nbsp;<a href="<?php echo base_url('').'t/'.$link_item['topic'].'/';?>"><?php echo $link_item['topic']?></a> konusuna&nbsp;&nbsp;<?php echo human_timing($link_item['created']);?> gönderildi&nbsp;&nbsp;</small>
                            </div>
                            <div>
                                <div class="link-actions">
                                    <strong>
                                        <a href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/".$link_item['seo_segment']."/";?>" class="comments"> <?php echo $link_item['comments'];?>&nbsp;yorum<span class="glyphicon glyphicon-comment" style="font-size:11px;"></span></a>
                                        <a href="<?php echo base_url("")."t/".$link_item['topic']."/yorumlar/".$link_item['id']."/";?>" class="short-link"></a>
                                        &nbsp;&nbsp;
                                        <a href="javascript:void(0)" onclick="report_link('<?php echo $link_item['id'];?>')" class="login-required">şikayet<span class="glyphicon glyphicon-flag" style="font-size:12px;"></span></a>
                                        &nbsp;&nbsp;
                                        <a href="javascript:void(0)" onclick="share_link(this)">paylaş<span class="glyphicon glyphicon-share" style="font-size:12px;"></span></a>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/left-->
        </div>
    </div><!--/row-fluid-->

    <?php endforeach?>

    <br>
        <?php echo $this->pagination->create_links(); ?>
    </div>
