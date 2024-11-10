<?php
// block-check.php - Include this at the top of your main PHP files

// Load blocked IP addresses from the file
$blocked_ips = file('blocked_ips.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$ip = $_SERVER['REMOTE_ADDR'];

// Check if the visitor's IP address is in the blocklist
if (in_array($ip, $blocked_ips)) {
    header('HTTP/1.1 403 Forbidden');
    exit('Access denied');
}
?>
