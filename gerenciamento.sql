-- Sistema de Gerenciamento de Estoque

-- Data: 24/03/2026
-- Banco de dados: gerenciamento




create table categorias(
id int auto_increment primary key,
nome varchar(100) not null
);

create table usuarios(
id int auto_increment primary key,
nome varchar(40) not null,
email varchar(60) not null unique,
senha varchar(255) not null
);


create table produtos(
id int auto_increment primary key,
nome varchar(200) not null,
preco decimal(10,2) not null,
quantidade int default 0,
fabricacao date,
id_categoria int,
created_at timestamp default current_timestamp,
foreign key (id_categoria) references categorias(id)
);


create table movimentacoes(
id int auto_increment primary key,
id_usuario int,
id_produto int,
data timestamp default current_timestamp,
quantidade int not null,
tipo enum('entrada', 'saida') not null,
foreign key (id_usuario) references usuarios(id),
foreign key (id_produto) references produtos(id)
);

select produtos.nome, produtos.preco, produtos.quantidade, categorias.nome as categoria
from produtos
join categorias on produtos.id_categoria = categorias.id;


















