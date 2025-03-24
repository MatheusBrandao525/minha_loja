create database brandao_makers;
use brandao_makers;


create table usuarios 
(
id int primary key auto_increment,
nome varchar(255) not null,
email varchar(120) unique not null,
senha varchar(16) not null,
classe enum('user','admin','sup') not null default 'user',
foto varchar(255) null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

drop table usuarios;
insert into usuarios (nome, email, senha, classe) values ('Matheus', 'brandaomakers@gmail.com', '12345678', 'sup');
select * from usuarios;

create table categorias
(
categoria_id int not null primary key auto_increment,
nome_categoria varchar(255) not null,
imagem_categria varchar(255) null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SELECT * FROM CATEGORIAS;

insert into categorias (nome_categoria, imagem_categria) values('teste1','');

delete from categorias where categoria_id = 4;

CREATE TABLE subcategorias (
    subcategoria_id INT AUTO_INCREMENT PRIMARY KEY,
    nome_subcategoria VARCHAR(255) NOT NULL,
    categoria_id INT,
    imagem_subcategoria VARCHAR(255) NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id) ON DELETE CASCADE
);

select * from subcategorias;

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
    descricao TEXT NULL,
    categoria_id INT NULL,
    subcategoria_id INT NULL,
    unidade VARCHAR(10) NULL,
    id_grupo INT NULL,
    preco_venda_1 DECIMAL(10,2) NULL,
    preco_venda_2 DECIMAL(10,2) NULL,
    preco_venda_3 DECIMAL(10,2) NULL,
    preco_venda_4 DECIMAL(10,2) NULL,
    preco_venda_5 DECIMAL(10,2) NULL,
    preco_promocao DECIMAL(10,2) NULL,
    inicio_promocao DATETIME NULL,
    fim_promocao DATETIME NULL,
    CONSTRAINT fk_categoria_id FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id),
    CONSTRAINT fk_subcategoria_id FOREIGN KEY (subcategoria_id) REFERENCES subcategorias(subcategoria_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

select * from produtos;

CREATE TABLE produtos_tamanhos (
    tamanho_id INT PRIMARY KEY AUTO_INCREMENT,
    produto_id INT NOT NULL,
    tamanho VARCHAR(50) NOT NULL,
    CONSTRAINT fk_produto_tamanhos FOREIGN KEY (produto_id) REFERENCES produtos(produto_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

select * from produtos_tamanhos;

CREATE TABLE produtos_imagens (
    imagem_id INT PRIMARY KEY AUTO_INCREMENT,
    produto_id INT NOT NULL,
    imagem_url VARCHAR(255) NOT NULL,
    principal boolean,
    CONSTRAINT fk_produto_imagens FOREIGN KEY (produto_id) REFERENCES produtos(produto_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

drop table produtos_imagens;

select * from produtos_imagens;


            SELECT 
                p.produto_id AS produto_id, 
                p.nome, 
                p.codigo, 
                p.exibe_preco, 
                p.preco_custo, 
                p.preco_unitario, 
                p.modelos, 
                p.cor, 
                p.destaque, 
                p.descricao, 
                p.categoria_id, 
                GROUP_CONCAT(pi.imagem_url SEPARATOR ",") AS imagens 
            FROM 
                produtos AS p
            LEFT JOIN 
                produtos_imagens AS pi 
            ON 
                p.produto_id = pi.produto_id
            WHERE 
                p.destaque = 1
            GROUP BY 
                p.produto_id;

drop table produtos;

INSERT INTO produtos (nome, codigo, exibe_preco, preco_custo, preco_unitario, modelos, cor, destaque, descricao, categoria_id, unidade, id_grupo, preco_venda_1, preco_venda_2, preco_venda_3, preco_venda_4, preco_venda_5, preco_promocao, inicio_promocao, fim_promocao)
VALUES
('Produto 1', 'COD123', 1, 50.00, 100.00, 'Modelo A', 'Vermelho', 1, 'Descrição do Produto 1', 1, 'UN', 1, 95.00, 90.00, 85.00, 80.00, 75.00, 70.00, '2024-01-01 00:00:00', '2024-01-31 23:59:59'),
('Produto 2', 'COD124', 1, 40.00, 90.00, 'Modelo B', 'Azul', 0, 'Descrição do Produto 2', 5, 'UN', 2, 85.00, 80.00, 75.00, 70.00, 65.00, 60.00, '2024-02-01 00:00:00', '2024-02-28 23:59:59'),
('Produto 3', 'COD125', 1, 30.00, 80.00, 'Modelo C', 'Verde', 1, 'Descrição do Produto 3', 6, 'UN', 3, 75.00, 70.00, 65.00, 60.00, 55.00, 50.00, '2024-03-01 00:00:00', '2024-03-31 23:59:59'),
('Produto 4', 'COD126', 1, 20.00, 70.00, 'Modelo D', 'Amarelo', 0, 'Descrição do Produto 4', 1, 'UN', 4, 65.00, 60.00, 55.00, 50.00, 45.00, 40.00, '2024-04-01 00:00:00', '2024-04-30 23:59:59'),
('Produto 5', 'COD127', 1, 10.00, 60.00, 'Modelo E', 'Roxo', 1, 'Descrição do Produto 5', 3, 'UN', 5, 55.00, 50.00, 45.00, 40.00, 35.00, 30.00, '2024-05-01 00:00:00', '2024-05-31 23:59:59');



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
    tipo_pessoa VARCHAR(30) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    sobrenome VARCHAR(255) NOT NULL,
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
INSERT INTO topmotos.clientes (nome, cpf, email, senha, endereco, numero, complemento, cep, telefone, foto_perfil) VALUES ('matheus', '03600717243', 'brandao.matheus.dev@gmail.com', '12345678', 'rua princesa isabel', '4762', 'cidade alta', '76935000', 69993576137, 'placeholder.jpg');


/*  Tabela de carrinho antiga
CREATE TABLE `carrinho` (
  `id_carrinho` int(11) PRIMARY KEY auto_increment,
  `cupom_desconto` varchar (25) null,
  `usuario_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `frete` decimal(10,2) not null,
  `nome_produto` varchar(255) NOT NULL,
  `vlr_unitario` decimal(10,2) NOT NULL,
  `vlr_custo` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tamanho_modelo` varchar(50) null, -- Adicionando o campo para o tamanho do produto
  `data_adicao` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 */  


CREATE TABLE `carrinho` (
  `id_carrinho` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `cliente_id` INT(11) NOT NULL,
  `cupom_desconto` VARCHAR(25) NULL,
  `frete` DECIMAL(10,2) NULL,
  `data_adicao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `status_carrinho` ENUM('ABERTO','FINALIZADO') DEFAULT 'FINALIZADO',
  FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`cliente_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

  
  drop table carrinho;
  
  delete from carrinho where id_ = 3;
  
  select * from carrinho;
  
CREATE TABLE `produtos_carrinho` (
  `id_produto_carrinho` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `id_carrinho` INT(11) NOT NULL,
  `produto_id` INT(11) NOT NULL,
  `nome_produto` VARCHAR(255) NOT NULL,
  `vlr_unitario` DECIMAL(10,2) NOT NULL,
  `vlr_custo` DECIMAL(10,2) NOT NULL,
  `quantidade` INT(11) NOT NULL,
  `tamanho_modelo` VARCHAR(50) NULL,
  `cliente_id` INT(11) NOT NULL, -- Adicionado cliente_id
  FOREIGN KEY (`id_carrinho`) REFERENCES `carrinho`(`id_carrinho`) ON DELETE CASCADE,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos`(`produto_id`) ON DELETE CASCADE,
  FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`cliente_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


drop table produtos_carrinho;
  
select * from produtos_carrinho;
  
  SELECT 
                    c.produto_id, 
                    c.quantidade, 
                    c.nome_produto, 
                    c.vlr_unitario, 
                    pi.imagem_url 
                FROM 
                    carrinho AS c
                INNER JOIN 
                    produtos AS p ON c.produto_id = p.produto_id
                INNER JOIN 
                    produtos_imagens AS pi ON p.produto_id = pi.produto_id AND pi.principal = TRUE
                WHERE 
                    c.usuario_id = 1;