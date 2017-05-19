<?php

function using_curl($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; U; Linux x86_64; tr-TR) AppleWebKit/531.2+ (KHTML, like Gecko) Version/5.0 Safari/531.2+");
    $curl_result = curl_exec($curl);
    curl_close($curl);
    return $curl_result;
}

function get_title($url)
{
    $parsed = parse_url($url);
    $segment = explode('/', $parsed['path']);

    if ($parsed['host'] == 'mobile.twitter.com') {
        $url = 'https://twitter.com/'.$parsed['path'];
    }

    $html = new Simple_html_dom();
    $html->load(using_curl($url));

    if ($html->find('meta[property=og:title]')) {
        $result = $html->find('meta[property=og:title]',0)->content;
    } else {
        $result = $html->find('title',0)->plaintext;
    }

    if (trim($result) == "Twitter") {
        $result = $html->find('div.dir-ltr',0)->plaintext;
    }

    $result = trim(str_replace(array('&#039;','&#39;'),"'",$result));
    $result = trim(str_replace(array('&quot;'),'"',$result));
    $result = trim(str_replace(array('&#10;'),' ',$result));
    #$result = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result);
    #$result = preg_replace('/[^\r\n\t\x20-\x7E\xA0-\xFF]/', '', $result);
    #$result = html_entity_decode($result);
    #$result = utf8_encode($result);
    return $result;
}

?>
