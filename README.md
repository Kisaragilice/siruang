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
````

---

# Arsitektur Deployment

Project dijalankan menggunakan dua container Docker:

```text
                    Client
                      │
                      │ HTTP :8080
                      ▼
              ┌─────────────────┐
              │  siruang-app    │
              │                 │
              │ PHP 8.3         │
              │ Apache          │
              └────────┬────────┘
                       │
                       │ Docker Network
                       │
                       ▼
              ┌─────────────────┐
              │   siruang-db    │
              │                 │
              │ MariaDB 12.3    │
              │                 │
              │ Database:       │
              │ siruang         │
              └─────────────────┘
```

Database tidak diekspos langsung ke jaringan LAN.

Aplikasi PHP mengakses database melalui hostname Docker:

```text
db
```

---

# Persyaratan

Server membutuhkan:

* Linux
* Docker
* Docker Compose
* Git

Untuk deployment saat ini digunakan:

```text
OS      : Arch Linux
Docker  : Docker Engine
Database: MariaDB 12.3
PHP     : 8.3
```

---

# Deployment

## 1. Clone Repository

Clone repository ke server:

```bash
git clone https://github.com/Kisaragilice/siruang.git
cd siruang
```

Jika repository sudah tersedia:

```bash
cd ~/siruang
git pull
```

---

## 2. Konfigurasi Database

File:

```text
config/database.php
```

digunakan oleh aplikasi untuk melakukan koneksi ke database.

Konfigurasi container menggunakan:

```text
Host     : db
Database : siruang
Username : siruang
Password : password_siruang
```

Hostname database menggunakan:

```text
db
```

karena `db` merupakan nama service MariaDB pada Docker Compose.

---

## 3. Build dan Jalankan Container

Jalankan:

```bash
docker compose up -d --build
```

Perintah tersebut akan:

1. Build image aplikasi PHP
2. Download image MariaDB jika belum tersedia
3. Membuat network Docker
4. Membuat volume database
5. Menjalankan MariaDB
6. Melakukan initialization database
7. Menjalankan aplikasi PHP

---

# Database Initialization

Pada first deployment, file:

```text
database.sql
```

akan otomatis dijalankan oleh MariaDB.

Konfigurasi tersebut terdapat pada:

```yaml
volumes:
  - ./database.sql:/docker-entrypoint-initdb.d/database.sql:ro
```

Database hanya akan diinisialisasi secara otomatis ketika volume database masih kosong.

Jika container dibuat ulang tanpa menghapus volume, data database tetap dipertahankan.

---

# Menjalankan Aplikasi

Cek status container:

```bash
docker compose ps
```

Status yang diharapkan:

```text
siruang-app   Up
siruang-db    Up (healthy)
```

Aplikasi dapat diakses melalui:

```text
http://SERVER_IP:8080
```

Contoh:

```text
http://192.168.1.45:8080
```

---

# Menghentikan Aplikasi

Untuk menghentikan container:

```bash
docker compose stop
```

Untuk menjalankan kembali:

```bash
docker compose start
```

---

# Restart Aplikasi

```bash
docker compose restart
```

---

# Update Aplikasi

Setelah perubahan di repository:

```bash
git pull
```

Kemudian rebuild:

```bash
docker compose up -d --build
```

Cek status:

```bash
docker compose ps
```

---

# Database Management

## Melihat Database

```bash
docker exec -it siruang-db \
mariadb -u siruang -ppassword_siruang siruang
```

---

## Melihat Tabel

```bash
docker exec -it siruang-db \
mariadb -u siruang -ppassword_siruang siruang \
-e "SHOW TABLES;"
```

---

## Melihat Data Peminjaman

```bash
docker exec -it siruang-db \
mariadb -u siruang -ppassword_siruang siruang \
-e "SELECT * FROM peminjaman;"
```

---

## Menghapus Satu Data Peminjaman

Contoh:

```bash
docker exec -it siruang-db \
mariadb -u siruang -ppassword_siruang siruang \
-e "DELETE FROM peminjaman WHERE id = 3;"
```

---

## Mengosongkan Tabel Peminjaman

```bash
docker exec -it siruang-db \
mariadb -u siruang -ppassword_siruang siruang \
-e "TRUNCATE TABLE peminjaman;"
```

> Perintah ini akan menghapus seluruh data dari tabel `peminjaman`.

---

# Backup dan Restore

## Backup Database

Backup database ke file:

```bash
docker exec siruang-db \
mariadb-dump -u siruang -ppassword_siruang siruang \
> backup.sql
```

---

## Restore Database

Untuk restore database:

```bash
cat backup.sql | docker exec -i siruang-db \
mariadb -u siruang -ppassword_siruang siruang
```

---

# Persistent Storage

Database menggunakan Docker named volume:

```text
siruang_siruang_mysql
```

Volume digunakan untuk menyimpan data MariaDB sehingga data tidak hilang ketika container dihapus atau dibuat ulang.

Melihat volume:

```bash
docker volume ls
```

Informasi volume:

```bash
docker volume inspect siruang_siruang_mysql
```

> Jangan menjalankan `docker compose down -v` sembarangan karena opsi `-v` akan menghapus volume database.

---

# Troubleshooting

## Melihat Log Aplikasi

```bash
docker compose logs app
```

Atau:

```bash
docker compose logs app --tail=100
```

---

## Melihat Log Database

```bash
docker compose logs db
```

Atau:

```bash
docker compose logs db --tail=100
```

---

## Container Database Unhealthy

Cek:

```bash
docker compose ps
```

Kemudian:

```bash
docker inspect siruang-db --format '{{json .State.Health}}'
```

Pastikan healthcheck menggunakan:

```text
mariadb-admin
```

dan bukan:

```text
mysqladmin
```

---

## Mengecek Koneksi Database

```bash
docker exec -it siruang-db \
mariadb -u siruang -ppassword_siruang siruang \
-e "SELECT 1;"
```

Jika berhasil:

```text
+---+
| 1 |
+---+
| 1 |
+---+
```

berarti MariaDB dapat diakses.

---

## Mengecek PHP MySQLi

```bash
docker exec -it siruang-app php -m | grep mysqli
```

Output yang diharapkan:

```text
mysqli
```

---

# Keamanan

Beberapa hal yang perlu diperhatikan:

* Jangan memasukkan password production ke repository publik.
* Jangan memasukkan SSH private key ke repository.
* Jangan memasukkan API key atau secret ke Git.
* Database MariaDB tidak diekspos ke port host.
* Gunakan firewall pada server.
* Lakukan backup database secara berkala.

Untuk deployment tugas kampus, konfigurasi database saat ini menggunakan credential sederhana yang terdapat pada Docker Compose.

Untuk deployment production, credential sebaiknya dipindahkan ke `.env` dan tidak di-commit ke repository.

---

# Informasi Server

Server deployment:

```text
Hostname : server
OS       : Arch Linux
CPU      : x86-64
RAM      : 8 GB
Storage  : ~465 GB
LAN IP   : 192.168.1.45
```

Application:

```text
Port     : 8080
Protocol : HTTP
```

Database:

```text
Engine   : MariaDB
Version  : 12.3
Database : siruang
Port     : 3306
Exposure : Docker internal network
```

---

# Docker Services

| Service     | Container     |            Port | Keterangan   |
| ----------- | ------------- | --------------: | ------------ |
| Application | `siruang-app` |          `8080` | PHP + Apache |
| Database    | `siruang-db`  | Internal `3306` | MariaDB      |

---

# Useful Commands

### Status

```bash
docker compose ps
```

### Start

```bash
docker compose up -d
```

### Stop

```bash
docker compose stop
```

### Restart

```bash
docker compose restart
```

### Rebuild

```bash
docker compose up -d --build
```

### Logs

```bash
docker compose logs -f
```

### Shutdown

```bash
docker compose down
```

> Jangan gunakan `docker compose down -v` kecuali memang ingin menghapus database.

---

# License

Project ini dibuat untuk kebutuhan tugas/project perkuliahan.

```

### Satu catatan penting

Saya tidak akan memasukkan informasi service homelab lain seperti WordPress, Crafty, Cloudflared, atau Tailscale ke README SiRuang. Itu bukan bagian dari deployment project ini.

Dan untuk dokumentasi GitHub, saya juga sengaja tidak memasukkan IP Tailscale maupun detail internal server yang tidak diperlukan. README cukup mendokumentasikan hal yang dibutuhkan orang lain untuk memahami dan menjalankan SiRuang.

Satu hal yang saya sarankan untuk langkah berikutnya: ubah password database dari hardcoded `compose.yaml`/`database.php` ke `.env`. Untuk tugas kampus sekarang memang tidak wajib, tetapi itu akan membuat repository kamu jauh lebih proper tanpa mengubah arsitektur deployment.
```
