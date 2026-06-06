create Table users(
    id_user SERIAL PRIMARY KEY,
    id_role int NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    status_akun VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    constraint fk_users_role
    Foreign Key (id_role) REFERENCES roles(id_role)
    on update CASCADE
    on delete RESTRICT

)