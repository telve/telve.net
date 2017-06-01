<?php
    $this->load->helper('markdown');
    $Parsedown = new Parsedown();
    $this->load->helper('telveflavor');

    $url = "./wiki/markdown_rehberi.md";
    $read = fopen($url, 'r') or die('Failed to open the file!');
    $text = fread($read, 20000);
    fclose($read);
?>

<?php echo $toggle_sidebar ?>

<div class="container-fluid">
  <div class="row-fluid">

    <div id="right-content" class="span8">

        <div id="md"><?php echo telveflavor($Parsedown->text($text));?></div>

    </div>
