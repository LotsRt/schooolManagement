<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('generate_token')) {
    function generate_token($id) {
        $secret = "SchoolManager@2025"; // mets une clé longue et secrète
        return hash_hmac('sha256', $id, $secret);
    }
}

if (!function_exists('verify_token')) {
    function verify_token($id, $token) {
        $secret = "SchoolManager@2025";
        $check = hash_hmac('sha256', $id, $secret);
        return hash_equals($check, $token); // comparaison sécurisée
    }
}
