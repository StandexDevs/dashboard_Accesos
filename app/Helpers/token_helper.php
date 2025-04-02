<?php

if (!function_exists('encriptarEvento')) {
    function encriptarEvento($id_evento) {
        return bin2hex(openssl_encrypt($id_evento, 'AES-128-ECB', CLAVE_ENCRIPTADO));
    }
    
}

if (!function_exists('desencriptarEvento')) {
    function desencriptarEvento($hash) {
        return openssl_decrypt(hex2bin($hash), 'AES-128-ECB', CLAVE_ENCRIPTADO);
    }
}

