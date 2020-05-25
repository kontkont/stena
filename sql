create table users_stena
(
	id int auto_increment,
	login VARCHAR(30) not null,
	password VARCHAR(30) not null,
	constraint users_stena_pk
		primary key (id)
);

create unique index users_stena_login_uindex
	on users_stena (login);

create table comments_stena
(
	id int auto_increment,
	comment VARCHAR(100) not null,
	constraint comments_stena_pk
		primary key (id)
);