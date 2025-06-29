<?php

// Simple health check endpoint
header('Content-Type: application/json');

$health = [
    'status' => 'healthy',
    'timestamp' => date('Y-m-d H:i:s'),
    'version' => '1.0.0',
    'environment' => $_ENV['APP_ENV'] ?? 'production'
];

// Check if database is accessible
try {
    $dbPath = $_ENV['DB_DATABASE'] ?? '/var/www/html/database/database.sqlite';
    if (file_exists($dbPath)) {
        $health['database'] = 'connected';
    } else {
        $health['database'] = 'not_found';
        $health['status'] = 'warning';
    }
} catch (Exception $e) {
    $health['database'] = 'error';
    $health['status'] = 'unhealthy';
}

// Check if storage is writable
try {
    $storagePath = '/var/www/html/storage';
    if (is_writable($storagePath)) {
        $health['storage'] = 'writable';
    } else {
        $health['storage'] = 'not_writable';
        $health['status'] = 'warning';
    }
} catch (Exception $e) {
    $health['storage'] = 'error';
    $health['status'] = 'unhealthy';
}

http_response_code($health['status'] === 'healthy' ? 200 : 503);
echo json_encode($health, JSON_PRETTY_PRINT); 