<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

    function remove_get_param($param)
    {
        $param_name = strstr($param, '=', true);
        parse_str($_SERVER['QUERY_STRING'], $params);
        unset($params[$param_name]);
        $query = http_build_query($params);
        if ($query) {
            return '?'.$query;
        } else {
            return '';
        }
    }

    function append_get_param($param)
    {
        if ($_SERVER['QUERY_STRING']) {
            $query = remove_get_param($param);
            if ($query) {
                return $query.'&'.$param;
            } else {
                return '?'.$param;
            }
        } else {
            return '?'.$param;
        }
    }
