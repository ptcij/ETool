<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author Faruk
 */
 
class Utility {
    
    function __construct() {
        
    }
    
    ///Utitilty functions
    function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 1)
            return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    function generateID($length) {
        $ID = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; $i++) {
            $ID .= $codeAlphabet[$this->crypto_rand_secure(0, $max)];
        }

        return $ID;
    }

    function data_filter($data, $conn) {
        // remove whitespaces from begining and end
        $data = trim($data);

        // apply stripslashes to pevent double escape if magic_quotes_gpc is enabled
        if (get_magic_quotes_gpc()) {
            $data = stripslashes($data);
        }
        // connection is required before using this function
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }
    
    function truncate($string, $length = 200, $append = "&hellip;") {
        $string = trim($string);

        if (strlen($string) > $length) {
            $string = wordwrap($string, $length);
            $string = explode("\n", $string, $length);
            $string = $string[0] . $append;
        }

        return $string;
    }
    
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            {$string = array_slice($string, 0, 1);}
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
