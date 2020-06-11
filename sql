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

);

alter table users_stena
	add email VARCHAR(30) not null;

create unique index users_stena_email_uindex
	on users_stena (email);

alter table users_stena
	add nickname VARCHAR(30) not null after login;

alter table comments_stena
	add comm_nickname VARCHAR(30) not null after comm_login;

alter table users_stena modify nickname varchar(30) default 'Anonymous';

alter table comments_stena
	add id_op int null after id;
