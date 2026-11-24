<?php
require 'auth.php';
include '../conn/conn.php';
include 'image_upload.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['doctor_id'] ?? 0);
    $info = $data->query("SELECT * FROM doctor WHERE id=$id")->fetch_assoc();
    if ($info && $data->query("DELETE FROM doctor WHERE id=$id")) remove_image($info['image']);
}
header('Location: view_doctor.php'); exit;
