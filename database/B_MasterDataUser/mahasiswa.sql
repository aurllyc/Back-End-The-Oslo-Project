create table Mahasiswa(
    id_mahasiswa SERIAL PRIMARY KEY,
    id_user int NOT NULL,
    nim VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    prodi VARCHAR(100) NOT NULL,
    jurusan VARCHAR(100) NOT NULL,
    semester  int NOT NULL,
    ipk DECIMAL(3,2),
    alamat TEXT,
    foto_profil TEXT,
    status_magang VARCHAR(30),

    constraint fk_mahasiswa_user
    Foreign Key (id_user) REFERENCES users(id_user)
)