create table Notifikasi(
    id_notifikasi SERIAL PRIMARY KEY,
    id_user INTEGER,
    judul varchar(150),
    status_baca BOOLEAN,
    created_at TIMESTAMP,

    constraint fk_notifikasi_users
    Foreign Key (id_user) REFERENCES Users(id_user)
)