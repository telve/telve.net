<?php
    $this->load->helper('human_timing');
    $this->load->library('hashids');
    $this->hashids = new Hashids($this->config->item('hashids_salt'), 6);
?><!--Format the time-->
<?php
    $this->load->helper('markdown');
    $Parsedown = new Parsedown();
    $this->load->helper('telveflavor');
?>

<?php echo $toggle_sidebar ?>

<div class="container-fluid">
    <div class="row-fluid">

    <?php echo $sidebar ?>

        <div id="right-content" class="span8"><!-- style="background:#abb;"-->

        <?php
        $item_counter = 0;
        if (count($link) == 0) {
          echo '<br><br><h2 style="margin-left: 50px;">Hiçbir şey bulunamadı</h2>';
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
                                        <?php } ?>
                                    <?php } ?>
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
                                            <?php } ?>
                                        <?php }?>

                                        <div style="line-height: 14px;">
                                            <small class="details"><a href="<?php echo base_url('').'kullanici/'.$link_item['username'].'/';?>"><?php echo $link_item['username']?></a> tarafından&nbsp;&nbsp;<a href="<?php echo base_url('').'t/'.$link_item['topic'].'/';?>"><?php echo $link_item['topic']?></a> konusuna&nbsp;&nbsp;<?php echo human_timing($link_item['created']);?> gönderildi</small>
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
                          $favourite_html = ( isset($link_item['is_favorited']) ? 'favori<span class="glyphicon glyphicon-star"></span>' : 'favori<span class="glyphicon glyphicon-star-empty"></span>' );

                          echo "<!--One reply from the reply tree of this post-->
                                <div id='yorum-".$link_item['id']."' class='row-fluid reply-wrapper'>
                                  <div class='span8'>

                                    <div class='reply-header'>
                                      <a class='reply-up login-required' title='evet' href='javascript:void(0)' id='".$link_item['id']."' onclick='rply_up(this)'><i class='glyphicon glyphicon-arrow-up' style='".$up_style."'></i></a>
                                      <a class='color-gray' title='küçült' id='minus' href='javascript:void(0)' onclick='switch_state(this)'>[–]</a>&nbsp;<small>
                                      <a class='reply-user-link' href='".base_url('kullanici/').$link_item['username'].'/'."'>".$link_item['username']."</a>&nbsp;&nbsp;<span id='reply-score-".$link_item['id']."'>".$link_item['score']."</span> puan&nbsp;&nbsp;".$ago." gönderildi
                                      &nbsp;<span class='color-gray'>(<a class='color-gray' title='yanıt sayısı'> ".$link_item['comments']." <span class='glyphicon glyphicon-comment' style='font-size:10px;'></span> </a>)
                                      &nbsp;<a class='color-gray' href='".base_url("")."t/".$link_item['topic']."/yorumlar/".$this->hashids->encode($link_item['url'])."/".$link_item['seo_segment']."/"."'>bağlantı<span class='glyphicon glyphicon-link' style='font-size:10px;'></span></a></span></small>
                                    </div>

                                    <a class='reply-down login-required' title='hayır' href='javascript:void(0)' id='".$link_item['id']."' onclick='rply_down(this)'><i class='glyphicon glyphicon-arrow-down' style='".$down_style."'></i></a>
                                    <div class='reply-content'>
                                      <span style='display:inline-block;'>".telveflavor($Parsedown->text($link_item['text']))."</span>
                                    </div>

                                    <div class='reply-functions hide_function'>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a class='color-gray' id='".$link_item['id']."' href='javascript:void(0)' onclick='".$favourite_onclick."' class='login-required'>".$favourite_html."</a>
                                      &nbsp;&nbsp;&nbsp;&nbsp;<a class='color-gray' href='javascript:void(0)' onclick='report_reply(\"".$link_item['id']."\")' class='login-required'>şikayet<span class='glyphicon glyphicon-flag'></span></a>
                                      &nbsp;&nbsp;&nbsp;&nbsp;</small><a class='color-gray' href='javascript:void(0)' onclick='set_reply(this)' id='".$link_item['id']."'><small>yanıt<span class='glyphicon glyphicon-share-alt special-reply-icon'></span></small></a>
                                      &nbsp;&nbsp;&nbsp;&nbsp;</small><a class='color-gray' href='javascript:void(0)' onclick='share_reply(this)' id='".$link_item['id']."'><small>paylaş<span class='glyphicon glyphicon-share'></span></small></a>
                                    </div>

                                  </div>
                                </div>
                                <!--One reply from the reply tree of this post-->";

                } ?>

                <?php endforeach?>

                <br>
                <?php echo $this->pagination->create_links(); ?>
            </div>
