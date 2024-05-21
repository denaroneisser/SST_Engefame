-- -----------------------------------------------------
-- Schema SST_Engefame
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS SST_Engefame;
USE SST_Engefame;

-- -----------------------------------------------------
-- Table `Categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Categorias (
  idCategoria INT UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome VARCHAR(45) NOT NULL,
  PRIMARY KEY (idCategoria)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Funcionarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Funcionarios (
  Nome VARCHAR(100) NOT NULL,
  CPF VARCHAR(14) NOT NULL,
  Situacao TINYINT NOT NULL,
  Categorias_idCategoria INT UNSIGNED NULL,
  PRIMARY KEY (CPF, Categorias_idCategoria),
  INDEX fk_Funcionarios_Categorias1_idx (Categorias_idCategoria),
  CONSTRAINT fk_Funcionarios_Categorias1
    FOREIGN KEY (Categorias_idCategoria)
    REFERENCES Categorias (idCategoria)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Treinamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Treinamentos (
  idTreinamento INT UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome VARCHAR(45) NOT NULL,
  Subtitulo VARCHAR(100) NOT NULL,
  Descricao VARCHAR(100) NOT NULL,
  PRIMARY KEY (idTreinamento)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Empresas (
  idEmpresa INT UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome VARCHAR(45) NULL,
  PRIMARY KEY (idEmpresa)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Turmas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Turmas (
  idTurma INT UNSIGNED NOT NULL AUTO_INCREMENT,
  Empresas_idEmpresa INT UNSIGNED NOT NULL,
  Treinamentos_idTreinamento INT UNSIGNED NOT NULL,
  Data_Realizacao DATE NOT NULL,
  Data_Validade DATE NOT NULL,
  Comprovacao TINYINT NOT NULL,
  Modalidade TINYINT NOT NULL,
  Carga_Horaria TIME NOT NULL,
  Preco_Unitario DECIMAL(10,2) NOT NULL,
  Curso_Pago TINYINT NOT NULL,
  Instrutor VARCHAR(45) NULL,
  PRIMARY KEY (idTurma, Empresas_idEmpresa, Treinamentos_idTreinamento),
  INDEX fk_Turmas_Treinamentos1_idx (Treinamentos_idTreinamento),
  INDEX fk_Turmas_Empresas1_idx (Empresas_idEmpresa),
  CONSTRAINT fk_Turmas_Treinamentos1
    FOREIGN KEY (Treinamentos_idTreinamento)
    REFERENCES Treinamentos (idTreinamento)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Turmas_Empresas1
    FOREIGN KEY (Empresas_idEmpresa)
    REFERENCES Empresas (idEmpresa)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Acompanhamento_Turmas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Acompanhamento_Turmas (
  idAcompanhamento INT UNSIGNED NOT NULL AUTO_INCREMENT,
  Data_Inclusao DATE NOT NULL,
  Data_Prazo DATE NULL,
  Descricao LONGTEXT NOT NULL,
  Turmas_idTurma INT UNSIGNED NOT NULL,
  Turmas_Empresas_idEmpresa INT UNSIGNED NOT NULL,
  Turmas_Treinamentos_idTreinamento INT UNSIGNED NOT NULL,
  PRIMARY KEY (idAcompanhamento),
  INDEX fk_Acompanhamento_Turmas_Turmas1_idx (Turmas_idTurma, Turmas_Empresas_idEmpresa, Turmas_Treinamentos_idTreinamento),
  CONSTRAINT fk_Acompanhamento_Turmas_Turmas1
    FOREIGN KEY (Turmas_idTurma, Turmas_Empresas_idEmpresa, Turmas_Treinamentos_idTreinamento)
    REFERENCES Turmas (idTurma, Empresas_idEmpresa, Treinamentos_idTreinamento)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Turmas_has_Funcionarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Turmas_has_Funcionarios (
  Turmas_idTurma INT UNSIGNED NOT NULL,
  Turmas_Empresas_idEmpresa INT UNSIGNED NOT NULL,
  Turmas_Treinamentos_idTreinamento INT UNSIGNED NOT NULL,
  Funcionarios_CPF VARCHAR(14) NOT NULL,
  Funcionarios_Categorias_idCategoria INT UNSIGNED NOT NULL,
  PRIMARY KEY (Turmas_idTurma, Turmas_Empresas_idEmpresa, Turmas_Treinamentos_idTreinamento, Funcionarios_CPF, Funcionarios_Categorias_idCategoria),
  INDEX fk_Turmas_has_Funcionarios_Funcionarios1_idx (Funcionarios_CPF, Funcionarios_Categorias_idCategoria),
  INDEX fk_Turmas_has_Funcionarios_Turmas1_idx (Turmas_idTurma, Turmas_Empresas_idEmpresa, Turmas_Treinamentos_idTreinamento),
  CONSTRAINT fk_Turmas_has_Funcionarios_Turmas1
    FOREIGN KEY (Turmas_idTurma, Turmas_Empresas_idEmpresa, Turmas_Treinamentos_idTreinamento)
    REFERENCES Turmas (idTurma, Empresas_idEmpresa, Treinamentos_idTreinamento)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Turmas_has_Funcionarios_Funcionarios1
    FOREIGN KEY (Funcionarios_CPF, Funcionarios_Categorias_idCategoria)
    REFERENCES Funcionarios (CPF, Categorias_idCategoria)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

