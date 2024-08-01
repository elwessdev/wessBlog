<?php
use ImageKit\ImageKit;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable( __DIR__ . '/../../');
$dotenv->load();

function uploadImage($file) {
    $imageKit = new ImageKit(
        $_ENV['IMAGEKIT_API_KEY'],
        $_ENV['IMAGEKIT_AUTH'],
        $_ENV['IMAGEKIT_API_SECRET']
    );
    $result="";
    try {
        $uploadFile = $imageKit->uploadFile([
            'file' => fopen($file, 'r'), // Open file in read mode
            'fileName' => basename($file) // File name with folder
        ]);
        // print_r($uploadFile);
        $result = $uploadFile->result->url;
    } catch (Exception $e) {
        // $result = 'Upload error: ' . $e->getMessage();
        $result="";
    }
    return $result;
}