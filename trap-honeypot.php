<?php
// trap-honeypot.php
include 'block-check.php';
$ip = $_SERVER['REMOTE_ADDR'];
file_put_contents('honeypot_log.txt', "Bot detected: $ip\n", FILE_APPEND);

// Check if the IP is already blocked, otherwise add it
$blocked_ips = file('blocked_ips.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!in_array($ip, $blocked_ips)) {
    file_put_contents('blocked_ips.txt', "$ip\n", FILE_APPEND);
}

header('HTTP/1.1 403 Forbidden');
exit();
?>
