create table Lowongan_Magang(
    id_lowongan SERIAL PRIMARY KEY,
    id_mitra INTEGER,
    judul varchar(30) not null,
    deskripsi TEXT,
    lokasi VARCHAR(150),
    kuota INTEGER,
    deadline DATE,
    status_lowongan varchar(20),
    created_at TIMESTAMP,

    constraint fk_lowongan_mitra
    Foreign Key (id_mitra) REFERENCES Mitra_Magang(id_mitra)
)