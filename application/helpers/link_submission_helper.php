<?php

function analyze_url($url) {

    $description = NULL;

    $url_headers = get_headers($url, 1);
    if( isset($url_headers['Content-Type']) && !is_array($url_headers['Content-Type']) ){

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
            return [$url,NULL];
        }
    }

    $CI =& get_instance();
    $CI->load->library("simple_html_dom");
    $html = new Simple_html_dom();
    $html->load_file($url);

    if ($html->find('meta[property=og:description]')) {
        $description = trim(str_replace(array('&#039;','&#39;'),"'",$html->find('meta[property=og:description]',0)->content));
    }

    if ( (substr($url, 0, strlen('https://www.youtube.com/watch')) === 'https://www.youtube.com/watch') || (substr($url, 0, strlen('https://youtu.be/')) === 'https://youtu.be/') ) {
        return [$html->find('link[itemprop=thumbnailUrl]',0)->href,$description];
    }

    if ($html->find('meta[property=og:image]')) {
        return [$html->find('meta[property=og:image]',0)->content,$description];
    }

    $biggestImage = ''; // Is returned when no images are found.
    $maxSize = 0;
    $visited = array();
    $getimagesize_counter = 0;
    $min_edge_length = 200;
    foreach($html->find('img') as $element) {
        //echo "\nNEW IMAGE:\n";
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
            //echo "Running getimagesize without looking to DOM."."\n";
            $image = @getimagesize($imageurl); // get the rest images width and height
            //echo print_r($image)."\n";
            $getimagesize_counter++;
            if ( ($image[0] >= $min_edge_length) && ($image[1] >= $min_edge_length) ) {
                if ($image[0] > $maxSize) {
                    $maxSize = $image[0];
                    $biggestImage = $imageurl;
                } else if ($image[1] > $maxSize) {
                    $maxSize = $image[1];
                    $biggestImage = $imageurl;
                }
                //echo "Found by DIRECTLY getimagesize."."\n";
            } else {
                $getimagesize_counter--;
            }
        }

        //echo $element->width."\n";
        //echo $element->height."\n";
        if ( ($element->width >= $min_edge_length) && ($element->height >= $min_edge_length) ) {
            if ( ($element->width > $maxSize) || ($element->height > $maxSize) ) {
                //echo "Found by DOM. Checking by getimagesize..."."\n";
                if ( ($element->width > $maxSize) || ($element->height > $maxSize) ) {
                    $image = @getimagesize($imageurl); // get the rest images width and height
                    //echo print_r($image)."\n";
                    if ( ($image[0] >= $min_edge_length) && ($image[1] >= $min_edge_length) ) {
                        if ($image[0] > $maxSize) {
                            $maxSize = $element->width;
                            $biggestImage = $imageurl;
                        } else if ($image[1] > $maxSize) {
                            $maxSize = $element->height;
                            $biggestImage = $imageurl;
                        }
                        $getimagesize_counter++;
                        //echo "DOM properties were correct."."\n";
                    } else {
                        //echo "DOM properties were wrong."."\n";
                    }
                }
            }
        }
        //echo "STATE: ".$biggestImage."\n";
        //echo "MAXSIZE: ".$maxSize."\n";
        //echo "COUNTER: ".$getimagesize_counter."\n";
    }
    return [$biggestImage,$description]; //return the biggest found image
    //return implode(" | ", $visited);
}

?>
