drop table planos;
drop table filmes;
drop table selos;
drop table pais;
drop table ator;
drop table genero;
drop table diretor;
drop table clientes;
drop table assistido;
drop table atorfilme;
drop table diretorfilme;
drop table generofilme;

create table planos (
    codigo integer not null,
    nome varchar(100) not null,
    primary key(codigo)
);

create table selos (
    codigo integer not null,
    nome varchar(100) not null,
    preco smallmoney not null, 
    primary key(codigo)
);

create table pais(
    codigo integer not null,
    nome varchar(50) not null,
    primary key (codigo)
);

create table genero (
    codigo integer not null,
    nome varchar(50) not null,
    primary key (codigo)    
);

create table ator (
    CPFCNPJ varchar(14) not null,
    nome varchar(50) not null,
    primary key (CPFCNPJ)
);

create table diretor(
    CPFCNPJ varchar(14) not null,
    nome varchar(50) not null,
    primary key (CPFCNPJ)
);

create table clientes (
    email varchar(100) not null,
    nome varchar(100) not null,
    plano integer,
    genero char(1) not null check (genero = 'F' or genero = 'M'),
    primary key (email)
);

create table filmes (
    codigo integer not null,
    nome varchar(100) not null,
    data datetime not null default current_timestamp check (data <= current_timestamp),
    pais integer not null,  
    estreia date not null,
    duracao integer not null check(duracao > 0),
    selo integer not null,
    foreign key (selo) references selos(codigo),
    foreign key (pais) references pais(codigo),
    primary key (codigo)
);

create table assistido (
    codigo integer not null,
    cliente integer not null,
    filme integer not null,
    data datetime not null default current_timestamp check (data <= current_timestamp),
    foreign key (cliente) references clientes(email),
    foreign key (filme) references filmes(codigo),
    primary key (codigo)
);

create table atorfilme (
    codigo integer not null,
    filme integer not null,
    ator integer not null,
    foreign key (filme) references filmes(codigo),
    foreign key (ator) references ator(CPFCNPJ),
    primary key (codigo)
);

create table diretorfilme (
    codigo integer not null,
    filme integer not null,
    diretor integer not null,
    foreign key (filme) references filmes(codigo),
    foreign key (diretor) references diretor(CPFCNPJ),
    primary key (codigo)
);

create table generofilme (
    codigo integer not null,
    genero integer not null,
    filme integer not null,
    foreign key (genero) references genero(codigo),
    foreign key (filme) references filmes(codigo),
    primary key (codigo)
);

insert into pais(codigo, nome) values
    (1, 'Brasil'),
    (2, 'Estados Unidos'),
    (3, 'Japão');

insert into planos (codigo, nome) values
    (1, 'Bronze'),
    (2, 'Prata'),
    (3, 'Ouro');

insert into selos (codigo, nome, preco) values
    (1, 'Bronze', 20.00),
    (2, 'Prata', 40.00),
    (3, 'Ouro', 55.00);

insert into genero (codigo, nome) values
    (1, 'Ação'),
    (2, 'Terror'),
    (3, 'Comédia'),
    (4, 'Aventura');

insert into ator (CPFCNPJ, nome) values
    (30835451003, 'Keanu Reeves'),
    (28609507025, 'Norman Reedus'),
    (98507569005, 'Will Smith'),
    (30139174079, 'Tom Holland');

insert into diretor (CPFCNPJ, nome) values
    (23774157090, 'Ruben Fleischer'),
    (23739621010, 'Steven Spielberg'),
    (28442205098, 'Andrei Tarkovski'),
    (31477520031, 'Quentin Tarantino');

insert into clientes (email, nome, plano, genero) values
    ('felipesantos@hotmail.com', 'Felipe Santos', 1, 'M'),
    ('luanagonçalvez@hotmail.com', 'Luana gonçalvez', 1, 'F'),
    ('rodrigopereira@hotmail.com', 'Rodrigo Pereira', 3, 'M'),
    ('gabriellima@hotmail.com', 'Gabriel Lima', 2, 'M'),
    ('manoelagodoy@hotmail.com', 'Manoela Godoy', 3, 'F'),
    ('joseabreu@hotmail.com', 'José Abreu', 1, 'M');

insert into filmes (nome, pais, estreia, duracao, selo) values
    ('Venom', 2, '2018', '140', 2),
    ('Venom 2', 2, '2021', '105', 3),
    ('Tropa de Elite',  1, '2007', '115', 1),
    ('One Piece Stampede', 3, '2019', '101', 2),
    ('O Exterminador do Futuro', 2, '1984', '107', 1);

insert into assistido (cliente, filme) values
    ('felipesantos@hotmail.com', 3),
    ('felipesantos@hotmail.com', 5),
    ('manoelagodoy@hotmail.com', 1), 
    ('manoelagodoy@hotmail.com', 2),
    ('manoelagodoy@hotmail.com', 3),
    ('manoelagodoy@hotmail.com', 5),
    ('joseabreu@hotmail.com', 5),
    ('gabriellima@hotmail.com', 3),
    ('gabriellima@hotmail.com', 4),
    ('rodrigopereira@hotmail.com', 5);

insert into diretorfilme (diretor, filme) values --Alguns valores não condizem com a realidade, são apenas exemplos
    (23774157090, 1),
    (23739621010, 1),
    (31477520031, 2),
    (31477520031, 3),
    (28442205098, 3),
    (28442205098, 4),
    (23774157090, 5);

insert into atorfilme (ator, filme) values
    (30835451003, 1),
    (28609507025, 1), 
    (30139174079, 1),
    (28609507025, 2),
    (30835451003, 3),
    (28609507025, 3), 
    (98507569005, 4),
    (30139174079, 4),
    (30835451003, 5);

insert into generofilme (genero, filme) values
    (1, 1),
    (1, 2),
    (1, 3),
    (4, 3),
    (2, 4),
    (3, 4),
    (2, 5);