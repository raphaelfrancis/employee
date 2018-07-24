<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    function encrypt_data($data)
    {
        $string = trim($data);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $key ="abcd";
        $ciphertext_raw = openssl_encrypt($string, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
        return $ciphertext;
    }

    function decrypt_data($decryptdata)
    {
        $c = base64_decode($decryptdata);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $key ="abcd";
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        return $original_plaintext;
    }

