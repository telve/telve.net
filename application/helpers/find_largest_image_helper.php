<?php

function find_largest_image($url) {

    $url_headers = get_headers($url, 1);
    if(isset($url_headers['Content-Type'])){

        $type = strtolower($url_headers['Content-Type']);

        $valid_image_type = array();
        $valid_image_type['image/png'] = '';
        $valid_image_type['image/jpg'] = '';
        $valid_image_type['image/jpeg'] = '';
        $valid_image_type['image/jpe'] = '';
        $valid_image_type['image/gif'] = '';
        $valid_image_type['image/tif'] = '';
        $valid_image_type['image/tiff'] = '';
        $valid_image_type['image/svg'] = '';
        $valid_image_type['image/ico'] = '';
        $valid_image_type['image/icon'] = '';
        $valid_image_type['image/x-icon'] = '';

        if(isset($valid_image_type[$type])){
            return $url;
        }
    }

    $CI =& get_instance();
    $CI->load->library("simple_html_dom");
    $html = new Simple_html_dom();
    $html->load_file($url);

    if ( (substr($url, 0, strlen('https://www.youtube.com/watch')) === 'https://www.youtube.com/watch') || (substr($url, 0, strlen('https://youtu.be/')) === 'https://youtu.be/') ) {
        return $html->find('link[itemprop=thumbnailUrl]',0)->href;
    }

    $biggestImage = ''; // Is returned when no images are found.
    $maxSize = 0;
    $visited = array();
    $getimagesize_counter = 0;
    foreach($html->find('img') as $element) {
        $src = $element->src;
        if($src=='')continue;// it happens on your test url
        if (strpos($src, '://') !== false) {
            $imageurl = $src;
        } elseif (substr( $src, 0, 2 ) === "//") {
            $imageurl = 'http:'.$src;
        } else {
            $parse = parse_url($url);
            $imageurl = $parse['scheme'].'://'.$parse['host'].'/'.$src;//get image absolute url
        }

        // ignore already seen images, add new images
        if(in_array($imageurl, $visited))continue;
        $visited[] = $imageurl;

        // get original size of first image occurrence without a width or a height attribute
        if ( ( empty($element->width) || empty($element->height) ) && !($getimagesize_counter > 0) ) {
            $image = @getimagesize($imageurl); // get the rest images width and height
            $getimagesize_counter++;
            if ( ($image[0] >= 70) && ($image[1] >= 70) ) {
                if ($image[0] > $maxSize) {
                    $maxSize = $image[0];
                    $biggestImage = $imageurl;
                } else if ($image[1] > $maxSize) {
                    $maxSize = $image[1];
                    $biggestImage = $imageurl;
                }
            } else {
                $getimagesize_counter--;
            }
        }

        if ( ($element->width >= 70) && ($element->height >= 70) ) {
            if ($element->width > $maxSize) {
                $maxSize = $element->width;  //compare sizes
                $biggestImage = $imageurl;
            } else if ($element->height > $maxSize) {
                $maxSize = $element->height;  //compare sizes
                $biggestImage = $imageurl;
            }
        }
    }
    return $biggestImage; //return the biggest found image
    //return implode(" | ", $visited);
}

?>
