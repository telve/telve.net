<?php

function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function analyze_url($url) {

    $description = NULL;
    $embed = NULL;

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
            $embed = '<img src="'.$url.'" style="max-height:315px;"/>';
            return [$url,$description,$embed];
        }
    }

    $parsed = parse_url($url);
    $segment = explode('/', $parsed['path']);
    if (!isset($segment[1])) {
        $segment[1] = '';
    }
    if (!isset($segment[2])) {
        $segment[2] = '';
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $curl_result = curl_exec($curl);
    curl_close($curl);

    $CI =& get_instance();
    $CI->load->library("simple_html_dom");
    $html = new Simple_html_dom();
    //$html->load_file($url);
    $html->load($curl_result);

    if ($html->find('meta[property=og:description]')) {
        $description = trim(str_replace(array('&#039;','&#39;'),"'",$html->find('meta[property=og:description]',0)->content));
    }

    if ( endsWith($parsed['host'],'youtube.com') || ($parsed['host'] == 'youtu.be') ) {

        preg_match("/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/", $url, $id);
        $embed = '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$id[7].'" frameborder="0" allowfullscreen></iframe>';

        return [$html->find('link[itemprop=thumbnailUrl]',0)->href,$description,$embed];
    }

    if ( endsWith($parsed['host'],'twitter.com') && ($segment[2] == 'status') ) {
        if (startsWith($parsed['host'],'mobile')) {
            $json = file_get_contents("https://publish.twitter.com/oembed?url=".'https://twitter.com/'.$segment[1].'/'.$segment[2].'/'.$segment[3]);
        } else {
            $json = file_get_contents("https://publish.twitter.com/oembed?url=".$url);
        }
        $obj = json_decode($json);
        $embed = $obj->html;
    }

    $fb_post_criteria = ['posts','activity','photo.php','photos','permalink.php','media','questions','notes'];
    if ( endsWith($parsed['host'],'facebook.com') && (!empty(array_intersect($segment, $fb_post_criteria))) ) {
        $json_url = "https://www.facebook.com/plugins/post/oembed.json/?url=".$url;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $json_url);
        curl_setopt($curl, CURLOPT_REFERER, $json_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
        $json = curl_exec($curl);
        curl_close($curl);
        $obj = json_decode($json);
        $embed = $obj->html;
        return ['https://www.facebook.com/images/fb_icon_325x325.png',$description,$embed];
    }

    $fb_video_criteria = ['videos','video.php'];
    if ( endsWith($parsed['host'],'facebook.com') && (!empty(array_intersect($segment, $fb_video_criteria))) ) {
        $json_url = "https://www.facebook.com/plugins/video/oembed.json/?url=".$url;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $json_url);
        curl_setopt($curl, CURLOPT_REFERER, $json_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
        $json = curl_exec($curl);
        curl_close($curl);
        $obj = json_decode($json);
        $embed = $obj->html;
        return ['https://www.facebook.com/images/fb_icon_325x325.png',$description,$embed];
    }

    if ( ( endsWith($parsed['host'],'instagram.com') || ($parsed['host'] == 'instagr.am') ) && ($segment[1] == 'p') ) {
        $json = file_get_contents("https://api.instagram.com/oembed?url=".$url);
        $obj = json_decode($json);
        $embed = $obj->html;
        $embed = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $embed);
    }

    if ($html->find('meta[property=og:image]')) {
        return [$html->find('meta[property=og:image]',0)->content,$description,$embed];
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
            $imageurl = $parsed['scheme'].'://'.$parsed['host'].'/'.$src;//get image absolute url
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
    return [$biggestImage,$description,$embed]; //return the biggest found image
    //return implode(" | ", $visited);
}

?>
