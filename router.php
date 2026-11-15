<?php

declare(strict_types=1);

$uriPath = (string) parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);

// Si la petición es un archivo estático existente en el proyecto (css, js, imágenes, etc.), sírvelo
if ($uriPath !== '/' && preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot|map)$/i', $uriPath)) {
    $file = __DIR__ . $uriPath;
    if (is_file($file)) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $mimeTypes = [
            'css' => 'text/css; charset=UTF-8',
            'js' => 'application/javascript; charset=UTF-8',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon',
        ];
        if (isset($mimeTypes[$ext])) {
            header('Content-Type: ' . $mimeTypes[$ext]);
        }
        readfile($file);
        exit;
    }
}

// Simular que la petición entró por /public/index.php para pasar el guardia de seguridad
$_SERVER['SCRIPT_NAME'] = '/public/index.php';
$_SERVER['REQUEST_URI'] = '/public' . $uriPath . (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '' ? '?' . $_SERVER['QUERY_STRING'] : '');

require __DIR__ . '/public/index.php';