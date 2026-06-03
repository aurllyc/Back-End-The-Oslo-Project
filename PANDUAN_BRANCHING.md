## PANDUAN ALUR KERJA GIT 

1. ATURAN KOLABORASI
- Alur Satu Arah: Feature Branch -> development -> staging -> main. Jangan melakukan merge terbalik (misal dari main/staging mundur ke development).
- Merge Hanya di GitHub: Semua proses penggabungan kode dilakukan via Pull Request (PR) di web GitHub menggunakan tombol "Squash and Merge". Jangan lakukan "git merge" di terminal lokal.
- Satu Orang Satu Branch: Jangan koding bersamaan di branch development secara langsung.

2. LANGKAH PEMBUATAN FITUR BARU

Fase A: Di Laptop Lokal
Jalankan perintah ini di terminal setiap kali ingin membuat fitur baru:
  git checkout development
  git pull origin development
  git checkout -b feature/nama-fitur

Fase B: Mengunggah Kode ke GitHub
Setelah fitur selesai dibuat dan dites di lokal:
  git add -A
  git commit -m "feat: deskripsi fitur yang dibuat"
  git push origin feature/nama-fitur

Fase C: Penggabungan (Di Web GitHub)
1. Buka repositori proyek di browser GitHub.
2. Klik tombol "Compare & pull request" pada spanduk yang muncul.
3. Pastikan arah panah tujuan adalah: base: development <- compare: feature/nama-fitur
4. Minta anggota tim lain untuk memeriksa kodingan (code review).
5. Pada tombol hijau penggabungan, klik tanda panah kecil di sebelahnya, lalu pilih "Squash and merge". Opsi ini akan memeras banyak komit kecil menjadi 1 komit lurus di branch development.
6. Klik tombol "Delete branch" di GitHub setelah merge selesai.

Fase D: Sinkronisasi Ulang
Seluruh anggota tim wajib memperbarui laptop masing-masing sebelum membuat fitur baru berikutnya:
  git checkout development
  git pull origin development
  git branch -d feature/nama-fitur

3. ALUR LINGKUNGAN DEPLOYMENT

Menaikkan Kode ke Staging (UAT Server)
Buat Pull Request di GitHub dengan arah panah: base: staging <- compare: development (Gunakan Squash and Merge atau Standard Merge).

Menaikkan Kode ke Main (Production Live Server)
Setelah lolos uji coba di staging, buat Pull Request di GitHub dengan arah panah: base: main <- compare: staging.

4. JIKA TERJADI SALAH MERGE
Jika ada anggota tim yang salah melakukan merge sehingga grafik kembali berantakan, potong jalurnya dengan perintah ini di lokal Anda:
  git checkout development
  git reset --hard HASH_ID_SEBELUM_RUSAK
  git push origin development --force

Setelah ini dijalankan, anggota tim lainnya WAJIB mengetik perintah berikut di laptop masing-masing agar sinkron:
  git checkout development
  git fetch origin
  git reset --hard origin/development
