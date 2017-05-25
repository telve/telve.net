<?php $this->load->helper('human_timingv2'); ?><!--Format the time-->

<?php echo $toggle_sidebar ?>

<div class="container-fluid">
		<div class="row-fluid">

				<?php echo $sidebar ?>
    		<div class="span8"><!-- style="background:#abb;"-->

		        <?php
								$item_counter = 0;
								foreach($topics as $topic):
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
		                                <div class="rank" style="margin-left:30px;">
		                                		<div>  <br /><?php echo $rank;?></div>
		                                </div>
		                                <div class="digg">

																		</div>
                            		</div>
                        		</div>

														<div class="middle">
																<?php if ($topic['subscribed']) {?>
																		<a href="javascript:void(0);" id="<?php echo $topic['topic'];?>" class="btn btn-small btn-danger" onclick="unsubscribe(this);" style="width:90px;">Abonelikten çık</a>
																<?php } else { ?>
																		<a href="javascript:void(0);" id="<?php echo $topic['topic'];?>" class="btn btn-small btn-success" onclick="subscribe(this);" style="width:90px;">Abone ol</a>
																<?php }?>
														</div>

		                        <div class="row-fluid">
		                            <div class="span8" style="margin-left: 15px;">

				                        		<div class="link-title"><strong><a class="link-title" href="<?php echo base_url("")."t/".$topic['topic']."/";?>"><?php echo "/t/".$topic['topic']; ?></a></strong></div>

		                                <div style="line-height: 14px;">
																				<?php if ($topic['description']) echo $topic['description'].'<br>';?>
		                                    <small class="details"><?php echo $topic['subscribers'];?> abone,&nbsp;&nbsp;<?php echo human_timingv2($topic['created']);?> bir konu</small>
		                                </div>

		                                <div>
		                                    <div class="link-actions">
																						<strong>
				                                        <a href="javascript:void(0)" onclick="report_topic('<?php echo $topic['topic'];?>')" class="login-required">şikayet<span class="glyphicon glyphicon-flag" style="font-size:12px;"></span></a>
				                                        &nbsp;&nbsp;
				                                        <a href="javascript:void(0)" onclick="share_topic(this)">paylaş<span class="glyphicon glyphicon-share" style="font-size:12px;"></span></a>
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

        				<?php echo $this->pagination->create_links(); ?>
    		</div>
