<?php

require "../config/database.php";

$sql = "
    SELECT
        p.id,
        p.kode,
        p.room_id,
        r.nama AS room_name,
        r.gedung,
        r.lantai,
        p.nama,
        p.identitas,
        p.kontak,
        p.unit,
        p.keperluan,
        p.tanggal,
        p.jam_mulai,
        p.jam_selesai,
        p.status,
        p.created_at
    FROM peminjaman p
    JOIN ruangan r ON p.room_id = r.id
    ORDER BY p.tanggal ASC, p.jam_mulai ASC
";

$result = $conn->query($sql);

$bookings = [];

while ($row = $result->fetch_assoc()) {

    $bookings[] = [
        "id" => $row["kode"],
        "roomId" => $row["room_id"],
        "tanggal" => $row["tanggal"],
        "jamMulai" => substr($row["jam_mulai"], 0, 5),
        "jamSelesai" => substr($row["jam_selesai"], 0, 5),
        "nama" => $row["nama"],
        "identitas" => $row["identitas"],
        "kontak" => $row["kontak"],
        "unit" => $row["unit"],
        "keperluan" => $row["keperluan"],
        "status" => $row["status"]
    ];
}

header("Content-Type: application/json");

echo json_encode($bookings);