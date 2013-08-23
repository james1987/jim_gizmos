<?php
    $args = array("how", "salt", "str_s", "hash_str");
    foreach ($args as $var) {
        ${$var} = Null;
        if (isset($_REQUEST[$var])) {
            if ("str_s" == $var) {
                ${$var} = explode(",",rtrim($_REQUEST[$var], ',')); // 避免 "xx,yy,zz," 这种提交；
                continue;
            }
            ${$var} = $_REQUEST[$var];
        }
    }

    switch ($how) {
        case 'gen_hash':
            $tmp_arr = array();
            $tmp_arr = array_merge($tmp_arr,array(crc32 => crc32($hash_str)));
            $tmp_arr = array_merge($tmp_arr,array(md5_16 => substr(md5($hash_str), 8, 16)));
            $tmp_arr = array_merge($tmp_arr,array(md5_32 => md5($hash_str)));
            $tmp_arr = array_merge($tmp_arr,array(sha1 => sha1($hash_str)));
            echo json_encode($tmp_arr);
            break;
        case 'md5':
            $tmp_arr = array();
            foreach($str_s as $str) {
                // $tmp_arr = array_merge($tmp_arr,array($str => eval("return $hash($str);")));
                $tmp_arr = array_merge($tmp_arr,array($str => md5($str)));
            }
            echo json_encode($tmp_arr);
            break;
        case 'sha1':
            $tmp_arr = array();
            foreach($str_s as $str) {
                $tmp_arr = array_merge($tmp_arr,array($str => sha1($str)));
            }
            echo json_encode($tmp_arr);
            break;
        case 'crc32':
            $tmp_arr = array();
            foreach($str_s as $str) {
                $tmp_arr = array_merge($tmp_arr,array($str => crc32($str)));
            }
            echo json_encode($tmp_arr);
            break;
        case 'crypt':
            $tmp_arr = array();
            foreach($str_s as $str) {
                $tmp_arr = array_merge($tmp_arr,array($str => crypt($str, $salt)));
            }
            echo json_encode($tmp_arr);
            break;
        case 'base64_en':
            $tmp_arr = array();
            foreach($str_s as $str) {
                $tmp_arr = array_merge($tmp_arr,array($str => base64_encode($str)));
            }
            echo json_encode($tmp_arr);
            break;
        case 'base64_de':
            $tmp_arr = array();
            foreach($str_s as $str) {
                $tmp_arr = array_merge($tmp_arr,array($str => base64_decode($str)));
            }
            echo json_encode($tmp_arr);
            break;
        case 'urlencode':
            $tmp_arr = array();
            foreach($str_s as $str) {
                $tmp_arr = array_merge($tmp_arr,array($str => urlencode($str)));
            }
            echo json_encode($tmp_arr);
            break;
        case 'urldecode':
            $tmp_arr = array();
            foreach($str_s as $str) {
                $tmp_arr = array_merge($tmp_arr,array($str => urldecode($str)));
            }
            echo json_encode($tmp_arr);
            break;
        default:
    }
?>
