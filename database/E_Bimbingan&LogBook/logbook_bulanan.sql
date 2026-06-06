create table LogBook_Bulanan(
    id_logbook_bulanan DECIMAL PRIMARY KEY,
    id_penempatan INTEGER,
    bulan VARCHAR(20),
    ringkasan_kegiatan TEXT,
    evaluasi TEXT,

    constraint fk_logbook_bulanan_penempatan
    Foreign Key (id_penempatan) REFERENCES Penempatan_Magang(id_penempatan)
)