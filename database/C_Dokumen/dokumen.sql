create table Dokumen(
    id_dokumen SERIAL PRIMARY KEY,
    id_user INTEGER not null,
    jenis_dokumen VARCHAR(50),
    file_path TEXT,
    status_verifikasi varchar(20),
    catatan TEXT,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    constraint fk_dokumen_user
    Foreign Key (id_user) REFERENCES users(id_user)
)