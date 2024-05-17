SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema SST_Engefame
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema SST_Engefame
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `SST_Engefame` DEFAULT CHARACTER SET utf8 ;
USE `SST_Engefame` ;

-- -----------------------------------------------------
-- Table `SST_Engefame`.`Categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SST_Engefame`.`Categorias` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCategoria`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `SST_Engefame`.`Funcionarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SST_Engefame`.`Funcionarios` (
  `Nome` VARCHAR(100) NOT NULL,
  `CPF` VARCHAR(14) NOT NULL,
  `Situacao` TINYINT NOT NULL,
  `Categorias_idCategoria` INT NULL,
  PRIMARY KEY (`CPF`, `Categorias_idCategoria`),
  INDEX `fk_Funcionarios_Categorias1_idx` (`Categorias_idCategoria` ASC),
  CONSTRAINT `fk_Funcionarios_Categorias1`
    FOREIGN KEY (`Categorias_idCategoria`)
    REFERENCES `SST_Engefame`.`Categorias` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `SST_Engefame`.`Treinamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SST_Engefame`.`Treinamentos` (
  `idTreinamento` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NOT NULL,
  `Descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idTreinamento`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `SST_Engefame`.`Empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SST_Engefame`.`Empresas` (
  `idEmpresas` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NULL,
  PRIMARY KEY (`idEmpresas`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `SST_Engefame`.`Historico_Treinamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SST_Engefame`.`Historico_Treinamentos` (
  `idHistorico_treinamento` INT NOT NULL AUTO_INCREMENT,
  `Treinamentos_idTreinamento` INT NOT NULL,
  `Empresas_idEmpresas` INT NOT NULL,
  `Funcionarios_CPF` VARCHAR(14) NOT NULL,
  `Funcionarios_Categorias_idCategoria` INT NOT NULL,
  `Data_Realizacao` DATE NOT NULL,
  `Data_Validade` DATE NOT NULL,
  `Comprovacao` TINYINT NOT NULL,
  `Modalidade` TINYINT NOT NULL,
  `Carga_Horaria` TIME NOT NULL,
  `Preco_Unitario` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`idHistorico_treinamento`),
  INDEX `fk_Historico_Treinamentos_Treinamentos1_idx` (`Treinamentos_idTreinamento` ASC),
  INDEX `fk_Historico_Treinamentos_Funcionarios1_idx` (`Funcionarios_CPF` ASC, `Funcionarios_Categorias_idCategoria` ASC),
  INDEX `fk_Historico_Treinamentos_Empresas1_idx` (`Empresas_idEmpresas` ASC),
  CONSTRAINT `fk_Historico_Treinamentos_Treinamentos1`
    FOREIGN KEY (`Treinamentos_idTreinamento`)
    REFERENCES `SST_Engefame`.`Treinamentos` (`idTreinamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Historico_Treinamentos_Funcionarios1`
    FOREIGN KEY (`Funcionarios_CPF`, `Funcionarios_Categorias_idCategoria`)
    REFERENCES `SST_Engefame`.`Funcionarios` (`CPF`, `Categorias_idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Historico_Treinamentos_Empresas1`
    FOREIGN KEY (`Empresas_idEmpresas`)
    REFERENCES `SST_Engefame`.`Empresas` (`idEmpresas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
