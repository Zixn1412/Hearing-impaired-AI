<?php
include 'db.php';

header('Content-Type: application/json; charset=utf-8');

if (isset($_GET['text'])) {
    $text = $_GET['text'];
    $stmt = $conn->prepare("SELECT * FROM gifs WHERE name = ? LIMIT 1");
    $stmt->bind_param("s", $text);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode([ "found" => true, "name" => $row['name'], "path" => $row['path'] ]);
    } else {
        echo json_encode([ "found" => false ]);
    }

    $stmt->close();
}
$conn->close();
?>