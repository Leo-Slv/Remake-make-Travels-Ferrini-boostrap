create database db_remake_travel;

use db_remake_travel;

create table tb_usuario (
cd_usuario int primary key auto_increment,
nm_usuario varchar(80) not null,
nm_email varchar(80) not null unique,
cd_senha varchar(128) not null,
dt_registro datetime not null default current_timestamp
);

insert into tb_usuario set
nm_usuario = 'Leonardo',
nm_email= 'leonardo@mail.com',
cd_senha = sha2('123',256);

select * from tb_usuario;