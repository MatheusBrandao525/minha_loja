create database colt_bella;
use colt_bella;

create table usuarios 
(
id int primary key auto_increment,
nome varchar(255) not null,
email varchar(120) not null,
senha varchar(16) not null,
classe enum('user','admin','sup') not null default 'user',
foto varchar(255) null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

drop table usuarios;
insert into usuarios (nome, email, senha, classe) values ('Matheus', 'mafe123silva@gmail.com', '12345678', 'sup');
select * from usuarios;

create table categorias
(
categoria_id int not null primary key auto_increment,
nome_categoria varchar(255) not null,
imagem_categria varchar(255) null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categorias (nome_categoria, imagem_categria)
VALUES
('Eletrônicos', 'eletronicos.jpg'),
('Roupas', 'roupas.jpg'),
('Alimentos', 'alimentos.jpg');


SELECT * FROM CATEGORIAS;

delete from categorias where categoria_id = 4;

CREATE TABLE produtos
(
    produto_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NULL,
    codigo VARCHAR(255) NULL,
    exibe_preco BOOL DEFAULT 1,
    preco_custo DECIMAL(10,2) NULL,
    preco_unitario DECIMAL(10,2) NULL,
    modelos VARCHAR(255) NULL,
    cor VARCHAR(255) NULL,
    destaque BOOL DEFAULT 0,
    tamanhos VARCHAR(255) NULL,
    descricao TEXT NULL,
    imagem1 VARCHAR(255) NULL,
    imagem2 VARCHAR(255) NULL,
    imagem3 VARCHAR(255) NULL,
    categoria_id INT NULL,
    unidade VARCHAR(10) NULL,
    preco_venda_1 DECIMAL(10,2) NULL,
    preco_venda_2 DECIMAL(10,2) NULL,
    preco_promocao DECIMAL(10,2) NULL,
    inicio_promocao DATETIME NULL,
    fim_promocao DATETIME NULL,
    CONSTRAINT fk_categoria_id FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO produtos (nome, codigo, exibe_preco, preco_custo, preco_unitario, modelos, cor, destaque, tamanhos, descricao, imagem1, imagem2, imagem3, categoria_id, unidade, preco_venda_1, preco_venda_2, preco_promocao, inicio_promocao, fim_promocao)
VALUES
('Smartphone XYZ', 'XYZ123', 1, 500.00, 750.00, 'XYZ', 'Preto', 1, 'M', 'Smartphone de última geração com tela AMOLED.', 'smartphone1.jpg', 'smartphone2.jpg', 'smartphone3.jpg', 1, 'Un', 750.00, 800.00, 699.00, '2024-08-01 00:00:00', '2024-08-31 23:59:59'),
('Camiseta Polo', 'POLO123', 1, 20.00, 45.00, 'Polo', 'Branco', 1, 'G', 'Camiseta Polo de alta qualidade.', 'camiseta1.jpg', 'camiseta2.jpg', 'camiseta3.jpg', 2, 'Un', 45.00, 50.00, 39.00, '2024-08-01 00:00:00', '2024-08-15 23:59:59'),
('Arroz Integral', 'ARROZ123', 1, 2.00, 4.00, null, null, 0, null, 'Arroz integral orgânico.', 'arroz1.jpg', null, null, 3, 'Kg', 4.00, 5.00, 3.50, '2024-08-01 00:00:00', '2024-08-31 23:59:59');


select * FROM produtos;
SELECT * FROM produtos WHERE categoria_id = 1;
drop table produtos;


create table redes_sociais
(
id int primary key auto_increment,
nome varchar(255) not null,
link text
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

select * from redes_sociais;

CREATE TABLE clientes (
    cliente_id INT PRIMARY KEY AUTO_INCREMENT,
    cpf VARCHAR(11) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    numero VARCHAR(10) NULL,
    bairro VARCHAR(255) NOT NULL,
    complemento VARCHAR(255),
    cidade VARCHAR(255) NOT NULL,
    estado VARCHAR(255) NOT NULL,
    pais VARCHAR(255) NOT NULL,
    email VARCHAR(75) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto_perfil VARCHAR(255),
    UNIQUE (cpf),
    UNIQUE (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


drop table clientes;

select * from clientes;	
INSERT INTO clientes (nome, cpf, email, senha, endereco, numero, complemento, cep, telefone, bairro, cidade, estado, pais, foto_perfil) 
VALUES ('Matheus Brandão', '03600717243', 'brandao.matheus.dev@gmail.com', '12345678', 'Rua Princesa Isabel', '4762', 'Cidade Alta', '76935000', '69993576137', 'Centro', 'Porto Velho', 'RO', 'Brasil', 'placeholder.jpg');


CREATE TABLE `carrinho` (
  `id_carrinhocupom_desconto` int(11) PRIMARY KEY auto_increment,
  `usuario_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `frete` decimal(10,2) not null,
  `nome_produto` varchar(255) NOT NULL,
  `vlr_unitario` decimal(10,2) NOT NULL,
  `vlr_custo` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tamanho_modelo` varchar(50), -- Adicionando o campo para o tamanho do produto
  `data_adicao` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
  
  select * from carrinho;
  
  drop table carrinho;