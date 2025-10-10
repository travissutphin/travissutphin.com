<?php
/**
 * Railway Health Check Endpoint
 * Simple endpoint that returns 200 OK for health checks
 */

header('Content-Type: text/plain');
http_response_code(200);

echo "OK\n";
echo "Server Time: " . date('Y-m-d H:i:s') . "\n";
echo "PHP Version: " . PHP_VERSION . "\n";
