<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>จัดการ GIF</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #74ebd5, #9face6);
      text-align: center;
      padding: 30px;
      color: #333;
    }
    h1 {
      font-size: 2rem;
      margin-bottom: 20px;
    }
    form {
      margin-bottom: 40px;
      background: #fff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
      display: inline-block;
    }
    input[type="text"], input[type="file"] {
      padding: 10px;
      margin: 5px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    button {
      padding: 10px 20px;
      margin-top: 10px;
      font-size: 16px;
      border: none;
      border-radius: 25px;
      background: #4CAF50;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #45a049;
      transform: scale(1.05);
    }
    hr {
      margin: 40px auto;
      border: none;
      height: 2px;
      background: #ddd;
      width: 60%;
    }
    h2 {
      margin-bottom: 20px;
      font-size: 1.5rem;
    }
    .gif-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }
    .gif-item {
      background: #fff;
      padding: 15px;
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
      width: 180px;
      text-align: center;
      transition: 0.3s;
    }
    .gif-item:hover {
      transform: translateY(-5px);
    }
    .gif-item img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 10px;
    }
    .gif-item p {
      margin: 5px 0;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>🛠️ จัดการ GIF</h1>

  <!-- ฟอร์มเพิ่ม GIF -->
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="ชื่อ GIF" required>
    <input type="file" name="gif" accept="image/gif" required>
    <br>
    <button type="submit">➕ เพิ่ม GIF</button>
  </form>

  <hr>

  <!-- แสดง GIF ทั้งหมด -->
  <h2>📂 รายการ GIF</h2>
  <div class="gif-grid">
    <?php
    $result = $conn->query("SELECT * FROM gifs ORDER BY id DESC");
    while ($row = $result->fetch_assoc()):
    ?>
      <div class="gif-item">
        <img src="<?= $row['path'] ?>" alt="<?= $row['name'] ?>">
        <p><?= htmlspecialchars($row['name']) ?></p>
        <form action="delete.php" method="post">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button type="submit">🗑️ ลบ</button>
        </form>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
