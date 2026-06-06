create table Lamaran_Magang(
    id_lamaran SERIAL PRIMARY KEY,
    id_mahasiswa INTEGER,
    id_lowongan INTEGER,
    tanggal_lamaran DATE,
    status_lamaran VARCHAR(30),
    catatan_mitra TEXT,

    constraint fk_lamaran_mahasiswa
    Foreign Key (id_mahasiswa) REFERENCES Mahasiswa(id_mahasiswa),
    constraint fk_lamaran_lowongan
    Foreign Key (id_lowongan) REFERENCES Lowongan_Magang(id_lowongan)

)