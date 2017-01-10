<?php $this->load->helper('human_timing'); ?><!--Format the time-->

<div class="container-fluid">
    <div class="row-fluid"><!-- style="background-color:#9bb;"-->
        <div class="span8">

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
            						<div><a href="javascript:void(0);" id="<?php echo $link_item['id'];?>" class="login-required" onclick="up_on_view(this);"><i class="glyphicon glyphicon-arrow-up" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ($link_item['up_down'] == 1 ? 'color:green;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>
            						<strong><div class="text-center score" id="show-<?php echo $link_item['id'];?>"><?php echo $link_item['score'];?></div></strong>
            						<div><a href="javascript:void(0);" id="<?php echo $link_item['id'];?>" class="login-required" onclick="down_on_view(this);"><i class="glyphicon glyphicon-arrow-down" style="<?php if (!empty($this->session->userdata['username']) && $this->session->userdata['username']) echo ( (!($link_item['up_down'] == '') && ($link_item['up_down'] == 0)) ? 'color:red;' : 'color:black;'); else echo 'color:black;' ?>"></i></a></div>
            					</div>
                            </div>
                        </div>

						<div class="middle">
                            <?php if (empty($link_item['url'])) { ?>
                            	<a href="<?php echo base_url("")."t/".$link_item['topic']."/comments/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><img class="media-object link-thumbnail" src="<?php echo base_url('assets/img/icons/17837.png');?>"/></a>
    						<?php } else { ?>
    							<a href="<?php echo $link_item['url'];?>"><img class="media-object link-thumbnail" src="<?php echo $link_item['picurl'];?>" onError="this.src='<?php echo base_url('assets/img/icons/1715.png');?>';"/></a>
    						<?php }?>
						</div>

                        <div class="row-fluid">
                            <div class="span8" style="margin-left: 15px;">
                                <?php if (empty($link_item['url'])) { ?>
                                    <div class="link-title"><strong><a class="link-title" href="<?php echo base_url("")."t/".$link_item['topic']."/comments/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><?php echo $link_item['title']?></a></strong>&nbsp;&nbsp;&nbsp;<span class="link-domain">(text post)</span></div>
                                <?php } else { ?>
                                    <div class="link-title"><strong><a class="link-title" href="<?php echo $link_item['url'];?>"><?php echo $link_item['title']?></a></strong>&nbsp;&nbsp;&nbsp;<span class="link-domain">(<a href="<?php echo base_url().'domain/'.$link_item['domain'].'/';?>"><?php echo $link_item['domain'];?></a>)</span></div>
                                <?php }?>
        						<div style="line-height: 14px;">
        							<small class="details">submitted <?php echo human_timing($link_item['created']);?>&nbsp;&nbsp;by <a href="#"><?php echo $link_item['username']?></a>&nbsp;&nbsp;to <a href="#"><?php echo $link_item['topic']?></a></small>
        						</div>
                                <div>
                                    <?php echo $link_item['text'];?>
                                </div>
        						<div>
        							<div class="link-actions"><strong>
        								<a href="<?php echo base_url("")."t/".$link_item['topic']."/comments/".$link_item['id']."/".$link_item['seo_segment']."/";?>"><?php echo $link_item['comments']?> comments<span class="glyphicon glyphicon-comment" style="font-size:11px;"></span></a>
                                        &nbsp;&nbsp;
                                        <a href="#">favorite<span class="glyphicon glyphicon-star-empty" style="font-size:13px;"></span></a>
                                        &nbsp;&nbsp;
                                        <a href="#">report<span class="glyphicon glyphicon-flag" style="font-size:12px;"></span></a>
                                        &nbsp;&nbsp;
                                        <a id="hide_link" href="javascript:void(0)">hide<span class="glyphicon glyphicon-eye-close" style="font-size:12px;"></span></a>
                                        &nbsp;&nbsp;
                                        <a href="#">share<span class="glyphicon glyphicon-share" style="font-size:12px;"></span></a>
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
                    echo 'No comments (yet)';
                } else if ( ($link_item['comments'] < 20) || $this->input->get('nolimit') ) {
                    echo 'all '.$link_item['comments'].' comments';
                } else {
                    echo 'only 20 comments';
                    echo '&nbsp; &nbsp;<small><a href="'.append_get_param('nolimit=1').'">display all '.$link_item['comments'].'</a></small>';
                }
                ?>
                <div>
                    <div id="comments-solid-line"> </div><!--Draw a solid line-->
                    <div><small id="sorting-text">
                        <div class="dropdown">
                            sorting:
                            <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="">
                                <?php
                                if ($this->input->get('sort')) {
                                    echo $this->input->get('sort');
                                } else {
                                    echo "hot";
                                }
                                ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li><a tabindex="-1" href="<?php echo base_url("")."t/".$link_item['topic']."/comments/".$link_item['id']."/".$link_item['seo_segment']."/";?>">hot</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sort=top'); ?>">top</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sort=new'); ?>">new</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sort=controversial'); ?>">controversial</a></li>
                                <li><a tabindex="-1" href="<?php echo append_get_param('sort=old'); ?>">old</a></li>
                            </ul>
                        </div>
                    </small>
                        <div>
                            <br>
                            <textarea rows="4" class="span6" name="content" id="content" onfocus="first_of_all_login()"/></textarea><br />
			                <input type="hidden" name="pid" id="pid" value="<?php echo $link_item['id']?>" />
            				<!--<button class="btn btn-primary  pull-left" type="submit" name="submit" >submit</button>-->
                            <!--<div id="error_msg"></div>-->
                            <button type="submit" id="submit_reply" class="login-required">submit</button>
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
