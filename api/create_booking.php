<?php

require "../config/database.php";
require "../config/telegram.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Data tidak valid"
    ]);
    exit;
}


/*
|--------------------------------------------------------------------------
| 1. Buat kode peminjaman
|--------------------------------------------------------------------------
*/

$kode = "UTI-" . strtoupper(substr(md5(uniqid()), 0, 6));


/*
|--------------------------------------------------------------------------
| 2. Simpan peminjaman ke database
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| 3. Jalankan INSERT
|--------------------------------------------------------------------------
*/

if (!$stmt->execute()) {

    echo json_encode([
        "success" => false,
        "message" => $stmt->error
    ]);

    exit;
}


/*
|--------------------------------------------------------------------------
| 4. Ambil informasi ruangan
|--------------------------------------------------------------------------
*/

$roomStmt = $conn->prepare("
    SELECT nama, gedung, lantai
    FROM ruangan
    WHERE id = ?
");

$roomStmt->bind_param(
    "s",
    $data["roomId"]
);

$roomStmt->execute();

$room = $roomStmt->get_result()->fetch_assoc();


/*
|--------------------------------------------------------------------------
| 5. Buat pesan Telegram
|--------------------------------------------------------------------------
*/

$message = "
<b>PEMINJAMAN RUANGAN BARU</b>

<b>Kode:</b> <code>{$kode}</code>

<b>Ruangan</b>
{$room['nama']}
Gedung {$room['gedung']} - Lantai {$room['lantai']}

<b>Peminjam</b>
Nama: {$data['nama']}
Identitas: {$data['identitas']}
Kontak: {$data['kontak']}
Unit: {$data['unit']}

<b>Jadwal</b>
Tanggal: {$data['tanggal']}
Jam: {$data['jamMulai']} - {$data['jamSelesai']}

<b>Keperluan</b>
{$data['keperluan']}

<b>Status:</b> Menunggu
";


/*
|--------------------------------------------------------------------------
| 6. Kirim pesan Telegram
|--------------------------------------------------------------------------
*/

sendTelegramMessage($message);


/*
|--------------------------------------------------------------------------
| 7. Beri tahu JavaScript bahwa booking berhasil
|--------------------------------------------------------------------------
*/

echo json_encode([
    "success" => true,
    "message" => "Peminjaman berhasil disimpan",
    "kode" => $kode
]);
