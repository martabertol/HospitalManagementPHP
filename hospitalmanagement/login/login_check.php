<?php
session_start();
include '../conn/conn.php';
if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $stmt = $data->prepare("SELECT * FROM user WHERE username=? AND usertype='admin'");
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if ($row && password_verify($pass, $row['password'])) {
        session_regenerate_id(true);
        $_SESSION['username'] = $name;
        $_SESSION['usertype'] = 'admin';
        header('Location: ../adminboard/adminhome.php');
        exit;
    }
    $_SESSION['loginMessage'] = 'Username ili password ne odgovaraju';
}
header('Location: login.php');
exit;
