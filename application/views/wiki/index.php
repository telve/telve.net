<?php
	$this->load->helper('markdown');

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
				<p style="opacity:.6;"><i>Bu konu <?php echo human_timing($wiki_topic['created']);?> oluşturuldu</i></p>
			<?php } else { ?>
		    <div id="md"><?php echo markdown($text);?></div>
			<?php } ?>

		</div>
