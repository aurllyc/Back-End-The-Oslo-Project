create table LogBook_Harian(
    id_logbook_harian DECIMAL PRIMARY KEY,
    id_penempatan INTEGER,
    tanggal date,
    kegiatan TEXT,
    kendala TEXT,
    status_validasi VARCHAR(20),

    constraint fk_logbook_harian_penempatan
    Foreign Key (id_penempatan) REFERENCES Penempatan_Magang(id_penempatan)
)