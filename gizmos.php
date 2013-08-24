<?php
    $base_char = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
        'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
        'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'G',
        'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
        '.', '/');
    function get_random_str($len) {
        global $base_char;
        $rand_str = "";
        for ($i=0; $i<$len; $i++) {
            $rand_str .= $base_char[mt_rand(0, count($base_char))];
        }
        return $rand_str;
    }

    $args = array("how", "str_s", "hash_str", "code_str", "crypt_method", "salt", "pswd_str");
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
        case 'encode':
            $tmp_arr = array();
            $tmp_arr = array_merge($tmp_arr,array(urlencode => urlencode($code_str)));
            $tmp_arr = array_merge($tmp_arr,array(base64en => base64_encode($code_str)));
            echo json_encode($tmp_arr);
            break;
        case 'decode':
            $tmp_arr = array();
            $tmp_arr = array_merge($tmp_arr,array(urldecode => urldecode($code_str)));
            $tmp_arr = array_merge($tmp_arr,array(base64de => base64_decode($code_str)));
            echo json_encode($tmp_arr);
            break;
        case 'crypt':
            $tmp_arr = array();
            if (0 == strlen($salt)) {
                $salt = get_random_str(8);
            }
            $salt .= '$';
            $tmp_arr = array_merge($tmp_arr,array(pswd => crypt($pswd_str, $crypt_method . $salt)));
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
        case 'crypt_s':
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
