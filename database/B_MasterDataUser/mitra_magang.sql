create table Mitra_Magang(
    id_mitra SERIAL primary key,
    id_user int not null,
    nama_perusahaan varchar(150) not null,
    alamat text,
    email_perusahaan varchar(100),
    no_telp varchar(20),
    deskripsi text,
    status_mitra varchar(20),

    constraint fk_perusahaan_user
    Foreign Key (id_user) REFERENCES users(id_user)

)