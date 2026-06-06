create table Jadwal_Bimbingan(
    id_jadwal DECIMAL PRIMARY KEY,
    id_dosen INTEGER,
    tanggal DATE,
    jam TIME,
    media VARCHAR(50),
    kuota INTEGER,
    status_jadwal VARCHAR(20),

    constraint fk_jadwal_bimbingan_dosen_pembimbing
    Foreign Key (id_dosen) REFERENCES Dosen_Pembimbing(id_dosen)
)