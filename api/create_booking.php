<?php

require "../config/database.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Data tidak valid"
    ]);
    exit;
}

$kode = "UTI-" . strtoupper(substr(md5(uniqid()), 0, 6));

$stmt = $conn->prepare("
    INSERT INTO peminjaman (
        kode,
        room_id,
        nama,
        identitas,
        kontak,
        unit,
        keperluan,
        tanggal,
        jam_mulai,
        jam_selesai
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssssssss",
    $kode,
    $data["roomId"],
    $data["nama"],
    $data["identitas"],
    $data["kontak"],
    $data["unit"],
    $data["keperluan"],
    $data["tanggal"],
    $data["jamMulai"],
    $data["jamSelesai"]
);

if ($stmt->execute()) {

    echo json_encode([
        "success" => true,
        "message" => "Peminjaman berhasil disimpan",
        "kode" => $kode
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => $stmt->error
    ]);
}