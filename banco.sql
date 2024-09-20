create database db_remake_travel;

use db_remake_travel;

SET SQL_SAFE_UPDATES=0;

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

create table tb_carousel (
cd_carousel int auto_increment primary key,
url_imagem_carousel varchar(100) not null,
ds_carousel varchar(120),
ic_active char(1) ,
st_carousel char(1) not null
);

insert into tb_carousel set
cd_carousel = '1',
ds_carousel = 'Teste',
url_imagem_carousel = 'cs_hawaii.jpg',
st_carousel = '1';

insert into tb_carousel set
cd_carousel = '2',
ds_carousel = 'Teste',
url_imagem_carousel = 'cs_caribe.jpg',
st_carousel = '1';

insert into tb_carousel set
cd_carousel = '3',
ds_carousel = 'Teste',
url_imagem_carousel = 'cs_maldiva.jpg',
st_carousel = '1';

insert into tb_carousel set
cd_carousel = '4',
ds_carousel = 'Teste',
url_imagem_carousel = 'cs_natal.jpg',
st_carousel = '1';

create table tb_pacote(
  cd_pacote int auto_increment primary key,
  nm_destino_pacote varchar(80) not null,
  ds_periodo varchar(80) not null,
  ds_acomodacao longtext not null,
  vl_pacote decimal(8,2) not null,
  qt_parcela_pacote int not null,
  url_imagem_pacote varchar(80) not null,
  st_pacote char(1) not null default "1",
  ic_active char(1)
);

insert into tb_pacote set
cd_pacote = '1',
nm_destino_pacote = 'Hawaii',
ds_periodo = '5 Dias e 4 Noites',
ds_acomodacao = 'hotel 4 estrelas, pensão completa',
vl_pacote = '150',
qt_parcela_pacote = '10',
url_imagem_pacote = 'd2391b17142da8c5ff9055acb4e0d4d5.png',
st_pacote = '1';

insert into tb_pacote set
cd_pacote = '2',
nm_destino_pacote = 'Maldivas',
ds_periodo = '5 Dias e 4 Noites',
ds_acomodacao = 'hotel 4 estrelas, pensão completa',
vl_pacote = '150',
qt_parcela_pacote = '10',
url_imagem_pacote = 'a7304763e574ddd936cba3779b42b479.png',
st_pacote = '1';

insert into tb_pacote set
cd_pacote = '3',
nm_destino_pacote = 'Caribe',
ds_periodo = '4 Dias e 3 Noites',
ds_acomodacao = 'hotel 5 estrelas, pensão completa',
vl_pacote = '150',
qt_parcela_pacote = '10',
url_imagem_pacote = '74cdc7a5cbd05d4b52c5410885a17636.png',
st_pacote = '1';

insert into tb_pacote set
cd_pacote = '4',
nm_destino_pacote = 'Natal',
ds_periodo = '3 Dias e 2 Noites',
ds_acomodacao = 'hotel 3 estrelas, pensão completa',
vl_pacote = '150',
qt_parcela_pacote = '10',
url_imagem_pacote = 'c9c8c08fd8b499b11a6b7acfd5f0517a.png',
st_pacote = '1';

create table tb_servico(
  cd_servico int auto_increment primary key,
  nm_servico varchar(60) not null,
  ds_servico longtext not null,
  url_imagem_servico varchar(100) not null
);

insert into tb_servico set
cd_servico = '1',
nm_servico = 'Café da Manhã',
ds_servico = 'Self Service All Incluse, incluso em todas as diárias.',
url_imagem_servico = '47de9dc4443220f0c3ccb0584105df6e.png';

insert into tb_servico set
cd_servico = '2',
nm_servico = 'Almoço',
ds_servico = 'Self Service All Incluse, incluso em todas as diárias.',
url_imagem_servico = '5df86e4a2b24ec3a4299c9a2059b8fb0.webp';

insert into tb_servico set
cd_servico = '3',
nm_servico = 'Jantar',
ds_servico = 'Self Service All Incluse, incluso em todas as diárias.',
url_imagem_servico = 'cc9752223316f10b4fa9810a07a49746.webp';

