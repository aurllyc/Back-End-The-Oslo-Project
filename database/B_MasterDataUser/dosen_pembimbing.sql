create table Dosen_Pembimbing(
    id_dosen SERIAL PRIMARY KEY,
    id_user int NOT NULL,
    nidn varchar(30) UNIQUE NOT NULL,
    nama varchar(100) not NULL,
    bidang_keahlian varchar(100) not null,
    no_hp VARCHAR(20),
    status_aktif BOOLEAN DEFAULT false,

    constraint fk_dosen_pembimbing_user
    Foreign Key (id_user) REFERENCES users(id_user)
)