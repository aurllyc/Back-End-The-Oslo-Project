create table Prodi (
    id_prodi SERIAL PRIMARY KEY,
    id_user int not null,
    nidn VARCHAR(30) UNIQUE NOT NULL,
    nama_prodi VARCHAR(100),
    fakultas VARCHAR(100),
    jabatan VARCHAR(100),

    constraint fk_prodi_user
    Foreign Key (id_user) REFERENCES users(id_user)
    
)