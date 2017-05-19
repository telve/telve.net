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
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
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
    $result = $html->find('title',0)->innertext;
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
