<?php

function telveflavor($text)
{

$emoji_dict = array(
    ":gülücük:" => "smile.png",
    ":gülmektenağla:" => "joy.png",
);

foreach ($emoji_dict as $emoji => $file) {
    $text = preg_replace('/'.$emoji.'/', '<img class="emoji" src="'.base_url("").'assets/img/emojis/'.$file.'" height="20" width="20" title="'.$emoji.'" alt="'.$emoji.'" align="absmiddle">', $text);
}

return $text;

}

?>
