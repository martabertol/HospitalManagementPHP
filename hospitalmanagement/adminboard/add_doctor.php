<?php
require 'auth.php';
include '../conn/conn.php';
include 'image_upload.php';
$error = '';
if (isset($_POST['add_doctor'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    try {
        if ($name === '' || $description === '') throw new RuntimeException('Fill in all fields.');
        $image = upload_image();
        if (!$image) throw new RuntimeException('Choose an image.');
        $stmt = $data->prepare('INSERT INTO doctor (name, description, image) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $name, $description, $image);
        $stmt->execute();
        header('Location: view_doctor.php'); exit;
    } catch (RuntimeException $e) { $error = $e->getMessage(); }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Hospital Management</title><link rel="stylesheet" href="admin.css"></head><body><?php include 'aside.php'; ?><div class="content"><h2>Add doctor</h2><p><?= htmlspecialchars($error) ?></p>
<form method="POST" enctype="multipart/form-data">
<label>Doctor name <input name="name" required></label><br>
<label>Doctor description <input name="description" required></label><br>
<label>Doctor image <input type="file" name="image" accept="image/jpeg,image/png,image/webp" required></label><br>
<input type="submit" name="add_doctor" value="Add doctor">
</form></div></body></html>