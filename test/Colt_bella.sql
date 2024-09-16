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
imagem_categria varchar(255) null,
principal bool default 0 not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categorias (nome_categoria, imagem_categria, principal)
VALUES
('Eletrônicos', 'eletronicos.jpg', 1),
('Roupas', 'roupas.jpg', 0),
('Alimentos', 'alimentos.jpg', 1);

DROP TABLE categorias;

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
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP, -- Nova coluna para registrar a data de cadastro
    CONSTRAINT fk_categoria_id FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


drop table produtos;

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
    cliente_id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    nome VARCHAR(255) NOT NULL,
    sobrenome VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    numero VARCHAR(10),
    sem_numero BOOLEAN DEFAULT FALSE,
    bairro VARCHAR(100) NOT NULL,
    complemento VARCHAR(255),
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



drop table clientes;

select * from clientes;
INSERT INTO clientes (nome, cpf, email, senha, endereco, numero, complemento, cep, telefone, foto_perfil) VALUES ('matheus', '03600717243', 'brandao.matheus.dev@gmail.com', '12345678', 'rua princesa isabel', '4762', 'cidade alta', '76935000', 69993576137, 'placeholder.jpg');


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
  
  CREATE TABLE `pedidos` (
  `pedido_id` int primary key auto_increment not NULL,
  `ticket_pedido` varchar(255) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `logradouro` varchar(120) NOT NULL,
  `num_casa` int(11) NOT NULL,
  `nome_bairro` varchar(180) NOT NULL,
  `num_cep` varchar(20) NOT NULL,
  `cidade` varchar(180) NOT NULL,
  `estado` varchar(180) NOT NULL,
  `pais` varchar(180) NOT NULL,
  `tipo_endereco` varchar(180) NOT NULL,
  `valor_frete` decimal(10,2) not null,
  `valor_total` decimal(10,2) NOT NULL,
  `forma_pagamento` enum('NÃO FINALIZADO','CARTAO','BOLETO','TRANSFERENCIA','NO LOCAL','CHEQUE','EM ESPECIE') NOT NULL DEFAULT 'NÃO FINALIZADO',
  `status_pagamento` enum('PENDENTE','CONCLUIDO','CANCELADO') NOT NULL DEFAULT 'PENDENTE',
  `data_pedido` datetime NOT NULL DEFAULT current_timestamp(),
  `codigo_rastreio` varchar(255) NOT NULL,
  `status_pedido` enum('PENDENTE','DESPACHADO','A CAMINHO','ENTREGUE','CANCELADO') DEFAULT 'PENDENTE',
  `observacao_pedido` tinytext DEFAULT NULL,
  `dt_entrega` varchar(255) DEFAULT NULL,
  `entregador` varchar(255) DEFAULT NULL,
  `hora_entrega` varchar(255) DEFAULT NULL,
  `assinatura` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

drop table pedidos;

CREATE TABLE `produto_pedido` (
  `item_id` int(11) NOT NULL,
  `pedido_id` int not null,
  `ticket_pedido` varchar(255) NOT NULL,
  `nome_produto` varchar(255) not null,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) DEFAULT NULL,
  `custo_produto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

drop table produto_pedido;

CREATE TABLE `cupom_desconto` (
	`cupom_id` int primary key auto_increment,
	`codigo` varchar(80) not null,
    `porcentagem` varchar(10) not null,
    `desconto` decimal(10,2) not null,
    `validade` date default null,
    `ativo` boolean default 1
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cupons_cliente` (
	`id` int primary key auto_increment,
    `cliente_id` int not null,
    `cupom_id` int not null,
    `codigo_cupom` varchar(80) not null,
    `validade` date default null,
    `ativo` boolean default null,
    `desconto` decimal(10,2) not null,
    `status` varchar(80) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;