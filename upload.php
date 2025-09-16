<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['gifFile']) && $_FILES['gifFile']['error'] === 0) {
        $name = $_POST['name'];
        $fileTmp = $_FILES['gifFile']['tmp_name'];
        $fileName = basename($_FILES['gifFile']['name']);
        $targetDir = "gifs/";
        $targetFile = $targetDir . time() . "_" . $fileName;

        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if ($fileType != "gif") {
            die("<p style='color:red;'>❌ อนุญาตเฉพาะไฟล์ GIF เท่านั้น</p>");
        }

        if (move_uploaded_file($fileTmp, $targetFile)) {
            $stmt = $conn->prepare("INSERT INTO gifs (name, path) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $targetFile);
            if ($stmt->execute()) {
                echo "<div class='msg success'>✅ อัพโหลดสำเร็จ <a href='index.php'>กลับ</a></div>";
            } else {
                echo "<div class='msg error'>❌ Database error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='msg error'>❌ ไม่สามารถย้ายไฟล์ได้</div>";
        }
    } else {
        echo "<div class='msg error'>❌ ไม่พบไฟล์ หรือไฟล์มีปัญหา</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>อัพโหลด GIF</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: #333;
      text-align: center;
      padding: 40px;
    }
    h2 {
      color: white;
      margin-bottom: 20px;
    }
    form {
      background: white;
      padding: 25px;
      border-radius: 12px;
      max-width: 400px;
      margin: auto;
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }
    input[type="text"], input[type="file"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    input[type="submit"] {
      background: #667eea;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: 0.3s;
      width: 100%;
    }
    input[type="submit"]:hover {
      background: #5a67d8;
    }
    .msg {
      margin: 15px auto;
      padding: 12px;
      max-width: 400px;
      border-radius: 8px;
    }
    .success { background: #c6f6d5; color: #22543d; }
    .error { background: #fed7d7; color: #742a2a; }
    a { color: #764ba2; text-decoration: none; }
    a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <h2>📤 อัพโหลด GIF ใหม่ (ไฟล์ที่มีปัญหา)</h2>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <label>ชื่อคำศัพท์:</label>
    <input type="text" name="name" required>

    <label>เลือกไฟล์ GIF:</label>
    <input type="file" name="gifFile" accept="image/gif" required>

    <input type="submit" value="อัพโหลด">
  </form>
</body>
</html>
