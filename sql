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
	comm_login VARCHAR(30) not null,
	comment VARCHAR(100) not null,
	time TIMESTAMP default CURRENT_TIME null,
	constraint comments_stena_pk
		primary key (id)
);

alter table comments_stena
	add constraint comments_stena_fk
		foreign key (comm_login) references users_stena (login)
			on update cascade;
