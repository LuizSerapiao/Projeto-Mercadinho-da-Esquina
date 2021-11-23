create DATABASE mercadinho;

create table funcionarios (
    id_funcionario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    endereco VARCHAR(50) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    email VARCHAR(50) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    admin TINYINT NOT NULL DEFAULT 0
);

create table produtos (
    id_produto INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    valor DECIMAL(5,2) NOT NULL,
    quantidade INT DEFAULT 0,
    quantidade_pedida INT DEFAULT 0
);

create table lista_compras (
    id_lista_compras INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_produto INT NOT NULL,
    quantidade INT DEFAULT 1
);

create table vendas (
    id_venda INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    valor DECIMAL(5,2) NOT NULL
);

create table produtos_vendidos (
    id_produtos_vendidos INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_venda INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT DEFAULT 1
);

create table fornecedores (
    id_fornecedor INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    telefone BIGINT(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    estado VARCHAR(50) DEFAULT NULL,
    cidade VARCHAR(50) DEFAULT NULL,
    endereço VARCHAR(50) DEFAULT NULL
);

create table devolucoes (
    id_devolucao INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_produto INT NOT NULL,
    id_venda INT NOT NULL,
    quantidade INT DEFAULT 1
);

create table produtos_fornecidos (
    id_produtos_fornecidos INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_fornecedor INT NOT NULL,
    id_produto INT NOT NULL,
    valor DECIMAL(5,2) NOT NULL
);

create table pedidos (
    id_pedido INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL,
    valor_total DECIMAL(5,2) NOT NULL,
    recebido TINYINT NOT NULL DEFAULT 0
);

INSERT INTO `funcionarios` (`id_funcionario`, `nome`, `endereco`,`telefone`, `email`, `usuario`, `senha`, `admin`) VALUES (NULL, 'gerente', 'endereco', '34998770098', 'ger@contato.com','admin', 'admin', '1');

INSERT INTO `produtos` (`id_produto`, `nome`, `valor`, `quantidade`, `quantidade_pedida`) VALUES (NULL, 'Nescau 700g', '15,00', '30', '0');
INSERT INTO `produtos` (`id_produto`, `nome`, `valor`, `quantidade`, `quantidade_pedida`) VALUES (NULL, 'Arroz Tipo 1 1kg', '5', '50', '0');
INSERT INTO `produtos` (`id_produto`, `nome`, `valor`, `quantidade`, `quantidade_pedida`) VALUES (NULL, 'Macarrão Instantâneo', '2', '25', '0');
INSERT INTO `produtos` (`id_produto`, `nome`, `valor`, `quantidade`, `quantidade_pedida`) VALUES (NULL, 'Café Tipuana Especial', '15.99', '10', '0');

INSERT INTO `fornecedores` (`id_fornecedor`, `nome`, `telefone`, `email`, `estado`, `cidade`, `endereço`) VALUES (NULL, 'Cafesal', '3512345678', 'Cafesal@ufla.com', 'Minas Gerais', 'Lavras', 'Ufla');
INSERT INTO `fornecedores` (`id_fornecedor`, `nome`, `telefone`, `email`, `estado`, `cidade`, `endereço`) VALUES (NULL, 'Rex', '3598765432', 'Rex@outlook.com', 'Minas Gerais', 'Lavras', 'Avenida Evaristo Gomes Guerra, 123');

INSERT INTO `produtos_fornecidos` (`id_produtos_fornecidos`, `id_fornecedor`, `id_produto`, `valor`) VALUES (NULL, '1', '1', '13.5');
INSERT INTO `produtos_fornecidos` (`id_produtos_fornecidos`, `id_fornecedor`, `id_produto`, `valor`) VALUES (NULL, '1', '4', '12.99');
INSERT INTO `produtos_fornecidos` (`id_produtos_fornecidos`, `id_fornecedor`, `id_produto`, `valor`) VALUES (NULL, '2', '2', '3.5');
INSERT INTO `produtos_fornecidos` (`id_produtos_fornecidos`, `id_fornecedor`, `id_produto`, `valor`) VALUES (NULL, '2', '3', '1.5');
