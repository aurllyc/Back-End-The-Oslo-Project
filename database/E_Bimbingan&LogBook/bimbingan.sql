create table Bimbingan(
    id_bimbingan DECIMAL PRIMARY KEY,
    id_jadwal integer,
    id_mahasiswa integer,
    konsultasi TEXT,
    solusi TEXT,
    catatan_dosen TEXT,

    constraint fk_bimbingan_jadwal_bimbingan
    Foreign Key (id_jadwal) REFERENCES Jadwal_Bimbingan(id_jadwal),
    constraint fk_bimbingan_mahasiswa
    Foreign Key (id_mahasiswa) REFERENCES Mahasiswa(id_mahasiswa)
)