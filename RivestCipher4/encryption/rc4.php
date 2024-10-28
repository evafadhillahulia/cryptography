<?php
function rc4($data, $key) {
    $key = array_values(unpack('C*', $key));
    $data = array_values(unpack('C*', $data));
    $keyLength = count($key);
    $dataLength = count($data);

    $s = range(0, 255);
    $j = 0;

    // Key-scheduling algorithm (KSA)
    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $s[$i] + $key[$i % $keyLength]) % 256;
        [$s[$i], $s[$j]] = [$s[$j], $s[$i]];
    }

    // Pseudo-random generation algorithm (PRGA)
    $i = 0;
    $j = 0;
    $output = '';

    foreach ($data as $byte) {
        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        [$s[$i], $s[$j]] = [$s[$j], $s[$i]];
        $output .= chr($byte ^ $s[($s[$i] + $s[$j]) % 256]);
    }

    return $output; // Return hex for readability
}

// NOTE: process encryption if btn encrypt clicked
if (isset($_POST['btn-encrypt'])) {
    $plaintext = $_POST['plaintext'];
    $key = $_POST['key'];
    if ($plaintext != '' && $key != '') {
        $ciphertext = rc4($key, $plaintext);
        $encodedCipher = base64_encode($ciphertext);
    } else {
        $encodedCipher = 'Plaintext & Key is required';
    }
}
// NOTE: process decryption if btn decrypt clicked
if (isset($_POST['btn-decrypt'])) {
    $encodedCipher = $_POST['ciphertext'];
    $key = $_POST['key'];
    if ($encodedCipher != '' && $key != '') {
        $decrypted = rc4($key, base64_decode($encodedCipher));
    } else {
        $decrypted = 'Ciphertext & Key is required';
    }
}
// NOTE: reset value
if (isset($_POST['btn-reset'])) {
    $ciphertext = '';
}
