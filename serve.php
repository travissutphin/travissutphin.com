<?php
/**
 * Local Development Server Script
 * Run: php serve.php [port]
 * Default port: 8080
 */

$port = $argv[1] ?? '8080';
$host = 'localhost:' . $port;
$docroot = __DIR__ . '/public';

echo "Starting PHP development server on http://$host\n";
echo "Document root: $docroot\n";
echo "Press Ctrl+C to stop the server\n\n";

// Start the built-in PHP server
exec("php -S $host -t \"$docroot\"");