-- # Entidades
-- Bolos - Clientes - Comentarios - Pedidos

-- # Relacionamentos
-- Bolos - Comentarios
-- Bolos - Pedidos
-- Clientes - Comentarios
-- Clientes - Pedidos

-- # Tabelas
-- Bolo (id, nome, descricao, categoria, preco, imagem, ativo?)
-- Cliente (id, nome, email, senha, ativo?)
-- Comentario (id, texto, data, id_cliente, id_bolo, ativo?)
-- Pedido (id, data de entrega, id_bolo, id_cliente, ativo?)

CREATE TABLE BOLOS (
  	ID int NOT NULL AUTO_INCREMENT,
    nome varchar(255) NOT NULL,
    descricao varchar(255) NOT NULL,
    categoria varchar(255) NOT NULL,
    preco int NOT NULL,
  	imagem_url varchar(255) NOT NULL,
  	ativo boolean,
    PRIMARY KEY (ID)
  );
  
  CREATE TABLE CLIENTES (
  	ID int NOT NULL AUTO_INCREMENT,
    nome varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    senha varchar(255) NOT NULL,
  	ativo boolean,
    PRIMARY KEY (ID)
  );
  
  CREATE TABLE COMENTARIOS (
  	ID int NOT NULL AUTO_INCREMENT,
    texto varchar(255) NOT NULL,
    data_emissao date NOT NULL,
    id_cliente int NOT NULL,
    id_bolo int NOT NULL,
  	ativo boolean,
    PRIMARY KEY (ID),
    FOREIGN KEY (id_cliente) REFERENCES CLIENTES(ID),
    FOREIGN KEY (id_bolo) REFERENCES BOLOS(ID)
  );
  
  CREATE TABLE PEDIDOS (
  	ID int NOT NULL AUTO_INCREMENT,
    data_entrega date NOT NULL,
    id_cliente int NOT NULL,
    id_bolo int NOT NULL,
  	ativo boolean,
    PRIMARY KEY (ID),
    FOREIGN KEY (id_cliente) REFERENCES CLIENTES(ID),
    FOREIGN KEY (id_bolo) REFERENCES BOLOS(ID)
  );
  
  INSERT INTO BOLOS (
  	nome,
    descricao,
    categoria,
    preco,
    imagem_url,
    ativo
  ) VALUES (
  	'Bolo de aniversario ben 10',
  	'Bolo só o filé',
  	'Aniversário',
  	1000.00,
  	'URL',
  	true
  );
  
  INSERT INTO CLIENTES (
  	nome,
    email,
    senha,
    ativo
  ) VALUES (
  	'Cainã Gonçalves Silva',
  	'emaildocainan@email.com',
  	'senhadocainan',
  	true
  );
  
  INSERT INTO COMENTARIOS (
  	texto,
    data_emissao,
    id_cliente,
    id_bolo,
    ativo
  ) VALUES (
  	'Teste de Comentario',
  	'2022-10-19',
  	1,
  	1,
  	true
  );
  
  INSERT INTO PEDIDOS (
    data_entrega,
    id_cliente,
    id_bolo,
    ativo
  ) VALUES (
  	'2022-10-19',
  	1,
  	1,
  	true
  );

SELECT * FROM BOLOS;
SELECT * FROM CLIENTES;
SELECT CMT.texto, CMT.data_emissao, CLT.nome, BOL.nome FROM COMENTARIOS CMT
    INNER JOIN CLIENTES CLT ON CLT.ID = CMT.id_cliente
    INNER JOIN BOLOS BOL ON BOL.ID = CMT.id_bolo;
SELECT PDD.data_entrega, BOL.nome, CLT.nome, BOL.preco FROM PEDIDOS PDD
    INNER JOIN CLIENTES CLT ON CLT.ID = PDD.id_cliente
    INNER JOIN BOLOS BOL ON BOL.ID = PDD.id_bolo;