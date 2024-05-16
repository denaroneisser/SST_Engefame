CREATE SCHEMA IF NOT EXISTS `SST_Engefame` DEFAULT CHARACTER SET utf8 ;
USE `SST_Engefame` ;

CREATE TABLE IF NOT EXISTS `SST_Engefame`.`Categorias` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `SST_Engefame`.`Funcionarios` (
  `Nome` VARCHAR(100) NOT NULL,
  `CPF` VARCHAR(14) NOT NULL,
  `Situacao` TINYINT NOT NULL,
  `Categorias_idCategoria` INT NULL,
  PRIMARY KEY (`CPF`, `Categorias_idCategoria`),
  INDEX `fk_Funcionarios_Categorias1_idx` (`Categorias_idCategoria`),
  CONSTRAINT `fk_Funcionarios_Categorias1`
    FOREIGN KEY (`Categorias_idCategoria`)
    REFERENCES `SST_Engefame`.`Categorias` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `SST_Engefame`.`Treinamentos` (
  `idTreinamento` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(100) NOT NULL,
  `Empresa_Fornecedora` VARCHAR(45) NOT NULL,
  `Descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTreinamento`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `SST_Engefame`.`Historico_Treinamentos` (
  `idHistorico_treinamento` INT NOT NULL AUTO_INCREMENT,
  `Data_Realizacao` DATE NOT NULL,
  `Data_Validade` DATE NOT NULL,
  `Comprovacao` TINYINT NOT NULL,
  `Modalidade` TINYINT NOT NULL,
  `Carga_Horaria` VARCHAR(8) NOT NULL, -- Alterado de TIME para VARCHAR
  `Preco_Unitario` DECIMAL(10,2) NOT NULL,
  `Data_lancamento` DATE NOT NULL,
  `Treinamentos_idTreinamento` INT NOT NULL,
  `Funcionarios_CPF` VARCHAR(14) NOT NULL,
  `Funcionarios_Categorias_idCategoria` INT NOT NULL,
  PRIMARY KEY (`idHistorico_treinamento`, `Treinamentos_idTreinamento`, `Funcionarios_CPF`, `Funcionarios_Categorias_idCategoria`),
  INDEX `fk_Historico_Treinamentos_Treinamentos1_idx` (`Treinamentos_idTreinamento`),
  INDEX `fk_Historico_Treinamentos_Funcionarios1_idx` (`Funcionarios_CPF`, `Funcionarios_Categorias_idCategoria`),
  CONSTRAINT `fk_Historico_Treinamentos_Treinamentos1`
    FOREIGN KEY (`Treinamentos_idTreinamento`)
    REFERENCES `SST_Engefame`.`Treinamentos` (`idTreinamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Historico_Treinamentos_Funcionarios1`
    FOREIGN KEY (`Funcionarios_CPF` , `Funcionarios_Categorias_idCategoria`)
    REFERENCES `SST_Engefame`.`Funcionarios` (`CPF` , `Categorias_idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

