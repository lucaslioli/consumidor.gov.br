DROP DATABASE IF EXISTS reclamacoes_consumidor;
CREATE DATABASE IF NOT EXISTS reclamacoes_consumidor;
USE reclamacoes_consumidor;

ALTER DATABASE reclamacoes_consumidor CHARSET = UTF8 COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS RECLAMACAO_DES(
	REGIAO CHAR(2) NOT NULL,
    UF CHAR(2) NOT NULL,
    CIDADE VARCHAR(255) NOT NULL,
    SEXO CHAR(1) NOT NULL,
    FAIXAETARIA VARCHAR(255) NOT NULL,
    ANOABERTURA SMALLINT NOT NULL,
    MESABERTURA TINYINT NOT NULL,
    DATAABERTURA CHAR(10) NOT NULL,
    DATARESPOSTA VARCHAR(10) NULL,
    DATAFINALIZACAO CHAR(10) NOT NULL,
    TEMPORESPOSTA TINYINT NULL,
    NOMEFANTASIA VARCHAR(255) NOT NULL,
	SEGMENTOMERCADO VARCHAR(255) NOT NULL,
    AREA VARCHAR(255) NOT NULL,
    ASSUNTO VARCHAR(255) NOT NULL,
    GRUPOPROBLEMA VARCHAR(255) NOT NULL,
    PROBLEMA VARCHAR(255) NOT NULL,
    COMOCOMPROU VARCHAR(255) NOT NULL,
    PROCUROUEMPRESA CHAR(1) NOT NULL,
    RESPONDIDA CHAR(1) NOT NULL,
    SITUACAO VARCHAR(255) NOT NULL,
    AVALIACAO VARCHAR(255) NOT NULL,
    NOTACONSUMIDOR TINYINT NULL
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS REGIAO(
		IDREGIAO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		NOME CHAR(2) NOT NULL
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS ESTADO(
		IDESTADO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		NOME CHAR(2) NOT NULL,
		IDREGIAO INT NOT NULL,
		FOREIGN KEY (IDREGIAO) REFERENCES REGIAO(IDREGIAO)
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS CIDADE(
		IDCIDADE INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		NOME VARCHAR(255) NOT NULL,
		IDESTADO INT NOT NULL,
		FOREIGN KEY (IDESTADO) REFERENCES ESTADO(IDESTADO)
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS CONSUMIDOR(
		IDCONSUMIDOR INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		SEXO CHAR(1) NOT NULL,
		FAIXAETARIA VARCHAR(255) NOT NULL,
		IDCIDADE INT NOT NULL,
		FOREIGN KEY (IDCIDADE) REFERENCES CIDADE(IDCIDADE)
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS SEGMENTO(
		IDSEGMENTO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		DESCRICAO VARCHAR(255) NOT NULL
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS EMPRESA(
		IDEMPRESA INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		NOMEFANTASIA VARCHAR(255) NOT NULL,
        IDSEGMENTO INT NOT NULL,
        FOREIGN KEY (IDSEGMENTO) REFERENCES SEGMENTO(IDSEGMENTO)
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS AREA(
		IDAREA INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		DESCRICAO VARCHAR(255) NOT NULL
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS GRUPO(
		IDGRUPO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		DESCRICAO VARCHAR(255) NOT NULL
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS PROBLEMA(
		IDPROBLEMA INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		DESCRICAO VARCHAR(255) NOT NULL,
		IDGRUPO INT NOT NULL,
		FOREIGN KEY	(IDGRUPO) REFERENCES GRUPO(IDGRUPO)
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS RECLAMACAO(
		IDRECLAMACAO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		IDCONSUMIDOR INT NOT NULL,
		ANO SMALLINT NOT NULL,
		MES TINYINT NOT NULL,
		DATAABERTURA CHAR(10) NOT NULL,
		DATARESPOSTA VARCHAR(255) NULL,
		DATAFINALIZACAO VARCHAR(255) NOT NULL,
		TEMPORESPOSTA TINYINT NULL,
		IDEMPRESA INT NOT NULL,
		IDAREA INT NOT NULL,
        ASSUNTO VARCHAR(255) NOT NULL,
		IDPROBLEMA INT NOT NULL,
		COMOCOMPROU VARCHAR(255) NOT NULL,
		PROCUROUEMPRESA CHAR(1) NOT NULL,
		RESPONDIDA CHAR(1) NOT NULL,
		SITUACAO VARCHAR(255) NOT NULL,
		AVALIACAO VARCHAR(255) NOT NULL,
		NOTACONSUMIDOR TINYINT NULL,
		FOREIGN KEY (IDCONSUMIDOR) REFERENCES CONSUMIDOR(IDCONSUMIDOR),
		FOREIGN KEY (IDEMPRESA) REFERENCES EMPRESA(IDEMPRESA),
        FOREIGN KEY (IDAREA) REFERENCES AREA(IDAREA),
		FOREIGN KEY (IDPROBLEMA) REFERENCES PROBLEMA(IDPROBLEMA)
) ENGINE = MyISAM;

ALTER DATABASE reclamacoes_consumidor CHARSET = utf8 COLLATE = utf8_general_ci;
