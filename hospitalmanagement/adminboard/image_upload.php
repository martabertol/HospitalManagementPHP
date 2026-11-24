<?php
function upload_image() {
    if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) return null;
    $file = $_FILES['image'];
    if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 5000000) throw new RuntimeException('Invalid image or file too large.');
    $types = ['image/jpeg'=>'jpg', 'image/png'=>'png', 'image/webp'=>'webp'];
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    if (!isset($types[$mime])) throw new RuntimeException('Choose a JPG, PNG or WEBP image.');
    $name = bin2hex(random_bytes(12)).'.'.$types[$mime];
    $path = '../image/doktori/'.$name;
    if (!move_uploaded_file($file['tmp_name'], __DIR__.'/../image/doktori/'.$name)) throw new RuntimeException('Upload failed.');
    return $path;
}
function remove_image($path) {
    if ($path && is_file(__DIR__.'/../image/doktori/'.basename($path))) unlink(__DIR__.'/../image/doktori/'.basename($path));
}
