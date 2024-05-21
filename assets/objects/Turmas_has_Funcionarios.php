<?php
//-----------------------------------------------------------------------
/*/{} Turmas_has_Funcionarios.php.php
Funções de GET/SET para a Tabela Turmas_has_Funcionarios.php

@author Vinicius Neisser
@since 21/05/2024
@version 1.0

@Tabela     
            TF_Turmas_idTurma                              Turma Correspondente ao Participante(chave estrangeira).
            TF_Turmas_Empresas_idEmpresa                   Empresa Correspondente ao Participante(chave estrangeira).
            TF_Turmas_Treinamentos_idTreinamento           Treinamento Correspondente ao Participante(chave estrangeira).
            TF_Funcionarios_CPF                            Funcionario Correspondente a Turma(chave estrangeira).
            TF_Funcionarios_Categorias_idCategoria         Categoria do Funcionario Correspondente ao Turma(chave estrangeira).

@Tabela
/*/
//-----------------------------------------------------------------------



//FUNÇÃO DE INCLUIR TURMAS_HAS_FUNCIONARIOS NO BANCO DE DADOS 
function SetTurmas_has_Funcionarios($TF_Turmas_idTurma, $TF_Turmas_Empresas_idEmpresa, $TF_Turmas_Treinamentos_idTreinamento, $TF_Funcionarios_CPF, $TF_Funcionarios_Categorias_idCategoria){
  //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O INSERT PARA INCLUIR ACOMPANHAMENTO NA TURMA
  $setTurmasHasFuncionariosSQL = "INSERT INTO turmas_has_funcionarios (Turmas_idTurma, Turmas_Empresas_idEmpresa, Turmas_Treinamentos_idTreinamento, Funcionarios_CPF, Funcionarios_Categorias_idCategoria) VALUES (?, ?, ?, ?, ?)";
  $setTurmasHasFuncionariosStatement = $pdo->prepare($setTurmasHasFuncionariosSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $setTurmasHasFuncionariosStatement->bindParam(1, $TF_Turmas_idTurma);
  $setTurmasHasFuncionariosStatement->bindParam(2, $TF_Turmas_Empresas_idEmpresa);
  $setTurmasHasFuncionariosStatement->bindParam(3, $TF_Turmas_Treinamentos_idTreinamento);
  $setTurmasHasFuncionariosStatement->bindParam(4, $TF_Funcionarios_CPF);
  $setTurmasHasFuncionariosStatement->bindParam(5, $TF_Funcionarios_Categorias_idCategoria);
  // EXECUTANDO O SQL
  try {
      $setTurmasHasFuncionariosStatement->execute(); 
      return true;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}



// FUNÇÃO DE ALTERAR TURMAS_HAS_FUNCIONARIOS NO BANCO DE DADOS
function SetTurmas_has_FuncionariosAlterar($TF_Turmas_idTurma, $TF_Turmas_Empresas_idEmpresa, $TF_Turmas_Treinamentos_idTreinamento, $TF_Funcionarios_CPF, $TF_Funcionarios_Categorias_idCategoria, $TF_idTurmaFuncionario) {
  // INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  
  // CRIANDO O UPDATE PARA ATUALIZAR UM ACOMPANHAMENTO DE TURMA JÁ EXISTENTE
  $setTurmasHasFuncionariosSQL = "UPDATE turmas_has_funcionarios SET Turmas_idTurma=?, Turmas_Empresas_idEmpresa=?, Turmas_Treinamentos_idTreinamento=?, Funcionarios_CPF=?, Funcionarios_Categorias_idCategoria=? WHERE idTurmaFuncionario=?";
  $setTurmasHasFuncionariosStatement = $pdo->prepare($setTurmasHasFuncionariosSQL); 
  
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $setTurmasHasFuncionariosStatement->bindParam(1, $TF_Turmas_idTurma);
  $setTurmasHasFuncionariosStatement->bindParam(2, $TF_Turmas_Empresas_idEmpresa);
  $setTurmasHasFuncionariosStatement->bindParam(3, $TF_Turmas_Treinamentos_idTreinamento);
  $setTurmasHasFuncionariosStatement->bindParam(4, $TF_Funcionarios_CPF);
  $setTurmasHasFuncionariosStatement->bindParam(5, $TF_Funcionarios_Categorias_idCategoria);
  $setTurmasHasFuncionariosStatement->bindParam(6, $TF_idTurmaFuncionario);
  
  // EXECUTANDO O SQL
  try {
      $setTurmasHasFuncionariosStatement->execute(); 
      return true;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }    
}



/// FUNÇÃO DE BUSCAR PARTICIPANTE DE TURMA NO BANCO DE DADOS POR TURMAS ID
function GetTurmas_has_FuncionariosById($TF_Turmas_idTurma){
  // INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT PARA CONSULTAR A EXISTÊNCIA DE PARTICIPANTE DE TURMA COM O ID NO SISTEMA
  $getTurmasHasFuncionariosByIdSQL = "SELECT * FROM turmas_has_funcionarios WHERE Turmas_idTurma = ?";
  $getTurmasHasFuncionariosByIdStatement = $pdo->prepare($getTurmasHasFuncionariosByIdSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $getTurmasHasFuncionariosByIdStatement->bindParam(1, $TF_Turmas_idTurma, PDO::PARAM_INT);
  
  // EXECUTANDO O SQL
  try {
      // EXECUTANDO O SQL
      $getTurmasHasFuncionariosByIdStatement->execute(); 
      // OBTENDO O RESULTADO DA CONSULTA
      $acompanhamentoTurmas = $getTurmasHasFuncionariosByIdStatement->fetchAll(PDO::FETCH_ASSOC);
      return $acompanhamentoTurmas;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}



// FUNÇÃO DE BUSCAR TODOS OS PARTICIPANTES DE TURMA
function GetTurmas_has_FuncionariosALL(){
  // INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT
  $GetTurmas_has_FuncionariosALLSQL = "SELECT * FROM Turmas_has_Funcionarios";
  $GetTurmas_has_FuncionariosALLStatement = $pdo->query($GetTurmas_has_FuncionariosALLSQL); 
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
      // SQL EXECUTADA
      $GetTurmas_has_FuncionariosALLStatement->execute(); 
      // TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $Turmas_has_Funcionarios = $GetTurmas_has_FuncionariosALLStatement->fetchAll(PDO::FETCH_ASSOC);
      return $Turmas_has_Funcionarios;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}



// FUNÇÃO DE DELETAR ACOMPANHAMENTO DE TURMA NO BANCO DE DADOS POR FUNCIONARIO CPF E TURMA ID
function SetTurmas_has_FuncionariosExcluir($TF_Funcionarios_CPF, $TF_Turmas_idTurma){
  require "Conexao.php";
  // CRIANDO O DELETE PARA DELETAR ACOMPANHAMENTO DE TURMA NO SISTEMA
  $setTurmasHasFuncionariosExcluirSQL = "DELETE FROM turmas_has_funcionarios WHERE Funcionarios_CPF = ? AND Turmas_idTurma = ?";
  $setTurmasHasFuncionariosExcluirStatement = $pdo->prepare($setTurmasHasFuncionariosExcluirSQL); 
  // SUBSTITUINDO OS VALORES ? DO SQL PELAS VARIÁVEIS
  $setTurmasHasFuncionariosExcluirStatement->bindValue(1, $TF_Funcionarios_CPF, PDO::PARAM_STR);
  $setTurmasHasFuncionariosExcluirStatement->bindValue(2, $TF_Turmas_idTurma, PDO::PARAM_INT);
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
      // SQL EXECUTADA
      $setTurmasHasFuncionariosExcluirStatement->execute(); 
      return true;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}