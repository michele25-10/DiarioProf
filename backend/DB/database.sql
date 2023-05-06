create database diario;
use diario

create table diario.corso(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
tipologia			varchar(1) not null,
id_quadrimestre 	INT UNSIGNED NOT null,
id_docente 			varchar(16) not null,
id_tutor			varchar(16),
materia 			varchar(30) not null,
data_inizio			date not null, 
data_fine			date not null, 
nome_corso			varchar(30) not null,
sede				varchar(30) not null
);

create table diario.incontro(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
id_corso			INT UNSIGNED NOT null,
data_inizio			datetime not null,
note				varchar(100) null,
id_aula int unsigned not null
);

create table diario.quadrimestre(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
data_inizio			date not null,
data_fine			date not null
);

create table diario.iscrizione(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
id_alunno			varchar(16) NOT null,
id_corso			INT unsigned not null,
numero_presenze		INT not null DEFAULT(0)
);

create table diario.presenze(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
id_incontro			INT unsigned not null, 
id_alunno			varchar(16) not null, 
status				int null
);

create table diario.alunno(
SIDI				varchar(20) null,
CF 					varchar(16) not null primary key,
nome				varchar (30) not null,
cognome				varchar(30) not null,
telefono			varchar(10) not null
);

create table diario.docente(
CF 					varchar(16) not null primary key,
nome				varchar (30) not null,
cognome				varchar(30) not null,
telefono			varchar(10) not null
);

create table diario.aula(
id		INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
nome 	varchar(100) not null,
nomeBreve	varchar(35) not null
);

alter table diario.corso add constraint fk_corso_quadrimestre foreign key (id_quadrimestre) references diario.quadrimestre(id);
alter table diario.corso add constraint fk_corso_docente foreign key (id_docente) references diario.docente(CF);

alter table diario.incontro add constraint fk_incontro_corso foreign key (id_corso) references diario.corso(id);

alter table diario.iscrizione add constraint fk_iscrizione_corso foreign key (id_corso) references diario.corso(id);
alter table diario.iscrizione add constraint fk_iscrizione_alunno foreign key (id_alunno) references diario.alunno(CF);

alter table diario.presenze add constraint fk_presenze_incontro foreign key (id_incontro) references diario.incontro(id);
alter table diario.presenze add constraint fk_presenze_alunni foreign key (id_alunno) references diario.alunno(CF);



alter table diario.incontro add constraint fk_incontro_aula foreign key (id_aula) references diario.aula(id);