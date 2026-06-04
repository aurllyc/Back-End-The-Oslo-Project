# docs/api-contract/auth.md

# Authentication API

Dokumentasi kontrak API autentikasi Sistem Informasi Magang.

---

## Login

Digunakan oleh seluruh pengguna sistem:

* Mahasiswa
* Dosen Pembimbing
* Program Studi (Prodi)
* Mitra / Perusahaan

### Endpoint

```http
POST /api/v1/auth/login
```

### Headers

```http
Content-Type: application/json
```

### Request Body

```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

---

# Success Response

## Struktur Umum

```json
{
  "status": "success",
  "message": "Login berhasil",
  "token": "string",
  "user": {
    "id": 0,
    "name": "string",
    "email": "string",
    "roles": [],
    "permissions": []
  }
}
```

---

## Role: Mahasiswa

### Akun Simulasi

```text
Email    : mahasiswa@magang.com
Password : password123
```

### Response

**HTTP 200 OK**

```json
{
  "status": "success",
  "message": "Login berhasil",
  "token": "1|token_rahasia_mahasiswa_xyz",
  "user": {
    "id": 101,
    "name": "Budi Santoso",
    "email": "mahasiswa@magang.com",
    "nim": "20210001",
    "roles": [
      "mahasiswa"
    ],
    "permissions": [
      "view vacancies",
      "apply vacancy",
      "fill logbook",
      "view final report"
    ]
  }
}
```

---

## Role: Dosen Pembimbing

### Akun Simulasi

```text
Email    : dosen@magang.com
Password : password123
```

### Response

**HTTP 200 OK**

```json
{
  "status": "success",
  "message": "Login berhasil",
  "token": "2|token_rahasia_dosen_xyz",
  "user": {
    "id": 202,
    "name": "Dr. Irwan Kusuma, M.T.",
    "email": "dosen@magang.com",
    "nidn": "041234567",
    "roles": [
      "dosen_pembimbing"
    ],
    "permissions": [
      "view students",
      "verify logbook",
      "grade internship"
    ]
  }
}
```

---

## Role: Program Studi (Prodi)

### Akun Simulasi

```text
Email    : prodi@magang.com
Password : password123
```

### Response

**HTTP 200 OK**

```json
{
  "status": "success",
  "message": "Login berhasil",
  "token": "3|token_rahasia_prodi_xyz",
  "user": {
    "id": 303,
    "name": "Kaprodi Teknik Informatika",
    "email": "prodi@magang.com",
    "roles": [
      "prodi"
    ],
    "permissions": [
      "manage vacancies",
      "approve registration",
      "assign supervisor",
      "view reports"
    ]
  }
}
```

---

## Role: Mitra / Perusahaan

### Akun Simulasi

```text
Email    : mitra@magang.com
Password : password123
```

### Response

**HTTP 200 OK**

```json
{
  "status": "success",
  "message": "Login berhasil",
  "token": "4|token_rahasia_mitra_xyz",
  "user": {
    "id": 404,
    "name": "PT. Solusi Teknologi Indonesia",
    "email": "mitra@magang.com",
    "company_sector": "IT Consultant",
    "roles": [
      "mitra"
    ],
    "permissions": [
      "create vacancy",
      "review applicants",
      "grade student performance"
    ]
  }
}
```

---

# Error Response

## Email atau Password Salah

**HTTP 401 Unauthorized**

```json
{
  "status": "error",
  "message": "Email atau password yang Anda masukkan salah."
}
```

---

# Catatan Implementasi

## Frontend

Frontend wajib menyimpan:

```json
{
  "token": "Bearer Token",
  "user": {
    "id": 0,
    "name": "",
    "email": "",
    "roles": [],
    "permissions": []
  }
}
```

## Routing Berdasarkan Role

| Role             | Redirect               |
| ---------------- | ---------------------- |
| mahasiswa        | `/mahasiswa/dashboard` |
| dosen_pembimbing | `/dosen/dashboard`     |
| prodi            | `/prodi/dashboard`     |
| mitra            | `/mitra/dashboard`     |

## Authorization

Seluruh endpoint setelah login wajib mengirim header:

```http
Authorization: Bearer {token}
```
