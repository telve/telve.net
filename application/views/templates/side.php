<div class="span3" style="float:right;margin-top:11px;">
    <div>
        <form action="<?php echo base_url("search");?>" method="get" accept-charset="utf-8" style="margin:0;">
            <?php if ( isset($search_query) ) { ?>
                <input name="q" type="text" class="span12" placeholder="Search" style="margin-bottom:20px;color:green;" value="<?php echo $search_query; ?>">
            <?php } else { ?>
                <input name="q" type="text" class="span12" placeholder="Search" style="margin-bottom:20px;">
            <?php } ?>
        </form>
    </div>

    <?php echo $login_form;?>

    <a class="btn btn-block btn-info login-required btn-blue" href="<?php echo base_url("submit");?>">Submit a new link</a>
    <br>
    <a class="btn btn-block btn-info login-required btn-blue" href="<?php echo base_url("submit")."?text=true";?>">Submit a new text post</a>
</div>
</div>
</div>
