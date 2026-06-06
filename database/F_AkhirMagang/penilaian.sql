create table Penilaian(
    id_penilaian DECIMAL PRIMARY KEY,
    id_penempatan INTEGER,
    nilai_disiplin DECIMAL(5,2),
    nilai_teknis DECIMAL(5,2),
    nilai_komunikasi DECIMAL(5,2),
    nilai_akhir DECIMAL(5,2),
    catatan TEXT,

    constraint fk_penilaian_penempatan_magang
    Foreign Key (id_penempatan) REFERENCES Penempatan_Magang(id_penempatan)
)