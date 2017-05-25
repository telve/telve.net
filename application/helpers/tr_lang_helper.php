<?php

// Türkçe Karakter Destekli strtoupper() Fonksiyonu
function tr_strtoupper($text)
{
    $search = array("ç","i","ı","ğ","ö","ş","ü");
    $replace = array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $text = str_replace($search, $replace, $text);
    $text = strtoupper($text);
    return $text;
}
