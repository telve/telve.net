<?php
    $this->load->helper('markdown');
    $Parsedown = new Parsedown();
    $this->load->helper('telveflavor');

    $url = "./wiki/wiki.md";
    $read = fopen($url,'r') or die('Failed to open the file!');
    $text = fread($read,4096);
    fclose($read);
?>

<?php echo $toggle_sidebar ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php echo $sidebar ?>

        <div id="right-content" class="span8">
            <?php if ($this->uri->segment(1) == 't') { ?>
                <h1><?php echo $wiki_topic['name'];?></h1>
                <p><?php echo $wiki_topic['description'];?></p>
                <p><b>Toplam abone sayısı:</b> <?php echo $wiki_topic['subscribers'];?></p>
                <p style="color:#888;">Bu konu <a href="<?php echo base_url('').'kullanici/'.$wiki_topic['username'].'/';?>"><?php echo $wiki_topic['username'];?></a> tarafından <?php echo human_timing($wiki_topic['created']);?> oluşturuldu</p>
            <?php } else { ?>
                <div id="md"><?php echo telveflavor($Parsedown->text($text));?></div>
            <?php } ?>
        </div>
