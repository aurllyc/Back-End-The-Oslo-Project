# Authentication API

Dokumentasi kontrak API autentikasi Sistem Informasi Magang.

---

# Overview

Sistem memiliki 4 portal yang berdiri sendiri:

| Portal             | Role      |
| ------------------ | --------- |
| Mahasiswa          | mahasiswa |
| Dosen Pembimbing   | dosen     |
| Program Studi      | prodi     |
| Mitra / Perusahaan | mitra     |

Meskipun memiliki halaman login yang berbeda, seluruh portal menggunakan endpoint autentikasi yang sama.

---

# Login

Digunakan untuk autentikasi pengguna berdasarkan portal yang diakses.

## Endpoint

```http
POST /api/v1/auth/login
```

## Headers

```http
Content-Type: application/json
Accept: application/json
```

## Request Body

```json
{
  "email": "user@example.com",
  "password": "password123",
  "portal": "mahasiswa"
}
```

## Field Request

| Field    | Type   | Required | Description                |
| -------- | ------ | -------- | -------------------------- |
| email    | string | Ya       | Email pengguna             |
| password | string | Ya       | Password pengguna          |
| portal   | string | Ya       | Portal yang sedang diakses |

## Available Portal

| Portal    |
| --------- |
| mahasiswa |
| dosen     |
| prodi     |
| mitra     |

---

## Success Response

**HTTP Status:** `200 OK`

```json
{
  "status": "success",
  "message": "Login berhasil",
  "token": "1|token_rahasia",
  "user": {
    "id": 101,
    "name": "Budi Santoso",
    "email": "mahasiswa@magang.com",
    "role": "mahasiswa"
  }
}
```

### Response Fields

| Field      | Type    | Description                   |
| ---------- | ------- | ----------------------------- |
| token      | string  | Sanctum Personal Access Token |
| user.id    | integer | ID pengguna                   |
| user.name  | string  | Nama pengguna                 |
| user.email | string  | Email pengguna                |
| user.role  | string  | Role pengguna                 |

---

## Invalid Credential

Email atau password tidak valid.

**HTTP Status:** `401 Unauthorized`

```json
{
  "status": "error",
  "message": "Email atau password yang Anda masukkan salah."
}
```

---

## Invalid Portal Access

User berhasil ditemukan tetapi mencoba login melalui portal yang tidak sesuai.

Contoh:

* User role = dosen
* Portal = mahasiswa

**HTTP Status:** `403 Forbidden`

```json
{
  "status": "error",
  "message": "Anda tidak memiliki akses ke portal ini."
}
```

---

# Logout

Digunakan untuk mengakhiri sesi pengguna.

## Endpoint

```http
POST /api/v1/auth/logout
```

## Headers

```http
Authorization: Bearer {token}
Accept: application/json
```

## Request Body

Tidak ada.

---

## Success Response

**HTTP Status:** `200 OK`

```json
{
  "status": "success",
  "message": "Logout berhasil"
}
```

---

## Unauthenticated

Token tidak ditemukan atau tidak valid.

**HTTP Status:** `401 Unauthorized`

```json
{
  "status": "error",
  "message": "Unauthenticated."
}
```

---

# Authentication Flow

```text
Portal Login
     ↓
POST /api/v1/auth/login
     ↓
Validasi Email & Password
     ↓
Validasi Portal & Role
     ↓
Generate Sanctum Token
     ↓
Frontend Menyimpan Token
     ↓
Akses Endpoint Terproteksi
```

---

# Authorization Header

Semua endpoint yang membutuhkan autentikasi wajib mengirimkan header berikut:

```http
Authorization: Bearer {token}
```

---

# Portal Mapping

| Role      | Portal               |
| --------- | -------------------- |
| mahasiswa | Portal Mahasiswa     |
| dosen     | Portal Dosen         |
| prodi     | Portal Program Studi |
| mitra     | Portal Mitra         |

---

# Example Login Request

## Portal Mahasiswa

```json
{
  "email": "mahasiswa@magang.com",
  "password": "password123",
  "portal": "mahasiswa"
}
```

## Portal Dosen

```json
{
  "email": "dosen@magang.com",
  "password": "password123",
  "portal": "dosen"
}
```

## Portal Prodi

```json
{
  "email": "prodi@magang.com",
  "password": "password123",
  "portal": "prodi"
}
```

## Portal Mitra

```json
{
  "email": "mitra@magang.com",
  "password": "password123",
  "portal": "mitra"
}
```
