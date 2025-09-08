<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('encrypt_url')) {
    function encrypt_url($string) {
        $secret_key = "Topomanager@2025"; // clé secrète
        $secret_iv  = "InitVector2025";   // vecteur d'initialisation

        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        return urlencode(base64_encode($output));
    }
}

if (!function_exists('decrypt_url')) {
    function decrypt_url($string) {
        $secret_key = "Topomanager@2025";
        $secret_iv  = "InitVector2025";

        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_decrypt(base64_decode(urldecode($string)), $encrypt_method, $key, 0, $iv);
        return $output;
    }
}
