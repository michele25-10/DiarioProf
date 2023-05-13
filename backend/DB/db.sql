create table corso(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
tipologia			varchar(1) not null,
id_quadrimestre 	INT UNSIGNED NOT null,
id_docente 			varchar(16),
id_tutor			varchar(16),
materia 			varchar(30) not null,
data_inizio			date not null, 
data_fine			date not null, 
nome_corso			varchar(30) not null,
sede				varchar(30) not null,
status 				int not null default(0)
);

create table incontro(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
id_corso			INT UNSIGNED NOT null,
data_inizio			datetime not null,
note				varchar(200) null,
id_aula int unsigned not null
);

create table quadrimestre(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
data_inizio			date not null,
data_fine			date not null
);

create table iscrizione(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
id_alunno			varchar(16) NOT null,
id_corso			INT unsigned not null,
numero_presenze		INT not null DEFAULT(0)
);

create table presenze(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
id_incontro			INT unsigned not null, 
id_alunno			varchar(16) not null, 
status				int null
);

create table alunno(
SIDI				varchar(20) null,
CF 					varchar(16) not null primary key,
nome				varchar (30) not null,
cognome				varchar(30) not null,
telefono			varchar(10) not null
);

create table docente(
CF 					varchar(16) not null primary key,
nome				varchar (30) not null,
cognome				varchar(30) not null,
telefono			varchar(10) not null
);

create table aula(
id		INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
nome 	varchar(100) not null,
nomeBreve	varchar(35) not null
);

alter table corso add constraint fk_corso_quadrimestre foreign key (id_quadrimestre) references quadrimestre(id);

alter table incontro add constraint fk_incontro_corso foreign key (id_corso) references corso(id);

alter table iscrizione add constraint fk_iscrizione_corso foreign key (id_corso) references corso(id);
alter table iscrizione add constraint fk_iscrizione_alunno foreign key (id_alunno) references alunno(CF);

alter table presenze add constraint fk_presenze_incontro foreign key (id_incontro) references incontro(id);
alter table presenze add constraint fk_presenze_alunni foreign key (id_alunno) references alunno(CF);

alter table incontro add constraint fk_incontro_aula foreign key (id_aula) references aula(id);