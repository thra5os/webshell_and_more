<?php

$key = "secret"; 
$data = "system|ls"; // raw payload

// Chiffrement avec OpenSSL
$encrypted = openssl_encrypt($data, "AES128", $key);

// Encodage Base64 pour transmission
echo base64_encode($encrypted);
?>

