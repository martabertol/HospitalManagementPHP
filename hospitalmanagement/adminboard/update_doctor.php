<?php
require 'auth.php';
include '../conn/conn.php';
include 'image_upload.php';
$id = (int)($_GET['doctor_id'] ?? 0);
$result = $data->query("SELECT * FROM doctor WHERE id=$id");
$info = $result->fetch_assoc();
if (!$info) { header('Location: view_doctor.php'); exit; }
$error = '';
if (isset($_POST['update_doctor'])) {
    $name = trim($_POST['name']); $description = trim($_POST['description']);
    try {
        if ($name === '' || $description === '') throw new RuntimeException('Fill in all fields.');
        $new = upload_image();
        $image = $new ?? $info['image'];
        $stmt = $data->prepare('UPDATE doctor SET name=?, description=?, image=? WHERE id=?');
        $stmt->bind_param('sssi', $name, $description, $image, $id);
        $stmt->execute();
        if ($new) remove_image($info['image']);
        header('Location: view_doctor.php'); exit;
    } catch (RuntimeException $e) { $error = $e->getMessage(); }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Hospital Management</title><link rel="stylesheet" href="admin.css"></head><body><?php include 'aside.php'; ?><div class="content"><h2>Edit doctor</h2><p><?= htmlspecialchars($error) ?></p><form method="POST" enctype="multipart/form-data">
<label>Doctor name <input name="name" value="<?= htmlspecialchars($info['name']) ?>" required></label><br>
<label>Doctor description <input name="description" value="<?= htmlspecialchars($info['description']) ?>" required></label><br>
Old image <img src="<?= htmlspecialchars($info['image']) ?>" width="200"><br>
<label>New image <input type="file" name="image" accept="image/jpeg,image/png,image/webp"></label><br>
<input type="submit" name="update_doctor" value="Save changes"></form></div></body></html>