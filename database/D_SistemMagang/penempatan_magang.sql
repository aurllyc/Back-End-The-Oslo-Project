create table Penempatan_Magang(
    id_penempatan SERIAL PRIMARY KEY,
    id_mahasiswa INTEGER,
    id_mitra INTEGER,
    id_dosen INTEGER,
    tanggal_mulai DATE,
    tanggal_selesai DATE,
    status_penempatan VARCHAR(30),

    constraint fk_penempatan_mahasiswa
    Foreign Key (id_mahasiswa) REFERENCES Mahasiswa(id_mahasiswa),
    constraint fk_penempatan_penempatan_mitra
    Foreign Key (id_mitra) REFERENCES Mitra_Magang(id_mitra),
    constraint fk_penempatan_dosen_pembimbing
    Foreign Key (id_dosen) REFERENCES Dosen_Pembimbing(id_dosen)
)