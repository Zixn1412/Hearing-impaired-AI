<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];

    // ดึง path ก่อนลบ
    $stmt = $conn->prepare("SELECT path FROM gifs WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($path);
    $stmt->fetch();
    $stmt->close();

    if (file_exists($path)) {
        unlink($path); // ลบไฟล์
    }

    $stmt = $conn->prepare("DELETE FROM gifs WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: manage.php");
exit;
