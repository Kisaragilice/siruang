<?php

require "../config/database.php";

$sql = "SELECT * FROM ruangan ORDER BY gedung, lantai, nama";

$result = $conn->query($sql);

$rooms = [];

while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

header("Content-Type: application/json");

echo json_encode($rooms);