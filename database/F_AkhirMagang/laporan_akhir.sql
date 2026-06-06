create table Laporan_Akhir(
    id_laporan DECIMAL PRIMARY KEY,
    id_penempatan INTEGER,
    file_laporan TEXT,
    status_verifikasi VARCHAR(20),
    catatan TEXT,
    uploaded_at TIMESTAMP,

    constraint fk_laporan_akhir_penempatan_magang
    Foreign Key (id_penempatan) REFERENCES Penempatan_Magang(id_penempatan)
)