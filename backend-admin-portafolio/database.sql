CREATE DATABASE IF NOT EXISTS admin_portafolio;
USE admin_portafolio;

create table posts(
    id int(255) auto_increment not null,
    title varchar(255) not null,
    content text not null,
    created_at datetime default null,
    updated_at datetime default null,
    CONSTRAINT pk_posts PRIMARY KEY(id)
)ENGINE=InnoDb;