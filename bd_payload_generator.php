<?php

//offset encoding
define('BLV_L_OFFSET', 5);

//Encode data in the custom "blv_encode" format

function blv_encode($info) {
    $data = "";
    foreach ($info as $b => $v) {
        $l = strlen($v) + BLV_L_OFFSET; 
        $data .= pack("c1N1", $b, $l);  
        $data .= $v;                    
    }
    return $data;
}

// Command IDs 
$DATA          = 1;
$CMD           = 2;
$MARK          = 3;
$STATUS        = 4;
$ERROR         = 5;
$IP            = 6;
$PORT          = 7;
$REDIRECTURL   = 8;
$FORCEREDIRECT = 9;

// Define the payload values
$info = [
    $CMD => "CONNECT",       // Command: CONNECT, DISCONNECT, READ, FORWARD
    $IP => "127.0.0.1",      // Target IP 
    $PORT => "8080",         // Target port
    $MARK => "123",          // Arbitrary marker
];

// Encode the payload
$encoded = base64_encode(blv_encode($info));

// Output the payload
echo "Generated Payload: \n";
echo $encoded . "\n";

