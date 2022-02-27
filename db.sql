drop database if exists Tickets;
create database Tickets;
use Tickets;

create table Credenciales(
    usr nvarchar(64) not null primary key,
    psw nvarchar(64) not null	
);

create table Token(
    idToken int not null primary key auto_increment,
    token varchar(512) not null,
    estado bit not null, 
    usuario nvarchar(64) not null,
    foreign key (usuario) references Credenciales(usr) on delete cascade on update cascade
);

create table Evento(
    idEvento int not null primary key auto_increment,
    nombre varchar(128) not null,
    inmueble varchar(128) not null,
    estado varchar(128) not null,
    pais varchar(128) not null,
    fechaInicio varchar(64) not null,
    fechaTermino varchar(64) not null
);

create table Ticket(
    idTicket int not null primary key,
    idEvento int not null,
    horario varchar(64) not null,
    costo float(32) not null,
    foreign key (idEvento) references Evento(idEvento) on delete cascade on update cascade
);