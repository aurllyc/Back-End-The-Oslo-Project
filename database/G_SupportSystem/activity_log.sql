create table Activity_Log(
    id_log SERIAL PRIMARY KEY,
    id_user INTEGER,
    aktivitas text,
    waktu TIMESTAMP,

    constraint fk_avtivity_log_users
    Foreign Key (id_user) REFERENCES Users(id_user)
)