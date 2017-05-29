<?php
    $this->load->helper('markdown');
    $Parsedown = new Parsedown();
    $this->load->helper('emoji');

    $url = "./wiki/markdown_rehberi.md";
    $read = fopen($url, 'r') or die('Failed to open the file!');
    $text = fread($read, 13000);
    fclose($read);
?>

<?php echo $toggle_sidebar ?>

<div class="container-fluid">
  <div class="row-fluid">

    <div id="right-content" class="span8">

        <div id="md"><?php echo emoji($Parsedown->text($text));?></div>

    </div>
