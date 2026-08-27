<?php

require "../config/database.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("
    SELECT COUNT(*) AS total
    FROM peminjaman
    WHERE room_id = ?
      AND tanggal = ?
      AND status != 'Ditolak'
      AND jam_mulai < ?
      AND jam_selesai > ?
");

$stmt->bind_param(
    "ssss",
    $data["roomId"],
    $data["tanggal"],
    $data["jamSelesai"],
    $data["jamMulai"]
);

$stmt->execute();

$result = $stmt->get_result()->fetch_assoc();

echo json_encode([
    "conflict" => ((int)$result["total"] > 0)
]);