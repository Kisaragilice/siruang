# SiRuang

SiRuang adalah aplikasi peminjaman ruangan berbasis web yang dibuat untuk memenuhi kebutuhan tugas/project perkuliahan.

Aplikasi ini menggunakan PHP native dan MariaDB sebagai database. Deployment dilakukan menggunakan Docker Compose pada server homelab.

---

## Daftar Isi

- [Tentang](#tentang)
- [Fitur](#fitur)
- [Tech Stack](#tech-stack)
- [Struktur Project](#struktur-project)
- [Arsitektur Deployment](#arsitektur-deployment)
- [Persyaratan](#persyaratan)
- [Deployment](#deployment)
- [Konfigurasi Database](#konfigurasi-database)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Update Aplikasi](#update-aplikasi)
- [Database Management](#database-management)
- [Backup dan Restore](#backup-dan-restore)
- [Troubleshooting](#troubleshooting)
- [Informasi Server](#informasi-server)

---

# Tentang

SiRuang merupakan aplikasi berbasis web untuk melakukan peminjaman ruangan.

Aplikasi menyediakan antarmuka untuk:

- Melihat daftar ruangan
- Melakukan peminjaman ruangan
- Mengecek konflik jadwal
- Melihat data peminjaman

Project ini awalnya dikembangkan dan dijalankan menggunakan PHP dan MariaDB pada lingkungan lokal, kemudian dideploy ke server homelab menggunakan Docker.

---

# Fitur

- Manajemen data ruangan
- Peminjaman ruangan
- Pengecekan konflik jadwal
- Penyimpanan data menggunakan MariaDB
- REST-like API sederhana menggunakan PHP
- Deployment menggunakan Docker Compose
- Database initialization menggunakan `database.sql`

---

# Tech Stack

## Application

- PHP 8.3
- Apache
- MySQLi

## Database

- MariaDB 12.3

## Infrastructure

- Arch Linux
- Docker
- Docker Compose

---

# Struktur Project

```text
siruang/
├── api/
│   ├── bookings.php
│   ├── check_conflict.php
│   ├── create_booking.php
│   └── rooms.php
│
├── config/
│   └── database.php
│
├── database.sql
├── index.php
├── Dockerfile
├── compose.yaml
└── README.md
